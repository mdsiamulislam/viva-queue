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
                    <label for="file-upload"
                        class="cursor-pointer bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                        <i class="fas fa-upload"></i> Import
                    </label>
                    <input id="file-upload" type="file" name="file" class="hidden"
                        onchange="document.getElementById('import-form').submit()">
                </form>
                <a href="{{ route('students.export') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
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

        <!-- Statistics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center card-hover">
                <div>
                    <h3 class="text-sm text-gray-500">Total Students</h3>
                    <p class="text-2xl font-bold text-indigo-600">{{ $totalStudents }}</p>
                </div>
                <i class="fa-solid fa-users text-indigo-500 text-3xl"></i>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center card-hover">
                <div>
                    <h3 class="text-sm text-gray-500">Unique Students (Email/Phone)</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $uniqueStudents }}</p>
                </div>
                <i class="fa-solid fa-user-check text-green-500 text-3xl"></i>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center card-hover">
                <div>
                    <h3 class="text-sm text-gray-500">Courses Offered</h3>
                    <p class="text-2xl font-bold text-amber-600">{{ count($studentsByCourse) }}</p>
                </div>
                <i class="fa-solid fa-book text-amber-500 text-3xl"></i>
            </div>
        </div>

        <!-- Students by Course -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Students by Course</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach($studentsByCourse as $course => $count)
                <div class="bg-indigo-50 border-l-4 border-indigo-400 rounded p-3 flex justify-between items-center">
                    <span class="font-medium text-gray-700">{{ $course ?: 'N/A' }}</span>
                    <span class="font-semibold text-indigo-700">{{ $count }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Filters -->
        <div class="flex flex-col lg:flex-row gap-4 mb-4 items-center justify-between">
            <input type="text" id="search-input" placeholder="Search by name, email, phone..."
                class="px-4 py-2 border rounded-lg w-full lg:w-1/3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

            <div class="flex gap-2 flex-wrap">
                <select id="course-filter"
                    class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Courses</option>
                    @foreach($studentsByCourse as $course => $count)
                    <option value="{{ $course }}">{{ $course }}</option>
                    @endforeach
                </select>
                <button onclick="clearFilters()"
                    class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Clear</button>
            </div>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3 text-left">Full Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Phone</th>
                        <th class="px-6 py-3 text-left">Gender</th>
                        <th class="px-6 py-3 text-left">Date of Birth</th>
                        <th class="px-6 py-3 text-left">Admission For</th>
                        <th class="px-6 py-3 text-left">Courses</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                    @foreach($students as $student)
                    <tr class="table-row-hover">
                        <td class="px-6 py-4">{{ $student->full_name }}</td>
                        <td class="px-6 py-4">{{ $student->email }}</td>
                        <td class="px-6 py-4">{{ $student->mobile_number }}</td>
                        <td class="px-6 py-4 capitalize">{{ $student->gender }}</td>
                        <td class="px-6 py-4">{{ optional($student->date_of_birth)->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ $student->admission_for }}</td>
                        <td class="px-6 py-4">
                            @if(is_array($student->selected_courses))
                            {{ implode(', ', $student->selected_courses) }}
                            @else
                            {{ $student->selected_courses }}
                            @endif
                        </td>
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
        const courseFilter = document.getElementById('course-filter');

        function filterStudents() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCourse = courseFilter.value;

            const rows = document.querySelectorAll('#table-body tr');
            rows.forEach(row => {
                const name = row.children[0].textContent.toLowerCase();
                const email = row.children[1].textContent.toLowerCase();
                const phone = row.children[2].textContent.toLowerCase();
                const course = row.children[6].textContent;

                const matchesSearch =
                    name.includes(searchTerm) || email.includes(searchTerm) || phone.includes(searchTerm);
                const matchesCourse = !selectedCourse || course.includes(selectedCourse);

                row.style.display = matchesSearch && matchesCourse ? '' : 'none';
            });
        }

        function clearFilters() {
            searchInput.value = '';
            courseFilter.value = '';
            filterStudents();
        }

        searchInput.addEventListener('input', filterStudents);
        courseFilter.addEventListener('change', filterStudents);
    </script>
</body>

</html>