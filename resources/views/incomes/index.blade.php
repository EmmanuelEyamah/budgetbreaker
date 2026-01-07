@extends('layouts.app')

@section('title', 'Incomes')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">Incomes</h1>
    <a href="{{ route('incomes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Income</a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h2 class="text-xl font-semibold">All Incomes</h2>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-3 px-4">Date</th>
                        <th class="text-left py-3 px-4">Source</th>
                        <th class="text-right py-3 px-4">Amount</th>
                        <th class="text-right py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incomes as $income)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $income->received_at->format('M d, Y') }}</td>
                        <td class="py-3 px-4">{{ $income->source ?? '-' }}</td>
                        <td class="text-right py-3 px-4">₦{{ number_format($income->amount, 2) }}</td>
                        <td class="text-right py-3 px-4">
                            <a href="{{ route('incomes.show', $income) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">No incomes recorded yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $incomes->links() }}
        </div>
    </div>
</div>
@endsection
