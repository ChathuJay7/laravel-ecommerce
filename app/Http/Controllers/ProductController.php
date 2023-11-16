<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

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
    // function index()
    // {
    //     $user = Auth::user();
    //     $products = Product::all();

    //     if ($user && $user->role === 'admin') {
    //         return view('admin-dashboard', compact('products'));
    //     } else {
    //         return view('home', compact('products'));
    //     }
    // }



    /**
     * Display the dashboard based on the user's role.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Check if products are in the cache
        if (Cache::has('all_products')) {
            // Retrieve products from cache
            $products = Cache::get('all_products');
            Log::info("Data retrieved from cache..");
            
        } else {
            // Fetch products from the database if not found in the cache
            $products = Product::all();

            // Store products in the cache
            Cache::put('all_products', $products, 60 * 60);
            Log::info("None cache");
        }

        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return view('admin-dashboard');
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
    // public function search(Request $request)
    // {
    //     try {
    //         // Get the search query from the request
    //         $query = $request->input('searchTerm');

    //         // Perform a basic search on the product name
    //         $products = Product::where('name', 'like', '%' . $query . '%')->get();

    //         //return view('home', compact('products'));
            
    //         // Check the user's role
    //         if (Auth::check() && Auth::user()->role === 'admin') {
    //             return view('admin-product', compact('products'));
    //         } else {
    //             return view('home', compact('products'));
    //         }

    //     } catch (\Exception $e) {
    //         // Handle exceptions
    //         $response = [
    //             'message' => "Failed to perform the search. Please try again.",
    //             'error' => $e->getMessage(),
    //         ];

    //         return redirect()->back()->withErrors($response);
    //     }
    // }

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
    
            // Check if results are already in the cache
            if (Cache::has('search_' . $query)) {
                $products = Cache::get('search_' . $query);
    
                // Log a message indicating that results are fetched from the cache
                Log::info("Results for '{$query}' fetched from cache.");
            } else {
                // Perform search on the product name
                $products = Product::where('name', 'like', '%' . $query . '%')->get();
    
                // Cache the results
                Cache::put('search_' . $query, $products, 60 * 60);
    
                // Log a message indicating that results are fetched from the database and cached
                Log::info("Results for '{$query}' fetched from the database and cached.");
            }
    
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
    // function adminProductView() {
    //     $products = Product::all();
    //     return view('/admin-product', compact('products'));
    // }
    public function adminProductView()
    {
        // Check if products are in the cache
        if (Cache::has('all_products')) {
            // Retrieve products from cache
            $products = Cache::get('all_products');
            Log::info("Data retrieved from cache..");
        } else {
            // Fetch products from the database if not found in the cache
            $products = Product::all();

            // Store products in the cache
            Cache::put('all_products', $products, 60 * 60);
            Log::info("Data stored in cache..");
        }

        return view('admin-product', compact('products'));
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

            // Clear the cache for 'all_products'
            Cache::forget('all_products');

            // Clear all search-related caches (using a wildcard '*')
            //Cache::forgetMatching('search_*');
    
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

            // Clear the cache for 'all_products'
            Cache::forget('all_products');

            // Clear the cache for 'search_*'
            //$searchKeys = Cache::store('redis')->getRedis()->keys('search_*');
            //$searchKeys = Cache::store('redis')->getRedis()->keys();
            // Log::info($searchKeys);
            // foreach ($searchKeys as $key) {
            //     Cache::forget($key);
            //     Log::info($key);
            // }

            Redis::flushDB();


            // Update successful
            return redirect()->back()->with('success', 'Product updated successfully');

        } catch (Exception $e) {
            // Update failed
            $response = [
                'message' => "Failed to update Product. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }



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

                // Clear the cache for 'all_products'
                Cache::forget('all_products');

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
