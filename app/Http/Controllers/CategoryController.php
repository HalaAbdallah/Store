<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**Display a listing of categories */
    public function index()
    {
        // Retrieve all categories from the database
        $categories = Category::all();
        // Return the categories list view with the retrieved data
        return view('admin.categories.index', compact('categories'));
    }

    /**Show the form for creating a new category. */
    public function create()
    {
        // Return the category creation view
        return view('admin.categories.create');
    }

    /** Store a newly created category in the database. */
    public function store(Request $request)
    {
        // Create and save the new category
        Category::create([
            'name' => $request->input('name'),
        ]);

        // Redirect back with success message
        return redirect()->route('categories.index')->with('success', 'تم الاضافة بنجاح');
    }

    /**Show the form for editing the specified category. */
    public function edit($id)
    {
        // Find the category by ID, or fail if not found
        $category = Category::findOrFail($id);

        // Return the edit view with the category data
        return view('admin.categories.edit', compact('category'));
    }

    /**Update the specified category in the database.*/
    public function update(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Update the category with new data (without validation)
        $category->update([
            'name' => $request->input('name'),
        ]);

        // Redirect back with success message
        return redirect()->route('categories.index')->with('success', 'تم التعديل بالنجاح');
    }

    /**Remove the specified category from the database.*/
    public function destroy($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Redirect back with success message
        return redirect()->route('categories.index')->with('success', 'تم الحذف بنجاح');
    }
}
