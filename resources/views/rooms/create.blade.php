<!-- resources/views/rooms/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Viva Room')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-background-dark/50 border border-gray-200/80 dark:border-gray-700/50 rounded-xl shadow-sm p-6 mt-10">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Create Viva Room</h2>

    <form method="POST" action="/room" class="flex flex-col gap-4">
        @csrf

        <!-- Title -->
        <div class="flex flex-col">
            <label for="title" class="mb-1 font-medium text-gray-700 dark:text-gray-300">Room Title</label>
            <input id="title" name="title" type="text" required
                class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary dark:bg-background-dark/70 dark:text-gray-200"/>
        </div>

        <!-- Zoom Link -->
        <div class="flex flex-col">
            <label for="zoom_link" class="mb-1 font-medium text-gray-700 dark:text-gray-300">Zoom Link</label>
            <input id="zoom_link" name="zoom_link" type="url" required
                class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary dark:bg-background-dark/70 dark:text-gray-200"/>
        </div>

        <!-- Expected Duration -->
        <div class="flex flex-col">
            <label for="expected_duration_minutes" class="mb-1 font-medium text-gray-700 dark:text-gray-300">Expected Duration per Student (minutes)</label>
            <input id="expected_duration_minutes" name="expected_duration_minutes" type="number" min="1" value="5" required
                class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary dark:bg-background-dark/70 dark:text-gray-200"/>
        </div>

        <!-- Submit Button -->
        <button type="submit" 
            class="mt-4 bg-primary text-white px-4 py-2 rounded-lg font-bold hover:opacity-90 transition-opacity">
            Create Room
        </button>
    </form>
</div>
@endsection
