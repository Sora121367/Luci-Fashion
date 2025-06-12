<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // List all products with category relation
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.productlist', compact('products'));
    }

    // Show add product form
    public function create()
    {
        $mainCategories = Category::whereNull('parent_id')->get();
        $subCategories = Category::whereNotNull('parent_id')->get();

        return view('admin.addproduct', compact('mainCategories', 'subCategories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|uuid|exists:categories,id',
            'price' => 'required|numeric|min:1',
            'sizes' => 'nullable|array',
            'sizes.*' => 'string|in:S,M,L,XL',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Handle main image upload
        $mainImagePath = null;
        if ($request->hasFile('image_path')) {
            $mainImagePath = $request->file('image_path')->store('products', 'public');
        }

        // Handle multiple related image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image) {
                    $imagePaths[] = $image->store('products', 'public');
                }
            }
        }

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'sizes' => $request->sizes ?? [],
            'description' => $request->description,
            'image_path' => $mainImagePath,
            'images' => $imagePaths,
        ]);

        return redirect('/productlist')->with('success', 'Product added successfully!');
    }

    // Show edit product form
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $mainCategories = Category::whereNull('parent_id')->get();
        $subCategories = Category::whereNotNull('parent_id')->get();

        $selectedSubCategory = Category::find($product->category_id);
        $selectedMainCategoryId = $selectedSubCategory?->parent_id;

        return view('admin.editproducts', compact(
            'product',
            'mainCategories',
            'subCategories',
            'selectedMainCategoryId'
        ));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|uuid|exists:categories,id',
            'price' => 'required|numeric',
            'sizes' => 'nullable|array',
            'sizes.*' => 'string|in:S,M,L,XL',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Update main image if provided
        if ($request->hasFile('image_path')) {
            // Delete old main image
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            $product->image_path = $request->file('image_path')->store('products', 'public');
        }

        // Update related images if provided
        $existingImages = $product->images ?? [];
        if ($request->hasFile('images')) {
            $newImages = array_slice($request->file('images'), 0, 3 - count($existingImages));
            foreach ($newImages as $image) {
                $existingImages[] = $image->store('products', 'public');
            }
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'sizes' => $request->sizes ?? [],
            'description' => $request->description,
            'images' => array_slice($existingImages, 0, 3), // Limit to 3 images
        ]);

        return redirect('/productlist')->with('success', 'Product updated successfully!');
    }

    // Delete product and its images
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete main image
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        // Delete related images
        if (!empty($product->images)) {
            foreach ($product->images as $imagePath) {
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }

        $product->delete();

        return redirect('/productlist')->with('success', 'Product deleted successfully!');
    }
}
