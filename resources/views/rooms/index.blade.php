@extends('layouts.app')

@section('title', 'All Viva Rooms')

@section('content')
<div class="flex flex-col gap-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">All Viva Rooms</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm">
                Manage or join available viva rooms. Click a room to view details or enter.
            </p>
        </div>

        @if(isset($isAdmin) && $isAdmin)
            <button
                onclick="location.href='{{ route('rooms.create') }}'"
                class="flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-lg hover:bg-primary/90 shadow-md transition">
                <span class="material-symbols-outlined">add_circle</span>
                <span>Create New Room</span>
            </button>
        @endif
    </div>

    <!-- Rooms Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($rooms as $room)
            <div class="group flex flex-col bg-white dark:bg-background-dark/60 border border-gray-200/80 dark:border-gray-700/50 rounded-xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                
                <!-- Card Header -->
                <div class="bg-gray-50 dark:bg-gray-800/50 p-4 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors">
                        {{ $room->title }}
                    </h2>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                        Code: {{ $room->code }}
                    </span>
                </div>

                <!-- Room Info -->
                <div class="p-5 flex flex-col gap-2 text-sm text-gray-700 dark:text-gray-300">
            
                    <div class="flex justify-between">
                        <span class="font-medium">Start Time:</span>
                        <span>{{ $room->start_time }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Start Date:</span>
                        <span>{{ $room->start_date }}</span>
                    </div>

                    <hr class="my-3 border-gray-200 dark:border-gray-700">

                    <div class="text-xs text-gray-500 dark:text-gray-400 space-y-1">
                        <p>Created: <span class="font-medium">{{ $room->created_at->format('F j, Y, g:i a') }}</span></p>
                        <p>Updated: <span class="font-medium">{{ $room->updated_at->format('F j, Y, g:i a') }}</span></p>
                    </div>
                </div>

                <!-- Zoom & Room Link -->
                <div class="px-5 pb-4 space-y-2">
                    @if($room->zoom_link)
                        <div class="text-sm">
                            <span class="font-medium text-gray-700 dark:text-gray-300">Zoom Link:</span><br>
                            <a href="{{ $room->zoom_link }}" target="_blank"
                               class="text-primary underline hover:opacity-80 text-sm">
                                {{ \Illuminate\Support\Str::limit($room->zoom_link, 50) }}
                            </a>
                        </div>
                    @endif

                    <div class="text-sm">
                        <span class="font-medium text-gray-700 dark:text-gray-300">Room Join Link:</span>
                        <div class="relative mt-1">
                            <input type="text" 
                                id="room-link-{{ $room->id }}"
                                value="{{ route('join.page', ['code' => $room->code]) }}" 
                                readonly
                                class="w-full text-xs border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-2 pr-10 focus:ring-2 focus:ring-primary focus:border-primary transition">
                            <button 
                                onclick="copyRoomLink({{ $room->id }})"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-primary hover:text-primary/80">
                                <span class="material-symbols-outlined text-base">content_copy</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center border-t border-gray-200 dark:border-gray-700 px-4 py-3 bg-gray-50/80 dark:bg-gray-800/40">
                    @if(isset($isAdmin) && $isAdmin)
                        <a href="{{ route('join.page.admin', ['code' => $room->code, 'pin' => $room->admin_pin]) }}"
                           class="flex items-center gap-2 bg-primary text-white px-3 py-1.5 rounded-md text-sm hover:bg-primary/90 transition">
                            <span class="material-symbols-outlined text-base">admin_panel_settings</span>
                            <span>Take Control</span>
                        </a>
                    @else
                        <a href="{{ route('join.page', ['code' => $room->code]) }}" target="_blank"
                           class="flex items-center gap-2 bg-primary text-white px-3 py-1.5 rounded-md text-sm hover:bg-primary/90 transition">
                            <span class="material-symbols-outlined text-base">launch</span>
                            <span>Join Room</span>
                        </a>
                    @endif

                    @if(isset($isAdmin) && $isAdmin)
                        <button
                            onclick="confirmDelete('{{ route('room.delete', ['id' => $room->id]) }}')"
                            class="text-red-500 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 text-gray-600 dark:text-gray-400">
                No Viva Rooms available. Create one to get started.
            </div>
        @endforelse
    </div>

</div>

<!-- Copy & Delete Scripts -->
<script>
    function copyRoomLink(id) {
        const input = document.getElementById(`room-link-${id}`);
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert('✅ Room link copied to clipboard!');
    }

    function confirmDelete(url) {
        if (confirm('Are you sure you want to delete this room? This action cannot be undone.')) {
            window.location.href = url;
        }
    }
</script>
@endsection
