<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($productId)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has a cart
        $cart = $user->cart;

        if (!$cart) {
            // If the user doesn't have a cart, create one
            $cart = Cart::create(['user_id' => $user->id]);
        }

        // Find the product by ID
        $product = Product::findOrFail($productId);

        // Add the product to the cart items
        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            // Add other details as needed
        ]);

        // Optionally, you can add more logic or return a response

        return redirect()->back()->with('success', 'Item added to cart successfully');
    }

    function cartView($id) {
        $cart = Cart::findOrFail($id);
        //$cartItems = $cart->cartItems;
        $cartItems = $cart->cartItems()->with('product')->get();
        return view('cart', compact('cart', 'cartItems'));
    }

    public function removeCartItem($id)
    {
        // Find the cart item by ID
        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Cart item not found.');
        }

        // Remove the cart item
        $cartItem->delete();

        // Optionally, redirect back or to a specific page
        return redirect()->back()->with('success', 'Cart Item removed from cart successfully.');
    }
}
