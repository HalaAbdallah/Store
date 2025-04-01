<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /** Apply authentication middleware to all controller methods */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Show the form for creating a new product */
    public function create()
    {
        // جلب الفئات الخاصة بالمستخدم الحالي فقط
    $categories = Category::where('user_id', Auth::id())->get();
    return view('admin.products.create', compact('categories'));
    }

    /** Store a created product in database */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'user_id' => Auth::id(),  // تأكد من تخزين المنتج للمستخدم الحالي
            'category_id' => $request->category,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }

   /** Display a listing of all products */
public function index()
{
    // فلترة المنتجات حسب المستخدم الحالي
    $products = Product::where('user_id', Auth::id())
    ->with(['category', 'user'])
    ->latest()
    ->paginate(3);

    return view('admin.products.index', compact('products'));
}

    /** Show the form for editing specified product */
public function edit($id)
{
    $product = Product::findOrFail($id);
    $this->authorize('update', $product);

    // جلب الفئات الخاصة بالمستخدم الحالي فقط
    $categories = Category::where('user_id', Auth::id())->get();

    return view('admin.products.edit', compact('product', 'categories'));
}


    /** Update the specified product in database */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /** Remove the specified product from database */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'تم الحذف بنجاح');
    }
}
