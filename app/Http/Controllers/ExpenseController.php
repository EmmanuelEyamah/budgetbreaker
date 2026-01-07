<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('category')->latest('spent_at')->paginate(20);

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->whereNotNull('parent_id')->with('parent')->get();

        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
            'spent_at' => 'required|date'
        ]);

        $category = Category::findOrFail($validated['category_id']);

        if ($category->current_balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'Insufficient balance in this category'])->withInput();
        }

        DB::transaction(function () use ($validated, $category) {
            Expense::create($validated);
            $category->decrement('current_balance', $validated['amount']);
        });

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully');
    }

    public function show(Expense $expense)
    {
        $expense->load('category');

        return view('expenses.show', compact('expense'));
    }
}
