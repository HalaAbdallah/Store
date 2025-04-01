<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Apply auth middleware to all methods
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display all categories for authenticated user
    public function index()
    {
        // $categories = Category::where('user_id', Auth::id())->get();
        $categories = Category::where('user_id', Auth::id())
        ->latest()
        ->paginate(3);

        return view('admin.categories.index', compact('categories'));
    }

    // Show category creation form
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('categories.index')
               ->with('success', 'Category added successfully');
    }

    // Show category edit form
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        // Check if the user has permission to update the category
        $this->authorize('update', $category);

        return view('admin.categories.edit', compact('category'));
    }

    // Update existing category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);

        // Check if the user has permission to update the category
        $this->authorize('update', $category);

        $category->update(['name' => $request->name]);

        return redirect()->route('categories.index')
               ->with('success', 'Category updated successfully');
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Check if the user has permission to delete the category
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('categories.index')
               ->with('success', 'Category deleted successfully');
    }
}
