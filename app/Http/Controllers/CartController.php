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
}
