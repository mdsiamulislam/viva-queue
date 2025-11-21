@extends('layouts.app')

@section('title', 'Manage Feedback')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <h2 class="text-3xl font-bold text-green-700 mb-6">All Feedbacks</h2>

    <!-- Table Container -->
    <div class="bg-white shadow-md rounded-xl border border-green-200 overflow-hidden">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-green-600">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Problem Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Action</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">

                @foreach ($feedbacks as $item)
                <tr class="hover:bg-green-50 transition">

                    <!-- Name -->
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                        @if($item->is_anonymous)
                        <span class="italic text-gray-500">Anonymous</span>
                        @else
                        {{ $item->name }}
                        @endif
                    </td>

                    <!-- Problem Type -->
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                        {{ $item->problem_type }}
                    </td>

                    <!-- Status -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="
                            px-3 py-1 rounded-full text-xs font-semibold
                            @if($item->solution_status == 'Pending') bg-yellow-200 text-yellow-800
                            @elseif($item->solution_status == 'In Progress') bg-blue-200 text-blue-800
                            @elseif($item->solution_status == 'Solved') bg-green-200 text-green-800
                            @else bg-red-200 text-red-800 @endif
                        ">
                            {{ $item->solution_status }}
                        </span>
                    </td>

                    <!-- Date -->
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 text-sm">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}
                    </td>

                    <!-- Button -->
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <a href="{{ route('feedback.adminEdit', $item->id) }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            Answer
                        </a>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>

@endsection