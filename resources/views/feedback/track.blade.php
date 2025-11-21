@extends('layouts.userapp' , ['title' => 'Track Feedback'])

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">

    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tracking Info -->
    <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
        <h2 class="text-2xl font-semibold mb-4">Feedback Tracking</h2>

        <p class="text-gray-600 mb-6">
            Use this Tracking ID to check progress anytime:
        </p>

        <div class="flex items-center justify-between bg-gray-100 border rounded p-4 mb-6">
            <span class="font-mono text-lg">{{ $trackingId }}</span>
        </div>

        <h3 class="text-xl font-semibold mb-3">Feedback Details</h3>

        <div class="space-y-3 text-gray-700">
            <p><strong>Problem Type:</strong> {{ $feedback->problem_type }}</p>

            <p><strong>Name:</strong>
                @if($feedback->is_anonymous)
                Anonymous
                @else
                {{ $feedback->name }}
                @endif
            </p>

            <p><strong>Roll:</strong> {{ $feedback->roll }}</p>
            <p><strong>Phone:</strong> {{ $feedback->phone }}</p>
            <p><strong>Email:</strong> {{ $feedback->email ?? 'N/A' }}</p>

            <p><strong>Problem Details:</strong><br>{{ $feedback->problem_details }}</p>

            <p><strong>Proposed Solution:</strong><br>{{ $feedback->solution_proposal ?? 'N/A' }}</p>

            <p><strong>Problem Solution:</strong><br>{{ $feedback->solution_from_admin }}</p>

            <p class="px-3 py-1 text-sm bg-blue-100">
                <strong>Status:</strong>
                <span class="px-3 py-1 text-sm rounded bg-blue-100 text-blue-700">
                    {{ $feedback->solution_status ?? 'Pending' }}
                </span>
            </p>
        </div>

    </div>

</div>
@endsection