@extends('layouts.userapp', ['title' => 'Submit Feedback for Improvement'])

@section('content')
<div class="container px-4 py-6">
    <div class="max-w-xl mx-auto bg-white shadow-md rounded-xl p-4 sm:p-6 border border-green-200">

        <h2 class="text-xl sm:text-2xl font-semibold text-green-700 mb-4 sm:mb-5">Submit CR Feedback</h2>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Success Message --}}
        @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base"
                    required>
            </div>

            <!-- Roll -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Roll</label>
                <input type="number" name="roll" value="{{ old('roll') }}" required
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base">
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" required pattern="[0-9]{8,15}"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email (optional)</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base">
            </div>

            <!-- Problem Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Problem Type</label>
                <select name="problem_type" required
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-green-500 text-base appearance-none">
                    <option value="" disabled selected>Select a problem type</option>
                    <option value="Class" {{ old('problem_type')=='Class'?'selected':'' }}>Class</option>
                    <option value="Course" {{ old('problem_type')=='Course'?'selected':'' }}>Course</option>
                    <option value="Teacher" {{ old('problem_type')=='Teacher'?'selected':'' }}>Teacher</option>
                    <option value="Fees and Payment" {{ old('problem_type')=='Fees and Payment'?'selected':'' }}>Fees and Payment</option>
                    <option value="Management" {{ old('problem_type')=='Management'?'selected':'' }}>Management</option>
                    <option value="Time and Schedule" {{ old('problem_type')=='Time and Schedule'?'selected':'' }}>Time and Schedule</option>
                    <option value="Other" {{ old('problem_type')=='Other'?'selected':'' }}>Other</option>
                </select>
            </div>

            <!-- Problem Details -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Problem Details</label>
                <textarea name="problem_details" rows="4" required
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base resize-y">{{ old('problem_details') }}</textarea>
            </div>

            <!-- Suggestion -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Any Suggestion or Proposed Solution? (optional)</label>
                <textarea name="solution_proposal" rows="3"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-base resize-y">{{ old('solution_proposal') }}</textarea>
            </div>

            <!-- Anonymous -->
            <div class="flex items-center gap-2 py-2">
                <input id="anony" type="checkbox" name="is_anonymous" value="1" {{ old('is_anonymous', false) ? 'checked' : '' }}
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