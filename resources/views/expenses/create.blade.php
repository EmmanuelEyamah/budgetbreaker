@extends('layouts.app')

@section('title', 'Record Expense')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Record Expense</h1>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Subcategory</label>
            <select name="category_id" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                <option value="">Select Subcategory</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->parent->name }} → {{ $category->name }} (Balance: ₦{{ number_format($category->current_balance, 2) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required min="0.01">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="3" class="shadow border rounded w-full py-2 px-3 text-gray-700">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Date Spent</label>
            <input type="date" name="spent_at" value="{{ old('spent_at', date('Y-m-d')) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Record Expense</button>
            <a href="{{ route('expenses.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
        </div>
    </form>
</div>
@endsection
