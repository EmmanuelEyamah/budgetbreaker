@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">Categories</h1>
    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Category</a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">All Categories</h2>
            <span class="text-gray-600">Total: {{ number_format($totalPercentage, 2) }}%</span>
        </div>
    </div>
    <div class="p-6">
        @forelse($categories as $category)
        <div class="mb-4 border rounded">
            <div class="bg-gray-50 px-4 py-3 flex justify-between items-center cursor-pointer" onclick="toggleAccordion('cat-{{ $category->id }}')">
                <div>
                    <span class="font-semibold">{{ $category->name }}</span>
                    <span class="text-gray-600 text-sm ml-2">({{ number_format($category->percentage, 2) }}%)</span>
                </div>
                <div class="text-right">
                    <span class="font-semibold">₦{{ number_format($category->children->sum('current_balance'), 2) }}</span>
                </div>
            </div>
            <div id="cat-{{ $category->id }}" class="hidden p-4">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 px-4 text-sm">Subcategory</th>
                            <th class="text-right py-2 px-4 text-sm">Percentage</th>
                            <th class="text-right py-2 px-4 text-sm">Balance</th>
                            <th class="text-right py-2 px-4 text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->children as $sub)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-sm">{{ $sub->name }}</td>
                            <td class="text-right py-2 px-4 text-sm">{{ number_format($sub->percentage, 2) }}%</td>
                            <td class="text-right py-2 px-4 text-sm">₦{{ number_format($sub->current_balance, 2) }}</td>
                            <td class="text-right py-2 px-4 text-sm">
                                <a href="{{ route('categories.edit', $sub) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                                <form action="{{ route('categories.destroy', $sub) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Deactivate this subcategory?')">Deactivate</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @empty
        <p class="text-center py-4 text-gray-500">No categories found</p>
        @endforelse
    </div>
</div>

<script>
function toggleAccordion(id) {
    const element = document.getElementById(id);
    element.classList.toggle('hidden');
}
</script>
@endsection
