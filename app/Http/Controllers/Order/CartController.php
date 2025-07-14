<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display the shopping cart page.
     */
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        
        // Calculate subtotal, considering the discount price if available.
        $total = $cartItems->sum(function($item) {
            $price = $item->discount_price > 0 ? $item->discount_price : $item->product_price;
            return $price * $item->product_quantity;
        });

        // --- Shipping Cost Logic (Method 3) ---
        // Rule: Free shipping if the subtotal is over a certain amount.
        
        $shippingCost = 0;
        $standardShippingCost = 120; // The standard shipping fee
        $freeShippingThreshold = 5000; // The minimum amount for free shipping

        // Apply shipping cost only if there are items in the cart
        if ($total > 0) {
            if ($total < $freeShippingThreshold) {
                $shippingCost = $standardShippingCost;
            }
            // If total is >= freeShippingThreshold, shippingCost remains 0.
        }
        
        // Calculate the final total
        $grand_total = $total + $shippingCost;

        return view('cart', compact('cartItems', 'shippingCost', 'total', 'grand_total'));
    }

    /**
     * Store a new item in the cart.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'product_quantity' => 'required|integer|min:1',
        ]);
        
        // Determine the effective price (discounted or regular)
        $effective_price = $request->discount_price > 0 ? $request->discount_price : $request->product_price;
        $product_quantity = $request->product_quantity;

        // Calculate the total price for this specific cart item
        $total_price = $effective_price * $product_quantity;
            
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'product_color' => $request->product_color,
            'product_size' => $request->product_size,
            'product_img' => $request->product_img,
            'discount_price' => $request->discount_price,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'shippingCost' => $request->shippingCost, // Storing base shipping for potential future use
            'total_price' => $total_price,
        ]);

        return back()->with('success', 'Success! Your item added to cart');
    }

    /**
     * Update item quantity in the cart via AJAX.
     */
    public function updateQuantity(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:carts,id',
            'product_quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('id', $request->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cartItem->update(['product_quantity' => $request->product_quantity]);

        // Recalculate totals for the entire cart
        $allCartItems = Cart::where('user_id', auth()->id())->get();
        
        $total = $allCartItems->sum(function($item) {
            $price = $item->discount_price > 0 ? $item->discount_price : $item->product_price;
            return $price * $item->product_quantity;
        });
        
        // --- Re-apply Shipping Cost Logic (Method 3) for AJAX response ---
        $shipping = 0;
        $standardShippingCost = 120;
        $freeShippingThreshold = 5000;

        if ($total > 0) {
            if ($total < $freeShippingThreshold) {
                $shipping = $standardShippingCost;
            }
        }
        
        $grandTotal = $total + $shipping;

        // Calculate the total for the single item that was updated
        $itemPrice = $cartItem->discount_price > 0 ? $cartItem->discount_price : $cartItem->product_price;
        $itemTotal = $itemPrice * $cartItem->product_quantity;

        return response()->json([
            'success' => true,
            'item_total' => number_format($itemTotal, 2),
            'new_total' => number_format($total, 2),
            'shipping' => number_format($shipping, 2),
            'grand_total' => number_format($grandTotal, 2),
        ]);
    }

    /**
     * Delete an item from the cart.
     */
    public function delete($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cartItem->delete();
        
        return back()->with('success', 'Success! Item removed successfully');
    }

    /**
     * Get the total number of items in the cart for header display.
     */
    public function getCartCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = Cart::where('user_id', auth()->id())->sum('product_quantity');

        return response()->json(['count' => $count]);
    }
}