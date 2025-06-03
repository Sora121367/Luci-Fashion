<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        // dd($products);
        return view('User.user-home', ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the product by ID or fail if not found
        $product = Product::findOrFail($id);

        // Get related products with the same category, excluding the current product
        $relatedProducts = Product::with('category')
            ->where('id', '!=', $id)
            ->where('category_id', $product->category_id) // Assuming you want related by category
            ->get();

        return view('User.showproduct', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function menProducts()
    {
        $mainCategory = Category::where('name', 'Mens')->firstOrFail();

        // Eager load each sub-category's products
        $subCategories = $mainCategory->children()->with('products')->get();
        $totalProducts = $subCategories->sum(fn($cat) => $cat->products->count());

        return view('User.men-products', compact('subCategories','totalProducts'));
    }

    public function womenProducts()
    {
        $mainCategory = Category::where('name', 'Women')->firstOrFail();

        // Eager load each sub-category's products
        $subCategories = $mainCategory->children()->with('products')->get();
        $totalProducts = $subCategories->sum(fn($cat) => $cat->products->count());
        return view('User.women-products', compact('subCategories','totalProducts'));
    }
}
