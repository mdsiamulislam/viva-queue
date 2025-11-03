<!-- resources/views/join/index.blade.php -->
@extends('layouts.app')
@section('content')
<h2>{{ $room->title }}</h2>
<p>Zoom Link: <a href="{{ $room->zoom_link }}" target="_blank">Join Zoom</a></p>

@if(request()->has('joined'))
  <div class="alert">You joined the queue. Stay here and watch your position.</div>
@endif

<!-- if not joined, show join form -->
<form id="joinForm" method="POST" action="/v/{{ $room->code }}/join">
 @csrf
 <input name="name" placeholder="Your name or id" required>
 <button>Join Queue</button>
</form>

<hr>
<div id="queueArea">
  Loading queue...
</div>

<script>
const roomCode = "{{ $room->code }}";
async function fetchQueue(){
  const res = await fetch(`/v/${roomCode}/queue`);
  const data = await res.json();
  const entries = data.entries;
  const avg = data.room.avg_seconds;
  const el = document.getElementById('queueArea');
  // find my entry id from URL param? (optional)
  let html = `<p>Estimated per-student: ${Math.round(avg/60)} min</p>`;
  html += '<ol>';
  entries.forEach(e => {
    html += `<li>#${e.position ?? '-'} - ${e.name} (${e.status})</li>`;
  });
  html += '</ol>';
  // calculate your position and estimated wait if you are one of entries
  const urlParams = new URLSearchParams(window.location.search);
  const entryId = urlParams.get('entry');
  if(entryId){
    const my = entries.find(x => String(x.id) === entryId);
    if(my){
      const pos = my.position || entries.findIndex(x => x.id==entryId)+1;
      const waitSeconds = (pos - 1) * avg;
      html += `<p>Your position: #${pos}<br>Estimated wait: ~${Math.ceil(waitSeconds/60)} min</p>`;
    }
  }
  el.innerHTML = html;
}

fetchQueue();
setInterval(fetchQueue, 5000); // polling every 5s
</script>
@endsection
