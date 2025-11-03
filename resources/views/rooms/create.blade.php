<!-- resources/views/rooms/create.blade.php -->
@extends('layouts.app')
@section('content')
<h2>Create Viva Room</h2>
<form method="POST" action="/room">
 @csrf
 <div><label>Title</label><input name="title"/></div>
 <div><label>Zoom link</label><input name="zoom_link"/></div>
 <div><label>Expected minutes per student</label><input name="expected_duration_minutes" type="number" value="5"/></div>
 <button>Create</button>
</form>
@endsection
