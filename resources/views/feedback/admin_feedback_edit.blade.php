@extends('layouts.app')

@section('content')
<div class="max-w-full mx-auto px-4 py-6 sm:px-6 lg:px-8 space-y-6">

    <!-- Title -->
    <h2 class="text-2xl sm:text-3xl font-bold text-green-700 text-center sm:text-left mb-6">
        Review Feedback
    </h2>

    <!-- Feedback Information Card -->
    <div class="bg-white shadow-md border border-green-200 rounded-xl p-4 sm:p-6 overflow-hidden">
        <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Feedback Information</h3>

        <div class="space-y-2 sm:space-y-3 text-gray-700 text-sm sm:text-base">

            <p><strong class="font-medium">Problem Type:</strong> {{ $feedback->problem_type }}</p>

            <p><strong class="font-medium">Name:</strong>
                {{ $feedback->name }}
            </p>

            <p><strong class="font-medium">Submitted Type:</strong>
                @if($feedback->is_anonymous)
                <span class="text-gray-500 italic">Anonymous</span>
                @else
                <span>Identified</span>
                @endif
            </p>

            <p><strong class="font-medium">Roll:</strong> {{ $feedback->roll }}</p>
            <p><strong class="font-medium">Phone:</strong> {{ $feedback->phone }}</p>
            <p><strong class="font-medium">Email:</strong> {{ $feedback->email ?? 'N/A' }}</p>

            <p>
                <strong class="font-medium">Problem Details:</strong>
                <span class="block bg-gray-50 border border-gray-200 rounded-md p-3 mt-1 break-words overflow-x-auto">
                    {{ $feedback->problem_details }}
                </span>
            </p>

            <p>
                <strong class="font-medium">Proposed Solution:</strong>
                <span class="block bg-gray-50 border border-gray-200 rounded-md p-3 mt-1 break-words overflow-x-auto">
                    {{ $feedback->solution_proposal ?? 'N/A' }}
                </span>
            </p>

            <p>
                <strong class="font-medium">Current Status:</strong>
                <span class="inline-block px-2 py-1 text-xs sm:text-sm rounded-full 
                    @if($feedback->solution_status == 'Pending') bg-yellow-200 text-yellow-800
                    @elseif($feedback->solution_status == 'In Progress') bg-blue-200 text-blue-800
                    @elseif($feedback->solution_status == 'Solved') bg-green-200 text-green-800
                    @else bg-red-200 text-red-800 @endif">
                    {{ $feedback->solution_status }}
                </span>
            </p>

        </div>
    </div>

    <!-- Admin Update Form -->
    <div class="bg-white shadow-md border border-green-200 rounded-xl p-4 sm:p-6 space-y-4 sm:space-y-5">
        <h3 class="text-lg sm:text-xl font-semibold text-green-700 mb-2 sm:mb-4">Admin Action</h3>

        <form action="{{ route('feedback.adminUpdate', $feedback->id) }}" method="POST" class="space-y-3 sm:space-y-4">
            @csrf
            @method('PUT')

            <!-- Status Dropdown -->
            <div>
                <label class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Solution Status</label>
                <select name="solution_status"
                    class="w-full border border-green-300 bg-white rounded-lg py-2 px-3 focus:ring-2 focus:ring-green-500 focus:outline-none text-sm sm:text-base"
                    required>
                    <option value="Pending" {{ $feedback->solution_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ $feedback->solution_status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Solved" {{ $feedback->solution_status == 'Solved' ? 'selected' : '' }}>Solved</option>
                    <option value="Rejected" {{ $feedback->solution_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <!-- Admin Solution -->
            <div>
                <label class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Admin Solution / Action</label>
                <textarea name="solution_from_admin" rows="4"
                    class="w-full border border-green-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none text-sm sm:text-base resize-y"></textarea>
            </div>

            <!-- Remarks -->
            <div>
                <label class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Remarks (optional)</label>
                <textarea name="remarks" rows="2"
                    class="w-full border border-green-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none text-sm sm:text-base resize-y"></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-2 sm:space-y-0">
                <button type="submit"
                    class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-semibold text-sm sm:text-base transition">
                    Update Feedback
                </button>

                <button type="button"
                    onclick="if(confirm('Are you sure you want to delete this feedback? This action cannot be undone.')) { window.location='{{ route('feedback.delete', $feedback->id) }}'; }"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-semibold text-sm sm:text-base transition">
                    Delete Feedback
                </button>
            </div>
        </form>
    </div>

</div>
@endsection