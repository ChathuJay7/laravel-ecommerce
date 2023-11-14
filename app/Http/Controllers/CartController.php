<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /**
     * Add a product to the user's cart.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\RedirectResponse
     */
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

        // Find the product by Id
        $product = Product::findOrFail($productId);

        // Add the productId and cartId to cart items
        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Item added to cart successfully');
    }



    /**
     * Display the cart view with cart details and associated cart items.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    function cartView($id) {

        // Find the cart by ID
        $cart = Cart::findOrFail($id);
        //$cartItems = $cart->cartItems;

        // Retrieve cart items with associated product details
        $cartItems = $cart->cartItems()->with('product')->get();

        return view('cart', compact('cart', 'cartItems'));
    }



    /**
     * Remove a cart item from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCartItem($id)
    {
        // Find the cart item by ID
        $cartItem = CartItem::find($id);

        // Check if the cart item exists
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Cart item not found.');
        }

        // Remove the cart item
        $cartItem->delete();

        return redirect()->back()->with('success', 'Cart Item removed from cart successfully.');
    }

}
