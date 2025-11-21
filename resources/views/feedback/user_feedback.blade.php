@extends('layouts.userapp', ['title' => 'Submit Feedback for Improvement . Please describe your problem.'])

@section('content')
<div class="container">

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf

        <div class="max-w-xl mx-auto bg-white shadow-md rounded-xl p-6 border border-green-200">

            <h2 class="text-2xl font-semibold text-green-700 mb-5">Submit CR Feedback</h2>

            <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full mt-1 px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Roll -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Roll</label>
                    <input type="number" name="roll" required
                        class="w-full mt-1 px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="number" name="phone" required
                        class="w-full mt-1 px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email (optional)</label>
                    <input type="email" name="email"
                        class="w-full mt-1 px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Problem Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Problem Type</label>
                    <input type="text" name="problem_type" required
                        class="w-full mt-1 px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Problem Details -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Problem Details</label>
                    <textarea name="problem_details" rows="4" required
                        class="w-full mt-1 px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                </div>

                <!-- Suggestion -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Any Suggestion or Proposed Solution? (optional)</label>
                    <textarea name="solution_proposal" rows="3"
                        class="w-full mt-1 px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                </div>

                <!-- Anonymous -->
                <div class="flex items-center gap-2">
                    <input id="anony" type="checkbox" name="is_anonymous" value="1" checked
                        class="h-4 w-4 text-green-600 border-green-300 rounded focus:ring-green-500">
                    <label for="anony" class="text-sm text-gray-700">Submit Anonymously</label>
                </div>

                <!-- Submit Button -->
                <button
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-semibold transition">
                    Submit Feedback
                </button>

            </form>
        </div>

    </form>
</div>
@endsection