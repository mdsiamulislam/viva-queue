@extends('layouts.app')

@section('title', $room->title)

@section('content')
<div class="max-w-2xl mx-auto mt-10 flex flex-col gap-6">

    <!-- Room Info -->
    <div class="bg-white dark:bg-background-dark/50 border border-gray-200/80 dark:border-gray-700/50 rounded-xl shadow-sm p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $room->title }}</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">
            Zoom Link: 
            <a href="{{ $room->zoom_link }}" target="_blank" class="text-primary underline hover:opacity-80">Join Zoom</a>
        </p>
    </div>

    <!-- Joined Alert -->
    @if(request()->has('joined'))
        <div class="bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-md">
            You joined the queue. Stay here and watch your position.
        </div>
    @endif

    <!-- Join Form -->
    <div class="bg-white dark:bg-background-dark/50 border border-gray-200/80 dark:border-gray-700/50 rounded-xl shadow-sm p-6">
        <form id="joinForm" method="POST" action="/v/{{ $room->code }}/join" class="flex flex-col gap-4">
            @csrf
            <input name="name" placeholder="Your name or ID" required
                class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary dark:bg-background-dark/70 dark:text-gray-200"/>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg font-bold hover:opacity-90 transition-opacity">
                Join Queue
            </button>
        </form>
    </div>

    <!-- Queue List -->
    <div id="queueArea" class="bg-white dark:bg-background-dark/50 border border-gray-200/80 dark:border-gray-700/50 rounded-xl shadow-sm p-6 text-gray-800 dark:text-gray-200">
        Loading queue...
    </div>

</div>

<script>
const roomCode = "{{ $room->code }}";

async function fetchQueue(){
    const res = await fetch(`/v/${roomCode}/queue`);
    const data = await res.json();
    const entries = data.entries;
    const avg = data.room.avg_seconds;
    const el = document.getElementById('queueArea');

    let html = `<p class="mb-2 text-sm text-gray-600 dark:text-gray-400">Estimated per-student: <strong>${Math.round(avg/60)} min</strong></p>`;
    html += '<ol class="flex flex-col gap-2">';

    entries.forEach(e => {
        let statusColor = 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200';
        if(e.status === 'in progress') statusColor = 'bg-yellow-200 dark:bg-yellow-800 text-yellow-900 dark:text-yellow-200';
        if(e.status === 'finished') statusColor = 'bg-green-200 dark:bg-green-800 text-green-900 dark:text-green-200';
        html += `
        <li class="flex justify-between items-center p-3 border rounded-md ${statusColor}">
            <span>#${e.position ?? '-'} - ${e.name}</span>
            <span class="text-sm font-semibold capitalize">${e.status}</span>
        </li>`;
    });

    html += '</ol>';

    // Your position & wait time
    const urlParams = new URLSearchParams(window.location.search);
    const entryId = urlParams.get('entry');
    if(entryId){
        const my = entries.find(x => String(x.id) === entryId);
        if(my){
            const pos = my.position || entries.findIndex(x => x.id==entryId)+1;
            const waitSeconds = (pos - 1) * avg;
            html += `<p class="mt-3 text-gray-700 dark:text-gray-300">Your position: <strong>#${pos}</strong><br>Estimated wait: ~<strong>${Math.ceil(waitSeconds/60)} min</strong></p>`;
        }
    }

    el.innerHTML = html;
}

fetchQueue();
setInterval(fetchQueue, 5000);
</script>
@endsection
