@extends('layouts.app')

@section('title', 'Expense Details')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Expense Details</h1>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <span class="text-gray-600">Category:</span>
            <span class="font-semibold">{{ $expense->category->name }}</span>
        </div>
        <div>
            <span class="text-gray-600">Amount:</span>
            <span class="font-semibold">₦{{ number_format($expense->amount, 2) }}</span>
        </div>
        <div>
            <span class="text-gray-600">Date:</span>
            <span class="font-semibold">{{ $expense->spent_at->format('M d, Y') }}</span>
        </div>
        <div>
            <span class="text-gray-600">Created:</span>
            <span class="font-semibold">{{ $expense->created_at->format('M d, Y H:i') }}</span>
        </div>
        @if($expense->description)
        <div class="col-span-2">
            <span class="text-gray-600">Description:</span>
            <p class="mt-1">{{ $expense->description }}</p>
        </div>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('expenses.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Expenses</a>
    </div>
</div>
@endsection
