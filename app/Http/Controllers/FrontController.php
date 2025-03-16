<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**Function to display the homepage */
    public function index()
    {
        // Retrieve all categories from the database
        $categories = Category::all();

        // Retrieve all products from the database
        $products = Product::all();

        return view('home.index', compact('products', 'categories'));
    }
}
