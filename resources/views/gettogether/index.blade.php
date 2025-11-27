@extends('layouts.app', ['title' => 'Get Together Manager'])

@section('content')

<div class="max-w-full mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Get Together Manager
        </h1>

        <!-- Import Button -->
        <button
            class="px-5 py-2 bg-primary text-white rounded-xl shadow-sm hover:bg-primary-dark active:scale-95 transition-all font-medium">
            Import
        </button>
    </div>

    <!-- Students Table -->
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-soft-lg p-5">
        <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Student List</h2>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-800 text-left text-sm text-gray-600 dark:text-gray-300">
                        <th class="p-3">Name</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Batch</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-700 dark:text-gray-300">

                    <!-- Example Row -->
                    @foreach ([
                    ['name' => 'Rakib Hasan', 'email' => 'rakib@example.com', 'batch' => 'Batch 12'],
                    ['name' => 'Mitu Akter', 'email' => 'mitu@example.com', 'batch' => 'Batch 11'],
                    ['name' => 'Soaib Ahmed', 'email' => 'soaib@example.com', 'batch' => 'Batch 10'],
                    ] as $student)

                    <tr
                        class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition">
                        <td class="p-3">{{ $student['name'] }}</td>
                        <td class="p-3">{{ $student['email'] }}</td>
                        <td class="p-3">{{ $student['batch'] }}</td>

                        <td class="p-3 text-center">
                            <div class="inline-flex gap-2">

                                <!-- Delete -->
                                <button
                                    class="px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-medium hover:bg-red-600 active:scale-95 transition">
                                    Delete
                                </button>

                                <!-- Edit -->
                                <button
                                    class="px-3 py-1.5 bg-yellow-500 text-white rounded-lg text-xs font-medium hover:bg-yellow-600 active:scale-95 transition">
                                    Edit
                                </button>

                                <!-- Invite -->
                                <button
                                    class="px-3 py-1.5 bg-green-600 text-white rounded-lg text-xs font-medium hover:bg-green-700 active:scale-95 transition">
                                    Invite
                                </button>

                            </div>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection