<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    

    public function placeOrderView($id)
    {
        try {
            $cart = Cart::findOrFail($id);

            // Retrieve cart items with associated product details
            $cartItems = $cart->cartItems()->with('product')->get();

            // Pass cart items to placeOrder view
            return view('place-order', compact('cart', 'cartItems'));
        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'message' => "Failed to place the order. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }


    public function placeOrder()
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            // Get the user's cart
            $cart = $user->cart;

            // Check if the user has a cart
            if (!$cart) {
                return redirect()->back()->with('error', 'Cart is empty. Cannot place an order.');
            }

            // Get cart items
            $cartItems = $cart->cartItems;

            // Create an order for the user with total_price
            $totalPrice = $cartItems->sum('product.price');

            // Create an order for the user with total_price
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
            ]);

            // Move cart items to order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                ]);

                // Delete cart items
                $cartItem->delete();
            }

            // Empty the user's cart
            //$cart->delete();

            return redirect()->back()->with('success', 'Order placed successfully.');
            
        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'message' => "Failed to place the order. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }



    public function OrderView()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Load orders with order items for the user
        $orders = Order::where('user_id', $user->id)->with('orderItems.product')->get();

        return view('orders', compact('orders'));
    }

}
