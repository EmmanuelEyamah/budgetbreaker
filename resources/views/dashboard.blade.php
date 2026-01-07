@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm">Total Income</div>
        <div class="text-2xl font-bold text-gray-900">₦{{ number_format($totalIncome, 2) }}</div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm">Total Expenses</div>
        <div class="text-2xl font-bold text-gray-900">₦{{ number_format($totalExpenses, 2) }}</div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm">Total Balance</div>
        <div class="text-2xl font-bold text-gray-900">₦{{ number_format($totalBalance, 2) }}</div>
    </div>
</div>

<div class="bg-white rounded-lg shadow mb-6">
    <div class="px-6 py-4 border-b">
        <h2 class="text-xl font-semibold">Categories Overview</h2>
    </div>
    <div class="p-6">
        @foreach($categories as $category)
        <div class="mb-4 border rounded">
            <div class="bg-gray-50 px-4 py-3 flex justify-between items-center cursor-pointer" onclick="toggleAccordion('cat-{{ $category->id }}')">
                <div>
                    <span class="font-semibold">{{ $category->name }}</span>
                    <span class="text-gray-600 text-sm ml-2">({{ number_format($category->percentage, 2) }}%)</span>
                </div>
                <div class="text-right">
                    <div class="font-semibold">₦{{ number_format($category->children->sum('current_balance'), 2) }}</div>
                    <div class="text-xs text-gray-500">Total Balance</div>
                </div>
            </div>
            <div id="cat-{{ $category->id }}" class="hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left py-2 px-4 text-sm">Subcategory</th>
                            <th class="text-right py-2 px-4 text-sm">%</th>
                            <th class="text-right py-2 px-4 text-sm">Balance</th>
                            <th class="text-right py-2 px-4 text-sm">Allocated</th>
                            <th class="text-right py-2 px-4 text-sm">Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->children as $sub)
                        <tr class="border-t">
                            <td class="py-2 px-4 text-sm">{{ $sub->name }}</td>
                            <td class="text-right py-2 px-4 text-sm">{{ number_format($sub->percentage, 2) }}%</td>
                            <td class="text-right py-2 px-4 text-sm">₦{{ number_format($sub->current_balance, 2) }}</td>
                            <td class="text-right py-2 px-4 text-sm">₦{{ number_format($sub->total_allocated, 2) }}</td>
                            <td class="text-right py-2 px-4 text-sm">₦{{ number_format($sub->total_spent, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
function toggleAccordion(id) {
    const element = document.getElementById(id);
    element.classList.toggle('hidden');
}
</script>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h2 class="text-xl font-semibold">Recent Incomes</h2>
        </div>
        <div class="p-6">
            @forelse($recentIncomes as $income)
                <div class="mb-4 pb-4 border-b last:border-0">
                    <div class="flex justify-between">
                        <span class="font-medium">₦{{ number_format($income->amount, 2) }}</span>
                        <span class="text-gray-500 text-sm">{{ $income->received_at->format('M d, Y') }}</span>
                    </div>
                    @if($income->source)
                        <div class="text-gray-600 text-sm">{{ $income->source }}</div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">No incomes recorded yet</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h2 class="text-xl font-semibold">Recent Expenses</h2>
        </div>
        <div class="p-6">
            @forelse($recentExpenses as $expense)
                <div class="mb-4 pb-4 border-b last:border-0">
                    <div class="flex justify-between">
                        <span class="font-medium">₦{{ number_format($expense->amount, 2) }}</span>
                        <span class="text-gray-500 text-sm">{{ $expense->spent_at->format('M d, Y') }}</span>
                    </div>
                    <div class="text-gray-600 text-sm">{{ $expense->category->parent->name }} → {{ $expense->category->name }}</div>
                </div>
            @empty
                <p class="text-gray-500">No expenses recorded yet</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
