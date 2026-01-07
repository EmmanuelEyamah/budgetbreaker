<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->whereNull('parent_id')->with('children')->get();
        $totalPercentage = Category::where('is_active', true)->whereNotNull('parent_id')->sum('percentage');

        return view('categories.index', compact('categories', 'totalPercentage'));
    }

    public function create()
    {
        $subcategories = Category::where('is_active', true)->whereNotNull('parent_id')->get();
        $usedPercentage = $subcategories->sum('percentage');
        $availablePercentage = 100 - $usedPercentage;

        return view('categories.create', compact('availablePercentage'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0.01|max:100'
        ]);

        $subcategories = Category::where('is_active', true)->whereNotNull('parent_id')->get();
        $currentTotal = $subcategories->sum('percentage');
        $newTotal = $currentTotal + $validated['percentage'];

        if ($newTotal > 100) {
            return back()->withErrors(['percentage' => 'Total percentage cannot exceed 100%'])->withInput();
        }

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        $subcategories = Category::where('is_active', true)->whereNotNull('parent_id')->where('id', '!=', $category->id)->get();
        $usedPercentage = $subcategories->sum('percentage');
        $availablePercentage = 100 - $usedPercentage;

        return view('categories.edit', compact('category', 'availablePercentage'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0.01|max:100'
        ]);

        $subcategories = Category::where('is_active', true)->whereNotNull('parent_id')->where('id', '!=', $category->id)->get();
        $currentTotal = $subcategories->sum('percentage');
        $newTotal = $currentTotal + $validated['percentage'];

        if ($newTotal > 100) {
            return back()->withErrors(['percentage' => 'Total percentage cannot exceed 100%'])->withInput();
        }

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->update(['is_active' => false]);

        return redirect()->route('categories.index')->with('success', 'Category deactivated successfully');
    }
}
