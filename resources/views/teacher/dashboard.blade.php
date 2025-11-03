<!-- resources/views/teacher/dashboard.blade.php -->
@extends('layouts.app')
@section('content')
<h2>Teacher Dashboard: {{ $room->title }}</h2>
<p>Zoom: <a href="{{ $room->zoom_link }}" target="_blank">Open Zoom</a></p>

<table id="queueTable">
  <thead><tr><th>Pos</th><th>Name</th><th>Status</th><th>Action</th></tr></thead>
  <tbody></tbody>
</table>

<script>
const code = "{{ $room->code }}";
async function load(){
  const res = await fetch(`/v/${code}/queue`);
  const d = await res.json();
  const tbody = document.querySelector('#queueTable tbody');
  tbody.innerHTML = '';
  d.entries.forEach(e=>{
    const tr = document.createElement('tr');
    tr.innerHTML = `<td>${e.position ?? '-'}</td><td>${e.name}</td><td>${e.status}</td>
      <td>
        <button onclick="start(${e.id})">Start</button>
        <button onclick="done(${e.id})">Done</button>
        <button onclick="removeEntry(${e.id})">Remove</button>
      </td>`;
    tbody.appendChild(tr);
  });
}
async function start(id){
  await fetch(`/v/${code}/entry/${id}/start`,{method:'POST', headers:{'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
  load();
}
async function done(id){
  await fetch(`/v/${code}/entry/${id}/done`,{method:'POST', headers:{'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
  load();
}
async function removeEntry(id){
  await fetch(`/v/${code}/entry/${id}/remove`,{method:'POST', headers:{'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
  load();
}
load();
setInterval(load,5000);
</script>
@endsection
