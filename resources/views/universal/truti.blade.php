@extends('layouts.app', ['title' => 'Oops! Something went wrong'])

@section('content')
<div class="flex flex-col items-center justify-center min-h-[70vh] text-center space-y-6">

    <!-- Error Code / Icon -->
    <div class="text-9xl font-extrabold text-gray-300 dark:text-gray-700">
        ⚠️
    </div>

    <!-- Error Message -->
    <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 dark:text-gray-100">
        Oops! Something went wrong
    </h1>

    <p class="text-gray-600 dark:text-gray-400 max-w-xl">
        We encountered an unexpected error. Please try again later or go back to the dashboard.
    </p>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row items-center gap-4">
        <a href="{{ url('/') }}"
            class="px-6 py-3 bg-primary text-white rounded-xl shadow hover:bg-primary-dark transition font-semibold">
            Go Home
        </a>

        @if(isset($errorCode))
        <span class="text-gray-500 dark:text-gray-400 text-sm">
            Error Code: {{ $errorCode }}
        </span>
        @endif
    </div>

</div>
@endsection