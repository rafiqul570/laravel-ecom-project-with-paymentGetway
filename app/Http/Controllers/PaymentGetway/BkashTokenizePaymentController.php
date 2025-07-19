<?php

namespace App\Http\Controllers\PaymentGetway;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class BkashTokenizePaymentController extends Controller
{
    /**
     * পরিবর্তন ১: index() মেথডটি এখন $order_id গ্রহণ করবে
     * এবং নিরাপত্তার জন্য অর্ডারটি সঠিক ব্যবহারকারীর কিনা তা যাচাই করবে।
     */
    public function index($order_id)
    {
        $order = Order::findOrFail($order_id);

        // নিশ্চিত করুন যে অর্ডারটি বর্তমান ব্যবহারকারীর এবং স্ট্যাটাস 'Pending'
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
            abort(403, 'অননুমোদিত বা অবৈধ অর্ডার।'); // 'Unauthorized or invalid order.' এর বাংলা অনুবাদ
        }

        // বিকাশ পেমেন্ট পেজ দেখানোর জন্য ভিউ রিটার্ন করুন
        // আপনার বিকাশ পেমেন্ট ভিউ ফাইলের নাম 'bkash.bkash-payment' না হলে সঠিক নামটি দিন।
        return view('paymentGetway.bkash.payment', compact('order'));
    }
   
    /**
     * পরিবর্তন ২: createPayment() মেথডটি আর নতুন অর্ডার তৈরি করবে না।
     * এটি রিকোয়েস্ট থেকে আসা order_id দিয়ে বিদ্যমান অর্ডারটি খুঁজে বের করবে।
     */
    public function createPayment(Request $request)
    {
        // রিকোয়েস্ট থেকে order_id ভ্যালিডেট করুন
        $request->validate([
            'order_id' => 'required|exists:orders,id'
        ]);
        
        // নতুন অর্ডার তৈরির পরিবর্তে বিদ্যমান অর্ডারটি খুঁজুন
        $order = Order::findOrFail($request->order_id);
        
        // নিরাপত্তা যাচাই: অর্ডারটি সঠিক ব্যবহারকারী এবং পেন্ডিং অবস্থায় আছে কিনা
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
             return redirect()->back()->with('error-alert2', 'অবৈধ বা অননুমোদিত অর্ডার।');
        }

        // বিকাশের জন্য রিকোয়েস্ট ডেটা তৈরি করুন
        $request_data = [
            'mode'                  => '0011',
            'payerReference'        => 'ref_'.$order->user_id, // অর্ডারের user_id ব্যবহার করা হলো
            'callbackURL'           => route('bkash.callback'), // এখানে bkash-callBack এর পরিবর্তে bkash.callback হবে
            'intent'                => 'sale',
            'currency'              => 'BDT',
            'amount'                => $order->amount, // অর্ডারের পরিমাণ ব্যবহার করা হলো
            'merchantInvoiceNumber' => $order->invoice_no // অর্ডারের ইনভয়েস নং ব্যবহার করা হলো
        ];

        try {
            $response = BkashPaymentTokenize::cPayment(json_encode($request_data));

            // পেমেন্ট আইডি অর্ডারে সংরক্ষণ করুন
            if (isset($response['paymentID'])) {
                $order->payment_id = $response['paymentID'];
                $order->save();
            }
            
            if (isset($response['bkashURL'])) {
                return redirect()->away($response['bkashURL']);
            } else {
                Log::error('bKash Create Payment Failed: ', (array) $response);
                $order->update(['status' => 'Failed']);
                return redirect()->back()->with('error-alert2', $response['statusMessage'] ?? 'পেমেন্ট শুরু করা যায়নি।');
            }

        } catch (\Exception $e) {
            Log::error('bKash Create Payment Exception: ' . $e->getMessage());
            $order->update(['status' => 'Failed']);
            return redirect()->back()->with('error-alert2', 'পেমেন্ট তৈরির সময় একটি ত্রুটি ঘটেছে।');
        }
    }

    /**
     * callBack() মেথডে কোনো পরিবর্তনের প্রয়োজন নেই। এটি এখন সঠিকভাবে কাজ করবে।
     */
    public function callBack(Request $request)
    {
        if ($request->status == 'success' && $request->has('paymentID')) {
            
            $order = Order::where('payment_id', $request->paymentID)->first();
            
            if ($order && $order->status === 'Paid') {
                return redirect()->route('order.success', ['order_id' => $order->id]);
            }

            try {
                $response = BkashPaymentTokenize::executePayment($request->paymentID);

                if (!$response) {
                    $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                }

                if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                    
                    $order = Order::where('payment_id', $response['paymentID'])->first();
                    
                    if ($order) {
                        $order->update([
                            'status'         => 'Paid',
                            'payment_method' => 'bKash',
                            'trx_id'         => $response['trxID'],
                        ]);

                        return redirect()->route('order.success', ['order_id' => $order->id]);
                    }
                }
                
                $order = Order::where('payment_id', $request->paymentID)->first();
                if ($order) {
                    $order->update(['status' => 'Failed']);
                }
                return redirect()->route('home')->with('error-alert2', $response['statusMessage'] ?? 'পেমেন্ট ব্যর্থ হয়েছে।');

            } catch (\Exception $e) {
                Log::error('bKash Callback Exception: ' . $e->getMessage());
                return redirect()->route('home')->with('error-alert2', 'পেমেন্ট যাচাই করার সময় একটি ত্রুটি ঘটেছে।');
            }

        } else {
            $order = Order::where('payment_id', $request->paymentID)->first();
            if ($order) {
                $order->update(['status' => 'Cancelled']);
            }
            return redirect()->route('home')->with('error-alert2', 'আপনার পেমেন্ট বাতিল করা হয়েছে।');
        }
    }



    
}