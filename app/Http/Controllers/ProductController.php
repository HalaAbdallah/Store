<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /** Display the form for creating a new product. */
    public function create()
    {
        // Retrieve all categories from the database to populate the category dropdown
        $categories = Category::all();

        // Return the product creation view with categories data
        return view('admin.products.create', compact('categories'));
    }

    /** Store a newly created product in the database. */
    public function store()
    {
        // Retrieve data from request
        $data = request()->all();

        // Validate the incoming data with custom error messages
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255', // name is required
            'category' => 'required|exists:categories,id', // category is required and must exist in the categories table
            'price' => 'required|numeric|min:0', // price is required and must be a number greater than or equal to 0
            'quantity' => 'required|integer|min:1', // quantity is required and must be an integer greater than or equal to 1
            'description' => 'nullable|string|max:1000', // description is optional, but if provided, must be a string and not exceed 1000 characters
        ], [
            // Custom error messages for required fields
            'name.required' => 'اسم المنتج مطلوب.',
            'category.required' => 'الفئة المطلوبة يجب اختيارها.',
            'category.exists' => 'الفئة المختارة غير موجودة.',
            'price.required' => 'سعر المنتج مطلوب.',
            'price.numeric' => 'سعر المنتج يجب أن يكون رقمًا.',
            'price.min' => 'سعر المنتج يجب أن يكون أكبر من أو يساوي 0.',
            'quantity.required' => 'الكمية مطلوبة.',
            'quantity.integer' => 'الكمية يجب أن تكون عدد صحيح.',
            'quantity.min' => 'الكمية يجب أن تكون أكبر من أو تساوي 1.',
            'description.max' => 'الوصف يجب أن لا يتجاوز 1000 حرف.',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new product record using mass assignment
        Product::create([
            'name' => $data['name'],
            'category_id' => $data['category'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'description' => $data['description'] ?? null, // if description is not provided, set it as null
        ]);

        // Redirect back to the previous page with success message
        return redirect()->back()->with('success', 'تمت إضافة المنتج بنجاح');
    }

    /** Display a listing of all products. */
    public function index()
    {
        // Retrieve all products from the database
        $products = Product::all();

        // Return the index view with products data
        return view('admin.products.index', compact('products'));
    }

    /** Show the form for editing a specific product. */
    public function edit($id)
    {
        // Find the product by ID, or fail if not found
        $product = Product::findOrFail($id);

        // Retrieve all categories to populate the dropdown
        $categories = Category::all();

        // Return the edit view with product and category data
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /** Update the specified product in the database. */
    public function update($id)
    {
        // Retrieve data from request
        $data = request()->all();

        // Validate the incoming data with custom error messages
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255', // name is required
            'category' => 'required|exists:categories,id', // category is required and must exist in the categories table
            'price' => 'required|numeric|min:0', // price is required and must be a number greater than or equal to 0
            'quantity' => 'required|integer|min:1', // quantity is required and must be an integer greater than or equal to 1
            'description' => 'nullable|string|max:1000', // description is optional, but if provided, must be a string and not exceed 1000 characters
        ], [
            // Custom error messages for required fields
            'name.required' => 'اسم المنتج مطلوب.',
            'category.required' => 'الفئة المطلوبة يجب اختيارها.',
            'category.exists' => 'الفئة المختارة غير موجودة.',
            'price.required' => 'سعر المنتج مطلوب.',
            'price.numeric' => 'سعر المنتج يجب أن يكون رقمًا.',
            'price.min' => 'سعر المنتج يجب أن يكون أكبر من أو يساوي 0.',
            'quantity.required' => 'الكمية مطلوبة.',
            'quantity.integer' => 'الكمية يجب أن تكون عدد صحيح.',
            'quantity.min' => 'الكمية يجب أن تكون أكبر من أو تساوي 1.',
            'description.max' => 'الوصف يجب أن لا يتجاوز 1000 حرف.',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update the product with new values from the request
        $product->update([
            'name' => $data['name'],
            'category_id' => $data['category'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'description' => $data['description'] ?? null, // if description is not provided, set it as null
        ]);

        // Redirect to the products index page with a success message
        return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح');
    }

    /** Remove the specified product from the database. */
    public function destroy($id)
    {
        // Find the product by ID and delete it
        $product = Product::findOrFail($id);
        $product->delete();

        // Redirect back to the products index with a success message
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح');
    }
}
