@extends('layouts.app', ['title' => 'Get Together Manager'])

@section('content')

<div class="max-w-full mx-auto space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Get Together Manager
        </h1>

        <!-- Import + Export -->
        <div class="inline-flex items-center gap-3">

            <!-- Import -->
            <label for="import_students"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 
                       hover:from-green-600 hover:to-emerald-700 text-white rounded-full shadow-md text-sm 
                       font-semibold cursor-pointer transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12" />
                </svg>
                <span>Import</span>
                <span class="ml-2 px-2 py-0.5 bg-white/20 text-xs rounded-full">CSV · XLSX</span>
            </label>
            <input id="import_students" type="file" accept=".csv,.xlsx" class="hidden" />


            <!-- Export -->
            <details class="relative">
                <summary
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border 
                           border-gray-200 dark:border-gray-700 rounded-full shadow-sm text-sm 
                           text-gray-700 dark:text-gray-200 cursor-pointer select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v12m0 0l4-4m-4 4-4-4M21 21H3" />
                    </svg>
                    <span>Export</span>
                </summary>

                <div
                    class="absolute right-0 mt-2 w-44 bg-white dark:bg-gray-900 border border-gray-200 
                           dark:border-gray-800 rounded-lg shadow-lg py-1 z-10">
                    <button class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800">
                        Export as CSV
                    </button>
                    <button class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800">
                        Export as XLSX
                    </button>
                    <button class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800">
                        Export as PDF
                    </button>
                </div>
            </details>

        </div>
    </div>

    <!-- TABLE CARD -->
    <div
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-md p-5">
        <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Student List</h2>

        <div class="overflow-x-auto w-full">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-800 text-left text-sm text-gray-600 dark:text-gray-300">
                        <th class="p-3">Name</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Batch</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-700 dark:text-gray-300">

                    @foreach ([
                    ['name' => 'Rakib Hasan', 'email' => 'rakib@example.com', 'batch' => 'Batch 12'],
                    ['name' => 'Mitu Akter', 'email' => 'mitu@example.com', 'batch' => 'Batch 11'],
                    ['name' => 'Soaib Ahmed', 'email' => 'soaib@example.com', 'batch' => 'Batch 10'],
                    ] as $student)

                    <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition">
                        <td class="p-3">{{ $student['name'] }}</td>
                        <td class="p-3">{{ $student['email'] }}</td>
                        <td class="p-3">{{ $student['batch'] }}</td>

                        <td class="p-3 text-center">
                            <div class="inline-flex gap-2">

                                <button
                                    class="px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-medium hover:bg-red-600">
                                    Delete
                                </button>

                                <button
                                    class="px-3 py-1.5 bg-yellow-500 text-white rounded-lg text-xs font-medium hover:bg-yellow-600">
                                    Edit
                                </button>

                                <button
                                    class="px-3 py-1.5 bg-green-600 text-white rounded-lg text-xs font-medium hover:bg-green-700">
                                    Invite
                                </button>

                            </div>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- IMPORT SCRIPT -->
<script>
    document.getElementById('import_students').addEventListener('change', function() {
        if (!this.files.length) return;

        let formData = new FormData();
        formData.append("file", this.files[0]);

        // Disable UI during upload
        const label = document.querySelector("label[for='import_students']");
        label.innerHTML = "Uploading...";
        label.classList.add("opacity-60", "pointer-events-none");

        fetch("{{ route('geto.import') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(res => res.json())
            .then(() => {
                window.location.href = "{{ route('students.import.status') }}";
            })
            .catch(() => {
                alert("Import failed. Please try again.");
                label.innerHTML = "Import";
                label.classList.remove("opacity-60", "pointer-events-none");
            });
    });
</script>

@endsection