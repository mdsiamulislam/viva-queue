<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .table-row-hover:hover {
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">Students Dashboard</h1>
            <div class="flex gap-2">
                <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" id="import-form">
                    @csrf
                    <label for="file-upload" class="cursor-pointer bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                        <i class="fas fa-upload"></i> Import
                    </label>
                    <input id="file-upload" type="file" name="file" class="hidden" onchange="document.getElementById('import-form').submit()">
                </form>
                <a href="{{ route('students.export') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
                    <i class="fas fa-file-excel"></i> Export
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow">
            {{ session('success') }}
        </div>
        @endif

        <!-- Filters -->
        <div class="flex flex-col lg:flex-row gap-4 mb-4 items-center justify-between">
            <input type="text" id="search-input" placeholder="Search by name, roll, phone..."
                class="px-4 py-2 border rounded-lg w-full lg:w-1/3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

            <div class="flex gap-2 flex-wrap">
                <select id="class-filter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Classes</option>
                </select>
                <select id="section-filter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Sections</option>
                </select>
                <button onclick="clearFilters()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Clear Filters</button>
            </div>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Roll</th>
                        <th class="px-6 py-3 text-left">Class</th>
                        <th class="px-6 py-3 text-left">Section</th>
                        <th class="px-6 py-3 text-left">Phone</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                    @foreach($students as $student)
                    <tr class="table-row-hover">
                        <td class="px-6 py-4">{{ $student->name }}</td>
                        <td class="px-6 py-4">{{ $student->roll }}</td>
                        <td class="px-6 py-4">{{ $student->class }}</td>
                        <td class="px-6 py-4">{{ $student->section }}</td>
                        <td class="px-6 py-4">{{ $student->phone }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>

    <script>
        let allStudents = @json($students->items());

        const searchInput = document.getElementById('search-input');
        const classFilter = document.getElementById('class-filter');
        const sectionFilter = document.getElementById('section-filter');

        function initializeFilters() {
            const classes = [...new Set(allStudents.map(s => s.class))].sort();
            const sections = [...new Set(allStudents.map(s => s.section))].sort();

            classes.forEach(c => {
                const option = document.createElement('option');
                option.value = c;
                option.textContent = `Class ${c}`;
                classFilter.appendChild(option);
            });

            sections.forEach(s => {
                const option = document.createElement('option');
                option.value = s;
                option.textContent = `Section ${s}`;
                sectionFilter.appendChild(option);
            });
        }

        function filterStudents() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedClass = classFilter.value;
            const selectedSection = sectionFilter.value;

            const rows = document.querySelectorAll('#table-body tr');
            rows.forEach(row => {
                const name = row.children[0].textContent.toLowerCase();
                const roll = row.children[1].textContent.toLowerCase();
                const cls = row.children[2].textContent;
                const section = row.children[3].textContent;

                const matchesSearch = name.includes(searchTerm) || roll.includes(searchTerm);
                const matchesClass = !selectedClass || cls === selectedClass;
                const matchesSection = !selectedSection || section === selectedSection;

                if (matchesSearch && matchesClass && matchesSection) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function clearFilters() {
            searchInput.value = '';
            classFilter.value = '';
            sectionFilter.value = '';
            filterStudents();
        }

        searchInput.addEventListener('input', filterStudents);
        classFilter.addEventListener('change', filterStudents);
        sectionFilter.addEventListener('change', filterStudents);

        document.addEventListener('DOMContentLoaded', initializeFilters);
    </script>
</body>

</html>