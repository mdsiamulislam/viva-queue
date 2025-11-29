@extends('layouts.app')

@section('title', $room->title)

@section('content')
<div class="max-w-3xl mx-auto mt-10 flex flex-col gap-6">

    <!-- Room Info -->
    <div class="bg-white dark:bg-background-dark/50 border border-gray-200/80 dark:border-gray-700/50 rounded-xl shadow-sm p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $room->title }}</h2>
        <div class="mt-2 space-y-2">
            <p class="text-gray-600 dark:text-gray-400">
                Join Code:
                <span class="font-semibold text-gray-900 dark:text-white ml-2">{{ url($room->code) }}</span>
                <button type="button" onclick="navigator.clipboard.writeText('{{ url($room->code) }}')"
                    class="ml-3 bg-gray-200 dark:bg-gray-700 text-sm px-2 py-1 rounded-md hover:opacity-90">
                    Copy
                </button>
            </p>
            <p class="text-gray-600 dark:text-gray-400">
                Zoom Link:
                <a href="{{ $room->zoom_link }}" target="_blank" class="font-semibold text-primary underline ml-2 hover:opacity-80">
                    {{ \Illuminate\Support\Str::limit($room->zoom_link, 50) }}
                </a>
            </p>
        </div>
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
            <input name="name" placeholder="Your Roll Number Only" required
                class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary dark:bg-background-dark/70 dark:text-gray-200" />
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
    const defaultDurationSeconds = {{ $room->expected_duration_minutes * 60 }};

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

    // Calculate dynamic average from completed entries
    function calculateDynamicAverage(allEntries) {
        // Get all completed entries with both started_at and finished_at
        const completed = allEntries.filter(e =>
            e.status === 'done' &&
            e.started_at &&
            e.finished_at
        );

        if (completed.length === 0) {
            // No completed entries yet, use default
            return defaultDurationSeconds;
        }

        // Calculate actual duration for each completed entry
        const durations = completed.map(e => {
            const start = new Date(e.started_at);
            const end = new Date(e.finished_at);
            return (end - start) / 1000; // in seconds
        });

        // Calculate average
        const sum = durations.reduce((acc, val) => acc + val, 0);
        const average = sum / durations.length;

        // Return average, but ensure it's at least 30 seconds
        return Math.max(30, Math.round(average));
    }

    async function fetchQueue() {
        const res = await fetch(`/${roomCode}/queue`);
        const data = await res.json();

        const allEntries = data.entries; // All entries including 'done'
        const entries = allEntries.filter(e => e.status !== 'done');

        // Calculate dynamic average from completed entries
        const avgSeconds = calculateDynamicAverage(allEntries);

        const el = document.getElementById('queueArea');
        const urlParams = new URLSearchParams(window.location.search);
        const entryId = urlParams.get('entry');

        // Identify current active and first waiting
        const active = entries.find(e => e.status === 'in_progress');
        const firstWaiting = entries.find(e => e.status === 'waiting');

        let html = '';

        // User's Position Card (if user is in queue)
        if (entryId) {
            const me = entries.find(e => String(e.id) === entryId);
            if (me) {
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
                const cardColor = isActive ?
                    'bg-gradient-to-br from-yellow-400 via-orange-400 to-red-400 dark:from-yellow-600 dark:via-orange-600 dark:to-red-600' :
                    'bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-600';

                // Calculate progress percentage
                const totalWaitingAhead = entries.filter((e, idx) => idx < myIndex && e.status !== 'done').length;
                const totalInQueue = entries.length;
                const progressPercent = totalInQueue > 1 ? ((totalInQueue - pos) / (totalInQueue - 1)) * 100 : 100;

                // Circular countdown values
                const waitMinutes = Math.ceil(waitSeconds / 60);
                const circumference = 2 * Math.PI * 54; // radius = 54
                const strokeOffset = isActive ? 0 : circumference - (progressPercent / 100) * circumference;

                // Check if using dynamic or default average
                const completedCount = allEntries.filter(e => e.status === 'done' && e.started_at && e.finished_at).length;
                const avgSource = completedCount > 0 ? 'live avg' : 'expected';

                html += `
            <div class="mb-6 ${cardColor} text-white rounded-2xl shadow-2xl p-6 relative overflow-hidden">
                <!-- Animated background pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-0 w-40 h-40 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-32 h-32 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
                </div>
                
                <div class="relative flex items-center justify-between gap-6">
                    <!-- Left: Position Info -->
                    <div class="flex-1">
                        <p class="text-sm font-medium opacity-90 mb-1">Your Position in Queue</p>
                        <div class="flex items-baseline gap-2 mb-3">
                            <span class="text-5xl font-bold">#${pos}</span>
                            <span class="text-lg opacity-75">of ${totalInQueue}</span>
                        </div>
                        ${isActive ? `
                            <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-2 animate-pulse">
                                <span class="text-2xl">🎯</span>
                                <div>
                                    <p class="text-sm font-semibold">NOW SERVING</p>
                                    <p class="text-xs opacity-90">Please join the Zoom call</p>
                                </div>
                            </div>
                        ` : totalWaitingAhead > 0 ? `
                            <div class="space-y-1.5 bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="opacity-90">People ahead:</span>
                                    <span class="font-bold">${totalWaitingAhead}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="opacity-90">Avg time (${avgSource}):</span>
                                    <span class="font-bold">${Math.ceil(avgSeconds/60)} min</span>
                                </div>
                                ${completedCount > 0 ? `
                                    <div class="text-xs opacity-75 pt-1 border-t border-white/20">
                                        Based on ${completedCount} completed
                                    </div>
                                ` : ''}
                            </div>
                        ` : `
                            <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-2">
                                <span class="text-2xl">🎉</span>
                                <div>
                                    <p class="text-sm font-semibold">You're Next!</p>
                                    <p class="text-xs opacity-90">Get ready</p>
                                </div>
                            </div>
                        `}
                    </div>
                    
                    <!-- Right: Circular Timer -->
                    <div class="flex-shrink-0">
                        <div class="relative w-36 h-36">
                            <!-- SVG Circle Progress -->
                            <svg class="transform -rotate-90 w-full h-full">
                                <!-- Background circle -->
                                <circle cx="72" cy="72" r="54" 
                                        stroke="currentColor" 
                                        stroke-width="8" 
                                        fill="none" 
                                        class="text-white/20" />
                                <!-- Progress circle -->
                                <circle cx="72" cy="72" r="54" 
                                        stroke="currentColor" 
                                        stroke-width="8" 
                                        fill="none" 
                                        stroke-linecap="round"
                                        class="text-white transition-all duration-1000 ease-out ${isActive ? 'animate-pulse' : ''}"
                                        style="stroke-dasharray: ${circumference}; stroke-dashoffset: ${strokeOffset};" />
                            </svg>
                            
                            <!-- Center content -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                ${isActive ? `
                                    <div class="text-center animate-bounce">
                                        <div class="text-3xl mb-1">⏱️</div>
                                        <div class="text-xs font-semibold">ACTIVE</div>
                                    </div>
                                ` : `
                                    <div class="text-center">
                                        <div class="text-4xl font-bold leading-none">${waitMinutes}</div>
                                        <div class="text-xs font-semibold mt-1 opacity-90">
                                            ${waitMinutes === 1 ? 'MIN' : 'MINS'}
                                        </div>
                                        <div class="text-xs opacity-75 mt-0.5">wait</div>
                                    </div>
                                `}
                            </div>
                        </div>
                        
                        <!-- Progress label -->
                        <div class="text-center mt-2">
                            <div class="text-xs font-medium opacity-75">
                                ${isActive ? 'Being Served' : `${Math.round(progressPercent)}% done`}
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            }
        }

        // Queue Statistics for Admin
        if (isAdmin) {
            const waitingCount = entries.filter(e => e.status === 'waiting').length;
            const totalWaitTime = waitingCount * Math.ceil(avgSeconds / 60);
            const completedToday = allEntries.filter(e => e.status === 'done').length;
            const completedCount = allEntries.filter(e => e.status === 'done' && e.started_at && e.finished_at).length;

            html += `
        <div class="mb-4 grid grid-cols-4 gap-3">
            <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg text-center">
                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">${entries.length}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">In Queue</p>
            </div>
            <div class="bg-yellow-50 dark:bg-yellow-900/30 p-3 rounded-lg text-center">
                <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">${active ? 1 : 0}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Serving</p>
            </div>
            <div class="bg-green-50 dark:bg-green-900/30 p-3 rounded-lg text-center">
                <p class="text-2xl font-bold text-green-600 dark:text-green-400">${completedToday}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Completed</p>
            </div>
            <div class="bg-purple-50 dark:bg-purple-900/30 p-3 rounded-lg text-center">
                <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">~${totalWaitTime}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Min Left</p>
            </div>
        </div>
        
        <!-- Average Time Info -->
        <div class="mb-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg p-3 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        ${completedCount > 0 ? '📊 Live Avg Time:' : '⏱️ Expected Avg Time:'}
                    </span>
                    <span class="text-lg font-bold text-primary">
                        ${Math.ceil(avgSeconds / 60)} min
                    </span>
                </div>
                ${completedCount > 0 ? `
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        From ${completedCount} completed student${completedCount > 1 ? 's' : ''}
                    </span>
                ` : `
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        No completions yet
                    </span>
                `}
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

                const startBtnStyle = canStart ?
                    'bg-blue-500 hover:bg-blue-600 cursor-pointer' :
                    'bg-gray-300 dark:bg-gray-700 cursor-not-allowed opacity-50';
                const doneBtnStyle = canDone ?
                    'bg-green-500 hover:bg-green-600 cursor-pointer' :
                    'bg-gray-300 dark:bg-gray-700 cursor-not-allowed opacity-50';

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
    function startEntry(id) {
        if (!confirm('Start serving this student?')) return;

        fetch(`/${roomCode}/entry/${id}/start`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
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

    function finishEntry(id) {
        if (!confirm('Mark this student as done?')) return;

        fetch(`/${roomCode}/entry/${id}/done`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
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

    function removeEntry(id) {
        if (!confirm('Remove this student from queue? This cannot be undone.')) return;

        fetch(`/${roomCode}/entry/${id}/remove`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
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
