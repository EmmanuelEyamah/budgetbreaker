@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Create Category</h1>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Category Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Percentage</label>
            <input type="number" step="0.01" name="percentage" value="{{ old('percentage') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required min="0.01" max="{{ $availablePercentage }}">
            <p class="text-gray-600 text-sm mt-1">Available: {{ number_format($availablePercentage, 2) }}%</p>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Category</button>
            <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
        </div>
    </form>
</div>
@endsection
