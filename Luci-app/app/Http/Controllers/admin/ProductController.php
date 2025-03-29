<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.productlist', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'sub_category' => 'required|string',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|string',
        ]);

        $imagePath = $request->file('image') 
            ? $request->file('image')->store('products', 'public') 
            : null;

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect('/productlist')->with('success', 'Product added successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();
        return redirect('/productlist')->with('success', 'Product deleted successfully!');
    }
}