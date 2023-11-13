<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        $products = Product::all();
        // return view('home', ['products' => $data]);
        return view('home', compact('products'));
    }
}
