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




    /**
     * Display the dashboard based on the user's role.
     *
     * @return \Illuminate\Contracts\View\View
     */
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



    /**
     * Perform a search for products based on the provided search term.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        try {
            // Get the search query from the request
            $query = $request->input('searchTerm');

            // Perform a basic search on the product name
            $products = Product::where('name', 'like', '%' . $query . '%')->get();

            //return view('home', compact('products'));
            
            // Check the user's role
            if (Auth::check() && Auth::user()->role === 'admin') {
                return view('admin-product', compact('products'));
            } else {
                return view('home', compact('products'));
            }

        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'message' => "Failed to perform the search. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }



    /**
     * Display the admin product view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    function adminProductView() {
        $products = Product::all();
        return view('/admin-product', compact('products'));
    }



    /**
     * Display the add new product view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    function addNewProductView() {
        return view('/add-new-product');
    }



    /**
     * Add a new product to the database.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\RedirectResponse
     */
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



    /**
     * Display the view to update a specific product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function updateProductView($id)
    {
        // Retrieve the product by ID
        $product = Product::find($id);

        // Pass the product data to the view
        return view('admin-update-product', compact('product'));
    }



    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  int  $productId
     * @return \Illuminate\Http\RedirectResponse
     */
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



    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
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




    // ProductController.php

    public function singleProductView($id)
    {
        try {
            // Retrieve the product by ID
            $product = Product::findOrFail($id);

            // Pass the product data to the view
            return view('single-product', compact('product'));
        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'message' => "Failed to retrieve product details. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }



}
