@extends('layouts.app')

@section('title', 'All Viva Rooms')

@section('content')
<div class="flex flex-col gap-6">

    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">All Viva Rooms</h1>
        <Button
            onclick="location.href='{{ route('rooms.create') }}'"
            class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg hover:opacity-90 transition-opacity">
            <span class="material-symbols-outlined">add</span>
            <span>Create New Room</span>
        </Button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-6">
        @forelse($rooms as $room)
            <div class="flex flex-col gap-4 bg-white dark:bg-background-dark/50 border border-gray-200/80 dark:border-gray-700/50 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="p-4 flex flex-col gap-2">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $room->title }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Code: {{ $room->code }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Expected Duration: {{ $room->expected_duration_minutes }} min</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Zoom Link: 
                        <a href="{{ $room->zoom_link }}" target="_blank" class="text-primary underline hover:opacity-80">{{ $room->zoom_link }}</a>
                    </p>
                </div>
                <div class="flex justify-end gap-2 p-4 border-t border-gray-200/80 dark:border-gray-700/50">
                    <a href="{{ route('join.page', ['code' => $room->code]) }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-2 justify-center rounded-md h-8 px-3 bg-primary text-white hover:opacity-90 transition-colors">
                         <span class="material-symbols-outlined text-xl">launch</span>
                         <span>Join</span>
                    </a>
                    <button
                        onclick="location.href='{{ route('room.delete', ['id' => $room->id]) }}'"
                        class="flex items-center justify-center rounded-md h-8 w-8 text-red-500 hover:bg-red-500/10 dark:hover:bg-red-500/20 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                        <span class="material-symbols-outlined text-xl">delete</span>
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 text-gray-600 dark:text-gray-400">
                No Viva Rooms available. Create one to get started.
            </div>
        @endforelse
    </div>

</div>
@endsection
