@extends('salsabil.layout')

@section('content')

<!-- Stats -->
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm">
        <p class="text-sm text-gray-500">Blogs</p>
        <h2 class="text-2xl font-semibold mt-2">24</h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm">
        <p class="text-sm text-gray-500">Audios</p>
        <h2 class="text-2xl font-semibold mt-2">18</h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm">
        <p class="text-sm text-gray-500">Videos</p>
        <h2 class="text-2xl font-semibold mt-2">12</h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm">
        <p class="text-sm text-gray-500">Posters</p>
        <h2 class="text-2xl font-semibold mt-2">36</h2>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white p-6 rounded-xl shadow-sm">
    <h3 class="text-lg font-semibold mb-4">
        Quick Actions
    </h3>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
        <a href="#" class="border rounded-lg p-4 hover:bg-green-50">
            ➕ Add Blog
        </a>
        <a href="#" class="border rounded-lg p-4 hover:bg-green-50">
            🎧 Upload Audio
        </a>
        <a href="#" class="border rounded-lg p-4 hover:bg-green-50">
            🎥 Upload Video
        </a>
        <a href="#" class="border rounded-lg p-4 hover:bg-green-50">
            📰 Add News
        </a>
        <a href="#" class="border rounded-lg p-4 hover:bg-green-50">
            🖼️ Upload Poster
        </a>
    </div>
</div>

@endsection