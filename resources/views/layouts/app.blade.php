<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BudgetBreaker')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex space-x-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 text-gray-700 hover:text-gray-900">Dashboard</a>
                    <a href="{{ route('categories.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:text-gray-900">Categories</a>
                    <a href="{{ route('incomes.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:text-gray-900">Incomes</a>
                    <a href="{{ route('expenses.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:text-gray-900">Expenses</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
