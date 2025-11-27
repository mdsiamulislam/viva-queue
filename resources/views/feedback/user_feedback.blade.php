@extends('layouts.userapp', ['title' => 'Submit Feedback for Improvement . Please describe your problem.'])

@section('content')
<div class="container px-4 py-6">
    <div class="max-w-xl mx-auto bg-white shadow-md rounded-xl p-4 sm:p-6 border border-green-200">

        <h2 class="text-xl sm:text-2xl font-semibold text-green-700 mb-4 sm:mb-5">Submit CR Feedback</h2>

        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base">
            </div>

            <!-- Roll -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Roll</label>
                <input type="number" name="roll" required
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base">
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="tel" name="phone" required inputmode="numeric" pattern="[0-9]*"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email (optional)</label>
                <input type="email" name="email" inputmode="email"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base">
            </div>

            <!-- Problem Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Problem Type</label>
                <select name="problem_type" required
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-green-500 text-base appearance-none">
                    <option value="" disabled selected>Select a problem type</option>
                    <option value="Class">Class</option>
                    <option value="Course">Course</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Fees and Payment">Fees and Payment</option>
                    <option value="Management">Management</option>
                    <option value="Time and Schedule">Time and Schedule</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Problem Details -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Problem Details</label>
                <textarea name="problem_details" rows="4" required
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base resize-y"></textarea>
            </div>

            <!-- Suggestion -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Any Suggestion or Proposed Solution? (optional)</label>
                <textarea name="solution_proposal" rows="3"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base resize-y"></textarea>
            </div>

            <!-- Anonymous -->
            <div class="flex items-center gap-2 py-2">
                <input id="anony" type="checkbox" name="is_anonymous" value="1" checked
                    class="h-5 w-5 text-green-600 border-green-300 rounded focus:ring-green-500 cursor-pointer">
                <label for="anony" class="text-sm sm:text-base text-gray-700 cursor-pointer select-none">Submit Anonymously</label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 active:bg-green-800 text-white py-3 sm:py-3 rounded-lg font-semibold transition text-base touch-manipulation mt-2">
                Submit Feedback
            </button>

        </form>
    </div>
</div>
@endsection