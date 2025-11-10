@extends('layouts.app')

@section('title', $room->title)

@section('content')
<div class="max-w-3xl mx-auto mt-10 flex flex-col gap-6">

    <!-- Room Info -->
    <div class="bg-white dark:bg-background-dark/50 border border-gray-200/80 dark:border-gray-700/50 rounded-xl shadow-sm p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $room->title }}</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">
            Room Code:
            <span class="inline-flex items-center">
            <input id="roomCodeInput" readonly value="{{ $room->code }}"
                   class="ml-2 px-2 py-1 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-800 text-sm dark:text-gray-200"/>
            <button id="copyBtn" type="button" onclick="copyRoomCode()"
                class="ml-2 bg-primary text-white px-3 py-1 rounded-md text-sm">
                Copy
            </button>
            </span>
        </p>
        <script>
        function copyRoomCode(){
            const code = document.getElementById('roomCodeInput').value;
            if (!navigator.clipboard) {
            // fallback
            const tmp = document.createElement('textarea');
            tmp.value = code;
            document.body.appendChild(tmp);
            tmp.select();
            try { document.execCommand('copy'); } catch (e) { alert('Copy failed'); }
            document.body.removeChild(tmp);
            return;
            }
            navigator.clipboard.writeText(code)
            .then(() => {
                const btn = document.getElementById('copyBtn');
                const prev = btn.innerText;
                btn.innerText = 'Copied';
                setTimeout(() => btn.innerText = prev, 2000);
            })
            .catch(() => alert('Unable to copy'));
        }
        </script>
        <p class="text-gray-600 dark:text-gray-400">
            Expected Duration per Student: <strong>{{ $room->expected_duration_minutes }} minutes</strong>
        </p>
        <p class="text-gray-600 dark:text-gray-400">
            Start Time: <strong>{{ \Carbon\Carbon::parse($room->start_date . ' ' . $room->start_time)->format('F j, Y, g:i A') }}</strong>
        </p>
    </div>

    <!-- Joined Alert -->
    @if(request()->has('joined'))
        <div class="bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-md">
            ✓ You joined the queue. Stay here and watch your position.
        </div>
    @endif

    <!-- Join Form -->
    @if(!request()->has('joined') && !$isAdmin)
        <div class="bg-white dark:bg-background-dark/50 border border-gray-200/80 dark:border-gray-700/50 rounded-xl shadow-sm p-6">
        <form id="joinForm" method="POST" action="/{{ $room->code }}/join" class="flex flex-col gap-4">
            @csrf
            <input name="name" placeholder="Your name or ID" required
                class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary dark:bg-background-dark/70 dark:text-gray-200"/>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg font-bold hover:opacity-90 transition-opacity">
                Join Queue
            </button>
        </form>
    </div>
    @endif

    <!-- Queue List -->
    <div id="queueArea" class="bg-white dark:bg-background-dark/50 border border-gray-200/80 dark:border-gray-700/50 rounded-xl shadow-sm p-6 text-gray-800 dark:text-gray-200">
        <div class="flex items-center justify-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
            <span class="ml-3">Loading queue...</span>
        </div>
    </div>

</div>

<script>
const roomCode = "{{ $room->code }}";
const isAdmin = {{ $isAdmin ? 'true' : 'false' }};

function calculateElapsedTime(startedAt) {
    if (!startedAt) return 0;
    const start = new Date(startedAt);
    const now = new Date();
    return Math.floor((now - start) / 1000); // seconds
}

function formatTime(seconds) {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    if (mins === 0) return `${secs}s`;
    return `${mins}m ${secs}s`;
}

function formatWaitTime(seconds) {
    const mins = Math.ceil(seconds / 60);
    if (mins < 1) return 'Less than 1 min';
    if (mins === 1) return '1 minute';
    return `${mins} minutes`;
}

async function fetchQueue(){
    const res = await fetch(`/${roomCode}/queue`);
    const data = await res.json();

    const entries = data.entries.filter(e => e.status !== 'done');
    const avgSeconds = data.room.avg_seconds || {{ $room->expected_duration_minutes * 60 }};
    const el = document.getElementById('queueArea');

    const urlParams = new URLSearchParams(window.location.search);
    const entryId = urlParams.get('entry');

    // Identify current active and first waiting
    const active = entries.find(e => e.status === 'in_progress');
    const firstWaiting = entries.find(e => e.status === 'waiting');

    let html = '';

    // User's Position Card (if user is in queue)
    if(entryId){
        const me = entries.find(e => String(e.id) === entryId);
        if(me){
            const myIndex = entries.findIndex(x => x.id == me.id);
            const pos = me.position || (myIndex + 1);
            
            // Calculate accurate wait time
            let waitSeconds = 0;
            if (active && active.id !== me.id) {
                // Add remaining time for active entry
                const elapsed = calculateElapsedTime(active.started_at);
                const remaining = Math.max(0, avgSeconds - elapsed);
                waitSeconds += remaining;
                
                // Add time for waiting entries before me
                const waitingBeforeMe = entries.filter((e, idx) => 
                    e.status === 'waiting' && idx < myIndex
                ).length;
                waitSeconds += waitingBeforeMe * avgSeconds;
            } else if (me.status === 'waiting') {
                // Count waiting entries before me
                const waitingBeforeMe = entries.filter((e, idx) => 
                    e.status === 'waiting' && idx < myIndex
                ).length;
                waitSeconds = waitingBeforeMe * avgSeconds;
            }

            const isActive = active && active.id == me.id;
            const cardColor = isActive 
                ? 'bg-gradient-to-r from-yellow-400 to-orange-400 dark:from-yellow-600 dark:to-orange-600' 
                : 'bg-gradient-to-r from-blue-500 to-purple-600';

            html += `
            <div class="mb-6 ${cardColor} text-white rounded-lg shadow-lg p-5">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <p class="text-sm font-medium opacity-90">Your Position</p>
                        <p class="text-4xl font-bold">#${pos}</p>
                    </div>
                    ${isActive ? `
                        <div class="text-right">
                            <p class="text-sm font-medium opacity-90">Status</p>
                            <p class="text-xl font-bold">🎯 NOW SERVING</p>
                        </div>
                    ` : `
                        <div class="text-right">
                            <p class="text-sm font-medium opacity-90">Estimated Wait</p>
                            <p class="text-3xl font-bold">~${formatWaitTime(waitSeconds)}</p>
                        </div>
                    `}
                </div>
                ${isActive ? `
                    <div class="mt-3 pt-3 border-t border-white/30">
                        <p class="text-sm font-medium">⏱️ You're being served now! Please join the Zoom call.</p>
                    </div>
                ` : waitSeconds > 0 ? `
                    <div class="mt-3 pt-3 border-t border-white/30">
                        <div class="flex items-center justify-between text-sm">
                            <span>${entries.filter((e, idx) => idx < myIndex && e.status !== 'done').length} people ahead</span>
                            <span>Avg: ${Math.ceil(avgSeconds/60)} min/person</span>
                        </div>
                    </div>
                ` : `
                    <div class="mt-3 pt-3 border-t border-white/30">
                        <p class="text-sm font-medium">🎉 You're next! Get ready.</p>
                    </div>
                `}
            </div>`;
        }
    }

    // Queue Statistics for Admin
    if (isAdmin) {
        const waitingCount = entries.filter(e => e.status === 'waiting').length;
        const totalWaitTime = waitingCount * Math.ceil(avgSeconds / 60);
        
        html += `
        <div class="mb-4 grid grid-cols-3 gap-3">
            <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg text-center">
                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">${entries.length}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Total in Queue</p>
            </div>
            <div class="bg-yellow-50 dark:bg-yellow-900/30 p-3 rounded-lg text-center">
                <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">${active ? 1 : 0}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Being Served</p>
            </div>
            <div class="bg-green-50 dark:bg-green-900/30 p-3 rounded-lg text-center">
                <p class="text-2xl font-bold text-green-600 dark:text-green-400">~${totalWaitTime}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Min Remaining</p>
            </div>
        </div>`;
    }

    // Queue List
    html += '<div class="space-y-2">';
    
    if (entries.length === 0) {
        html += `
        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
            <p class="text-lg">Queue is empty</p>
            <p class="text-sm mt-2">No one is waiting right now</p>
        </div>`;
    } else {
        entries.forEach((e, index) => {
            const isActiveEntry = active && e.id === active.id;
            const isMyEntry = entryId && e.id == entryId;
            const isNextEntry = firstWaiting && firstWaiting.id === e.id;
            
            // Status badge
            let statusBadge = '';
            let cardStyle = 'bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700';
            
            if (isActiveEntry) {
                const elapsed = calculateElapsedTime(e.started_at);
                cardStyle = 'bg-yellow-100 dark:bg-yellow-900/40 border-2 border-yellow-500 dark:border-yellow-600 shadow-lg';
                statusBadge = `
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-500 text-white">
                        🎯 IN PROGRESS • ${formatTime(elapsed)}
                    </span>`;
            } else if (isNextEntry) {
                cardStyle = 'bg-blue-50 dark:bg-blue-900/40 border-2 border-blue-500 dark:border-blue-600';
                statusBadge = `
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-500 text-white">
                        ⏭️ NEXT UP
                    </span>`;
            } else {
                statusBadge = `
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        ⏳ WAITING
                    </span>`;
            }

            if (isMyEntry && !isActiveEntry) {
                cardStyle += ' ring-2 ring-primary ring-offset-2 dark:ring-offset-gray-900';
            }

            // Admin buttons
            const canStart = isAdmin && firstWaiting && firstWaiting.id === e.id && !active;
            const canDone = isAdmin && active && active.id === e.id;
            
            const startBtnStyle = canStart 
                ? 'bg-blue-500 hover:bg-blue-600 cursor-pointer' 
                : 'bg-gray-300 dark:bg-gray-700 cursor-not-allowed opacity-50';
            const doneBtnStyle = canDone 
                ? 'bg-green-500 hover:bg-green-600 cursor-pointer' 
                : 'bg-gray-300 dark:bg-gray-700 cursor-not-allowed opacity-50';

            html += `
            <div class="${cardStyle} rounded-lg p-4 transition-all duration-200">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl font-bold text-gray-700 dark:text-gray-300">#${e.position ?? (index + 1)}</span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">${e.name}</span>
                            ${isMyEntry ? '<span class="text-xs bg-purple-500 text-white px-2 py-1 rounded-full">YOU</span>' : ''}
                        </div>
                        <div class="flex items-center gap-2">
                            ${statusBadge}
                        </div>
                        ${e.started_at ? `
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                ⏰ Started: ${new Date(e.started_at).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })}
                            </p>
                        ` : ''}
                    </div>
                    
                    ${isAdmin ? `
                        <div class="flex flex-col gap-2 ml-4">
                            <button onclick="startEntry(${e.id})" 
                                    class="${startBtnStyle} text-white px-4 py-1.5 rounded-md text-sm font-medium transition-colors"
                                    ${!canStart ? 'disabled' : ''}>
                                ▶️ Start
                            </button>
                            <button onclick="finishEntry(${e.id})" 
                                    class="${doneBtnStyle} text-white px-4 py-1.5 rounded-md text-sm font-medium transition-colors"
                                    ${!canDone ? 'disabled' : ''}>
                                ✓ Done
                            </button>
                            <button onclick="removeEntry(${e.id})" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-md text-sm font-medium transition-colors">
                                ✕ Remove
                            </button>
                        </div>
                    ` : ''}
                </div>
            </div>`;
        });
    }
    
    html += '</div>';
    el.innerHTML = html;
}

// Admin actions with confirmation
function startEntry(id){
    if (!confirm('Start serving this student?')) return;
    
    fetch(`/${roomCode}/entry/${id}/start`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'}
    })
    .then(res => res.json())
    .then(data => {
        if (data.error) alert(data.error);
        fetchQueue();
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Failed to start entry');
    });
}

function finishEntry(id){
    if (!confirm('Mark this student as done?')) return;
    
    fetch(`/${roomCode}/entry/${id}/done`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'}
    })
    .then(res => res.json())
    .then(data => {
        if (data.error) alert(data.error);
        fetchQueue();
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Failed to finish entry');
    });
}

function removeEntry(id){
    if (!confirm('Remove this student from queue? This cannot be undone.')) return;
    
    fetch(`/${roomCode}/entry/${id}/remove`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'}
    })
    .then(res => res.json())
    .then(data => {
        if (data.error) alert(data.error);
        fetchQueue();
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Failed to remove entry');
    });
}

// Auto-refresh every 3 seconds
fetchQueue();
const refreshInterval = setInterval(fetchQueue, 3000);

// Cleanup on page unload
window.addEventListener('beforeunload', () => {
    clearInterval(refreshInterval);
});
</script>
@endsection