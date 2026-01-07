@extends('layouts.app')

@section('title', 'Income Details')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Income Details</h1>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-4">Income Information</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <span class="text-gray-600">Amount:</span>
                <span class="font-semibold">₦{{ number_format($income->amount, 2) }}</span>
            </div>
            <div>
                <span class="text-gray-600">Date:</span>
                <span class="font-semibold">{{ $income->received_at->format('M d, Y') }}</span>
            </div>
            @if($income->source)
            <div class="col-span-2">
                <span class="text-gray-600">Source:</span>
                <span class="font-semibold">{{ $income->source }}</span>
            </div>
            @endif
            @if($income->description)
            <div class="col-span-2">
                <span class="text-gray-600">Description:</span>
                <p class="mt-1">{{ $income->description }}</p>
            </div>
            @endif
        </div>
    </div>

    <div class="border-t pt-6">
        <h2 class="text-xl font-semibold mb-4">Allocations</h2>
        <table class="min-w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-3 px-4">Category</th>
                    <th class="text-right py-3 px-4">Percentage</th>
                    <th class="text-right py-3 px-4">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($income->allocations as $allocation)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $allocation->category->name }}</td>
                    <td class="text-right py-3 px-4">{{ number_format($allocation->percentage_used, 2) }}%</td>
                    <td class="text-right py-3 px-4">₦{{ number_format($allocation->allocated_amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('incomes.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Incomes</a>
    </div>
</div>
@endsection
