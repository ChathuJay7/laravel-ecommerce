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

    function adminProductView() {
        $products = Product::all();
        return view('/admin-product', compact('products'));
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
            return redirect('/admin-product');

        } catch (Exception $e) {
            // Registration failed
            $response = [
                'message' => "Failed to add Product. Please try again.",
                'error' => $e->getMessage(),
            ];
    
            return redirect()->back()->withErrors($response);
        }
    }


    public function updateProductView($id)
    {
        // Retrieve the product by ID
        $product = Product::find($id);

        // Pass the product data to the view
        return view('admin-update-product', compact('product'));
    }

    public function updateProduct(Request $req, $productId)
    {
        try {
            // Validate input
            $req->validate([
                'name' => 'required|string',
                'price' => 'required|string',
                'category' => 'required|string',
                'description' => 'required|string',
                'gallery' => 'required|string',
            ]);

            // Find the product by ID
            $product = Product::find($productId);

            // Check if the product exists
            if (!$product) {
                return redirect()->back()->withErrors(['message' => 'Product not found.']);
            }

            // Update product fields
            $product->name = $req->name;
            $product->price = $req->price;
            $product->category = $req->category;
            $product->description = $req->description;
            $product->gallery = $req->gallery;
            
            // Save the changes
            $product->save();

            // Update successful
            return redirect('/admin-product');

        } catch (Exception $e) {
            // Update failed
            $response = [
                'message' => "Failed to update Product. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }

    // public function deleteProduct($id)
    // {
    //     try {
    //         // Find the product by ID
    //         $product = Product::find($id);

    //         // If the product is found, delete it
    //         if ($product) {
    //             $product->delete();
    //             return redirect('/admin-product')->with('success', 'Product deleted successfully');
    //         } else {
    //             // Product not found
    //             return redirect('/admin-product')->with('error', 'Product not found');
    //         }
    //     } catch (Exception $e) {
    //         // Handle exceptions
    //         return redirect('/admin-product')->with('error', 'Failed to delete product. Please try again.');
    //     }
    // }
    public function deleteProduct($id)
    {
        try {
            // Find the product by ID
            $product = Product::find($id);

            // If the product is found, delete it
            if ($product) {
                $product->delete();
                return redirect('/admin-product')->with('success', 'Product deleted successfully');
            } else {
                // Product not found
                return redirect('/admin-product')->with('error', 'Product not found');
            }
        } catch (Exception $e) {
            // Handle exceptions
            return redirect('/admin-product')->with('error', 'Failed to delete product. Please try again.');
        }
    }


}
