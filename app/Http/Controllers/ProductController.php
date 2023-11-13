<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // function index()
    // {
    //     $products = Product::all();
    //     // return view('home', ['products' => $data]);
    //     return view('home', compact('products'));
    // }

    function index()
    {
        $user = Auth::user();
        $products = Product::all();

        if ($user && $user->role === 'admin') {
            return view('admin-dashboard', compact('products'));
        } else {
            return view('home', compact('products'));
        }
    }

    function addNewProductView() {
        return view('/add-new-product');
    }

    function addNewProduct(Request $req) {
        try {
            // Validate input
            $req->validate([
                'name' => 'required|string',
                'price' => 'required|string',
                'category' => 'required|string',
                'description' => 'required|string',
                'gallery' => 'required|string',
            ]);
    
            // Create a new User instance
            $product = new Product;
            $product->name = $req->name;
            $product->price = $req->price;
            $product->category = $req->category;
            $product->description = $req->description;
            $product->gallery = $req->gallery;
            $product->save();
    
            // Registration successful
            return redirect('/admin-dashboard');

        } catch (Exception $e) {
            // Registration failed
            $response = [
                'message' => "Failed to add Product. Please try again.",
                'error' => $e->getMessage(),
            ];
    
            return redirect()->back()->withErrors($response);
        }
    }
}
