<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.productlist', compact('products'));
    }
    
    public function create()
    {
        $mainCategories = Category::whereNotNull('parent_id')->get();
        $subCategories = Category::whereNull('parent_id')->get();
        return view('admin.addproduct', compact('mainCategories', 'subCategories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id' => Str::uuid(),
            'name' => 'required|string|max:255',
            'category_id' => 'required|uuid|exists:categories,id',
            'price' => 'required|numeric|min:1',
            // 'size' => 'required',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            // 'status' => 'required|string',
        ]);

         $imagePath = $request->file('image') 
            ? $request->file('image')->store('products', 'public') 
            : null;

        

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            // 'size' => $request->size,
            'description' => $request->description,
            'image_path' => $imagePath,
            // 'status' => $request->status,
        ]);

        return redirect('/productlist')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $mainCategories = Category::whereNull('parent_id')->get();
        $subCategories = Category::whereNotNull('parent_id')->get();

        // Get the main category ID of this product's sub-category
        $selectedSubCategory = Category::find($product->category_id);
        $selectedMainCategoryId = $selectedSubCategory?->parent_id;

        return view('admin.editproducts', compact(
            'product',
            'mainCategories',
            'subCategories',
            'selectedMainCategoryId'
        ));
    }



    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            // 'sizes' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;
        // $product->sizes = $request->has('sizes') ? json_encode($request->sizes) : null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.productlist')->with('success', 'Product updated successfully!');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_path) {
            Storage::delete('public/' . $product->image_path);
        }

        $product->delete();
        return redirect('/productlist')->with('success', 'Product deleted successfully!');
    }
}