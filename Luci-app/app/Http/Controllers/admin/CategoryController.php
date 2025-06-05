<?php

// app/Http/Controllers/Admin/CategoryController.php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        $mainCategories = $categories->whereNull('parent_id');
        $subCategories = $categories->whereNotNull('parent_id');

        return view('admin.categorylist', compact('mainCategories', 'subCategories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|uuid|exists:categories,id',
        ]);

        Category::create($request->only('name', 'parent_id'));

        return redirect('/categorylist')->with('success', 'Category added successfully!');
    }
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get(); // Only allow assigning parent from main categories
        return view('admin.newcategory', compact('categories'));
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.editcategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|uuid|exists:categories,id',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'parent_id'));

        return redirect('/categorylist')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/categorylist')->with('success', 'Category deleted successfully!');
    }
}
