@extends('layouts.app')

@section('title', 'Expenses')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">Expenses</h1>
    <a href="{{ route('expenses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Record Expense</a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h2 class="text-xl font-semibold">All Expenses</h2>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-3 px-4">Date</th>
                        <th class="text-left py-3 px-4">Category</th>
                        <th class="text-left py-3 px-4">Description</th>
                        <th class="text-right py-3 px-4">Amount</th>
                        <th class="text-right py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $expense->spent_at->format('M d, Y') }}</td>
                        <td class="py-3 px-4">{{ $expense->category->parent->name }} → {{ $expense->category->name }}</td>
                        <td class="py-3 px-4">{{ $expense->description ?? '-' }}</td>
                        <td class="text-right py-3 px-4">₦{{ number_format($expense->amount, 2) }}</td>
                        <td class="text-right py-3 px-4">
                            <a href="{{ route('expenses.show', $expense) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No expenses recorded yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $expenses->links() }}
        </div>
    </div>
</div>
@endsection
