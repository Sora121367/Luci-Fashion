<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categorylist', compact('categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.categorylist', compact('categories'));
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
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
    ]);

        return redirect('/categorylist')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/categorylist')->with('success', 'Category deleted successfully!');
    }
}
