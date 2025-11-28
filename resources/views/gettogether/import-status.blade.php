@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow">

    <h1 class="text-xl font-bold mb-4">Import Summary</h1>

    <p class="text-green-600 font-semibold">
        Successfully Imported: {{ session('success_count') }}
    </p>

    @if (count(session('duplicates', [])))
        <p class="text-red-600 mt-4 font-semibold">Duplicate IDs Found:</p>
        <ul class="list-disc ml-6 mt-2 text-red-500">
            @foreach (session('duplicates') as $id)
                <li>{{ $id }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('gettogether.index') }}"
       class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">
       Back to Dashboard
    </a>

</div>
@endsection
