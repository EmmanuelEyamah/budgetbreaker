@extends('layouts.app')

@section('title', 'Add Income')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Add Income</h1>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    @if($totalPercentage != 100)
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
            Warning: Category percentages total {{ number_format($totalPercentage, 2) }}%. Must be 100% to add income.
        </div>
    @endif

    <form action="{{ route('incomes.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required min="0.01">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Source</label>
            <input type="text" name="source" value="{{ old('source') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="3" class="shadow border rounded w-full py-2 px-3 text-gray-700">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Date Received</label>
            <input type="date" name="received_at" value="{{ old('received_at', date('Y-m-d')) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="bg-gray-50 p-4 rounded mb-4">
            <h3 class="font-semibold mb-2">Allocation Preview</h3>
            @foreach($categories as $category)
            <div class="mb-3">
                <div class="flex justify-between items-center cursor-pointer" onclick="toggleAccordion('preview-{{ $category->id }}')">
                    <span class="font-medium">{{ $category->name }}</span>
                    <span class="text-sm">{{ number_format($category->percentage, 2) }}%</span>
                </div>
                <div id="preview-{{ $category->id }}" class="hidden mt-2 ml-4 space-y-1">
                    @foreach($category->children as $sub)
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>{{ $sub->name }}</span>
                        <span>{{ number_format($sub->percentage, 2) }}%</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <script>
        function toggleAccordion(id) {
            const element = document.getElementById(id);
            element.classList.toggle('hidden');
        }
        </script>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" @if($totalPercentage != 100) disabled @endif>Add Income</button>
            <a href="{{ route('incomes.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
        </div>
    </form>
</div>
@endsection
