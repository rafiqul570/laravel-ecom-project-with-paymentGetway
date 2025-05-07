<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class CartController extends Controller
{
    

    public function index(){
        
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        
        $shippingCost = Cart::with('product')->where('user_id', auth()->id())->value('shippingCost');
        
        $total = $cartItems->sum(fn($item) => $item->product_price * $item->product_quantity);

        $grand_total = $total + $shippingCost;

        
        return view('front.cart.index', compact('cartItems', 'shippingCost', 'total', 'grand_total'));
    }


    public function store(Request $request){
            
            $product_price = $request->product_price;
            $product_quantity = $request->product_quantity;
            $total_price = $product_price * $product_quantity;


        Cart::insert([

            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'product_color' => $request->product_color,
            'product_size' => $request->product_size,
            'product_img' => $request->product_img,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'shippingCost' => $request->shippingCost,
            'total_price' => $total_price,
            
        ]);


        return back()->with('success', 'Success! Your item added to cart');
    }


   //Update product_quantity

    public function updateQuantity(Request $request){
    

    $request->validate([
        'id' => 'required|exists:carts,id',
        'product_quantity' => 'required|integer|min:1'
    ]);

    $cartItem = Cart::where('id', $request->id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $cartItem->update(['product_quantity' => $request->product_quantity]);



    // Recalculate total for the user
    $total = Cart::where('user_id', auth()->id())
        ->get()
        ->sum(fn($item) => $item->product_price * $item->product_quantity);
    $shipping = 120; // fixed or calculate based on rules
    $grandTotal = $total + $shipping;

    return response()->json([
    'success' => true,
    'item_total' => number_format($cartItem->product_price * $cartItem->product_quantity, 2),
    'new_total' => number_format($total, 2), // <-- THIS MUST EXIST
    'shipping' => number_format($shipping, 2),
    'grand_total' => number_format($grandTotal, 2),
]);

   }

   public function delete($id){
        Cart::FindOrFail($id)->delete();
        return back()->with('success', 'Success! data delete Successfully');
    }


    public function getCartCount()
    {
        $user = Auth::user();

        if (!$user) {
            // If user is guest, you can return 0 or handle session cart count
            return response()->json(['count' => 0]);
        }

        $count = Cart::where('user_id', $user->id)->sum('product_quantity');

        return response()->json(['count' => $count]);
    }

    


}







    
