<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Category;
use App\Models\IncomeAllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::with('allocations.category')->latest('received_at')->paginate(20);

        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->whereNull('parent_id')->with('children')->get();
        $subcategories = Category::where('is_active', true)->whereNotNull('parent_id')->get();
        $totalPercentage = $subcategories->sum('percentage');

        return view('incomes.create', compact('categories', 'totalPercentage'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'source' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'received_at' => 'required|date'
        ]);

        $subcategories = Category::where('is_active', true)->whereNotNull('parent_id')->get();

        if ($subcategories->isEmpty()) {
            return back()->withErrors(['error' => 'No active subcategories found'])->withInput();
        }

        $totalPercentage = $subcategories->sum('percentage');

        if ($totalPercentage != 100) {
            return back()->withErrors(['error' => 'Subcategory percentages must total 100%'])->withInput();
        }

        DB::transaction(function () use ($validated, $subcategories) {
            $income = Income::create($validated);

            foreach ($subcategories as $category) {
                $allocatedAmount = ($validated['amount'] * $category->percentage) / 100;

                IncomeAllocation::create([
                    'income_id' => $income->id,
                    'category_id' => $category->id,
                    'allocated_amount' => $allocatedAmount,
                    'percentage_used' => $category->percentage
                ]);

                $category->increment('current_balance', $allocatedAmount);
            }
        });

        return redirect()->route('incomes.index')->with('success', 'Income added and allocated successfully');
    }

    public function show(Income $income)
    {
        $income->load('allocations.category');

        return view('incomes.show', compact('income'));
    }
}
