<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->whereNull('parent_id')->with('children')->get();
        $totalIncome = Income::sum('amount');
        $totalExpenses = Expense::sum('amount');
        $totalBalance = Category::where('is_active', true)->whereNotNull('parent_id')->sum('current_balance');

        $recentIncomes = Income::latest('received_at')->take(5)->get();
        $recentExpenses = Expense::with('category.parent')->latest('spent_at')->take(5)->get();

        return view('dashboard', compact(
            'categories',
            'totalIncome',
            'totalExpenses',
            'totalBalance',
            'recentIncomes',
            'recentExpenses'
        ));
    }
}
