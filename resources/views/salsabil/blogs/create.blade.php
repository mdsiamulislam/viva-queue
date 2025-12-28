

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-sm">
    <h2 class="text-xl font-semibold mb-6">
        Add New Blog
    </h2>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded">
        {{ session('success') }}
    </div>
    @endif

    {{-- Blog Form --}}
    <form method="POST" action="{{ route('salsabil.blogs.store') }}">
        @csrf

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Blog Title
            </label>
            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-green-200"
                required>
        </div>

        <!-- Author -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Author
            </label>
            <input
                type="text"
                name="author"
                value="{{ old('author', 'Admin') }}"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        <!-- Content -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Content
            </label>
            <textarea
                name="content"
                rows="6"
                class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-green-200"
                required>{{ old('content') }}</textarea>
        </div>

        <!-- Image Path -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Image Path
            </label>
            <input
                type="text"
                name="image_path"
                value="{{ old('image_path') }}"
                placeholder="images/salsabil/blog1.png"
                class="w-full border rounded-lg px-4 py-2">
            <p class="text-xs text-gray-500 mt-1">
                Image must be inside <code>public/</code> folder
            </p>
        </div>

        <!-- Reference Link -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Reference Link
            </label>
            <input
                type="url"
                name="reference_link"
                value="{{ old('reference_link') }}"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        <!-- Tags -->
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">
                Tags
            </label>
            <input
                type="text"
                name="tags"
                value="{{ old('tags') }}"
                placeholder="Islam, Dua, Knowledge"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button
                type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Publish Blog
            </button>
        </div>
    </form>
</div>
