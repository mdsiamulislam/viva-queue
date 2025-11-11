<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.5s ease-out;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .table-row-hover:hover {
            background: linear-gradient(90deg, #f0f9ff 0%, #e0f2fe 100%);
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">

    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="animate-slide-in mb-8">
            <div class="gradient-bg rounded-2xl shadow-2xl p-8 text-white">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                    <div class="mb-6 md:mb-0">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-white bg-opacity-20 rounded-full p-3">
                                <i class="fas fa-user-graduate text-3xl"></i>
                            </div>
                            <div>
                                <h1 class="text-4xl font-bold">Students Dashboard</h1>
                                <p class="text-white text-opacity-90 mt-1">Manage your student database efficiently</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex gap-4">
                        <div class="bg-white bg-opacity-20 rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold" id="total-count">0</div>
                            <div class="text-sm opacity-90">Total Students</div>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold" id="filtered-count">0</div>
                            <div class="text-sm opacity-90">Filtered Results</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="glass-effect rounded-xl shadow-lg p-6 mb-6 animate-slide-in">
            <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                <!-- Search -->
                <div class="flex-1 w-full lg:w-auto">
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="search-input"
                            placeholder="Search by name, roll, phone..."
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:outline-none transition">
                    </div>
                </div>

                <!-- Filters -->
                <div class="flex flex-wrap gap-3">
                    <select id="class-filter"
                        class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:outline-none transition">
                        <option value="">All Classes</option>
                    </select>

                    <select id="section-filter"
                        class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:outline-none transition">
                        <option value="">All Sections</option>
                    </select>

                    <button onclick="clearFilters()" class="bg-gray-600 text-white px-6 py-3 rounded-xl hover:bg-gray-700 transition shadow-lg">
                        <i class="fas fa-redo mr-2"></i>Clear Filters
                    </button>
                </div>

                <!-- Upload & Export -->
                <div class="flex gap-3">
                    <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" id="import-form">
                        @csrf
                        <label for="file-upload" class="cursor-pointer bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition shadow-lg flex items-center gap-2">
                            <i class="fas fa-upload"></i>
                            <span>Import</span>
                        </label>
                        <input id="file-upload" type="file" name="file" class="hidden"
                            onchange="document.getElementById('import-form').submit()">
                    </form>

                    <a href="{{ route('students.export') }}"
                        class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 transition shadow-lg flex items-center gap-2">
                        <i class="fas fa-file-excel"></i>
                        <span>Export</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 animate-slide-in">
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-md flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Students Grid/Table Toggle -->
        <div class="mb-4 flex justify-end gap-2">
            <button onclick="toggleView('table')" id="table-view-btn"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg transition">
                <i class="fas fa-table"></i> Table View
            </button>
            <button onclick="toggleView('grid')" id="grid-view-btn"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg transition">
                <i class="fas fa-th-large"></i> Grid View
            </button>
        </div>

        <!-- Table View -->
        <div id="table-view" class="glass-effect rounded-xl shadow-2xl overflow-hidden animate-slide-in">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-user mr-2"></i>Name
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-id-card mr-2"></i>Roll
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-school mr-2"></i>Class
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-layer-group mr-2"></i>Section
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-phone mr-2"></i>Phone
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-cog mr-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="bg-white divide-y divide-gray-100">
                        <!-- Will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Grid View -->
        <div id="grid-view" class="hidden">
            <div id="grid-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Will be populated by JavaScript -->
            </div>
        </div>

        <!-- No Results Message -->
        <div id="no-results" class="hidden glass-effect rounded-xl shadow-2xl p-12 text-center">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-3"></i>
            <p class="text-gray-500 text-lg">No students found.</p>
            <p class="text-gray-400 text-sm">Try adjusting your search or filters</p>
        </div>

        <!-- Pagination -->
        <div class="mt-8" id="pagination-container">
            <!-- Pagination will be here if needed -->
        </div>
    </div>

    <script>
        // Store all students data
        let allStudents = @json($students->items());
        let filteredStudents = [...allStudents];

        // Extract unique classes and sections
        function initializeFilters() {
            const classes = [...new Set(allStudents.map(s => s.class))].sort();
            const sections = [...new Set(allStudents.map(s => s.section))].sort();

            const classFilter = document.getElementById('class-filter');
            const sectionFilter = document.getElementById('section-filter');

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

        // Filter students
        function filterStudents() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const selectedClass = document.getElementById('class-filter').value;
            const selectedSection = document.getElementById('section-filter').value;

            filteredStudents = allStudents.filter(student => {
                const matchesSearch =
                    student.name.toLowerCase().includes(searchTerm) ||
                    student.roll.toString().toLowerCase().includes(searchTerm) ||
                    student.phone.toString().toLowerCase().includes(searchTerm);

                const matchesClass = !selectedClass || student.class.toString() === selectedClass;
                const matchesSection = !selectedSection || student.section === selectedSection;

                return matchesSearch && matchesClass && matchesSection;
            });

            updateDisplay();
        }

        // Update the display
        function updateDisplay() {
            updateStats();
            renderTableView();
            renderGridView();

            const noResults = document.getElementById('no-results');
            const tableView = document.getElementById('table-view');
            const gridView = document.getElementById('grid-view');

            if (filteredStudents.length === 0) {
                noResults.classList.remove('hidden');
                tableView.classList.add('hidden');
                gridView.classList.add('hidden');
            } else {
                noResults.classList.add('hidden');
                if (tableView.classList.contains('hidden')) {
                    gridView.classList.remove('hidden');
                } else {
                    tableView.classList.remove('hidden');
                }
            }
        }

        // Update statistics
        function updateStats() {
            document.getElementById('total-count').textContent = allStudents.length;
            document.getElementById('filtered-count').textContent = filteredStudents.length;
        }

        // Render table view
        function renderTableView() {
            const tbody = document.getElementById('table-body');
            tbody.innerHTML = '';

            filteredStudents.forEach(student => {
                const row = document.createElement('tr');
                row.className = 'table-row-hover';
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold">
                                ${student.name.charAt(0).toUpperCase()}
                            </div>
                            <span class="font-medium text-gray-900">${student.name}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            ${student.roll}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                            Class ${student.class}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            ${student.section}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                        <i class="fas fa-phone-alt text-indigo-500 mr-2"></i>${student.phone}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex gap-2">
                            <button class="text-blue-600 hover:text-blue-800 transition">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-green-600 hover:text-green-800 transition">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Render grid view
        function renderGridView() {
            const gridContainer = document.getElementById('grid-container');
            gridContainer.innerHTML = '';

            filteredStudents.forEach(student => {
                const card = document.createElement('div');
                card.className = 'bg-white rounded-xl shadow-lg p-6 card-hover';
                card.innerHTML = `
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white text-3xl font-bold mb-4">
                            ${student.name.charAt(0).toUpperCase()}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">${student.name}</h3>
                        
                        <div class="w-full space-y-3 mt-4">
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-600 text-sm">Roll:</span>
                                <span class="font-semibold text-indigo-600">${student.roll}</span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-600 text-sm">Class:</span>
                                <span class="font-semibold">${student.class}</span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-600 text-sm">Section:</span>
                                <span class="font-semibold">${student.section}</span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-600 text-sm">Phone:</span>
                                <span class="font-semibold text-gray-700">${student.phone}</span>
                            </div>
                        </div>

                        <div class="flex gap-2 mt-4 w-full">
                            <button class="flex-1 bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                gridContainer.appendChild(card);
            });
        }

        // Toggle view
        function toggleView(view) {
            const tableView = document.getElementById('table-view');
            const gridView = document.getElementById('grid-view');
            const tableBtn = document.getElementById('table-view-btn');
            const gridBtn = document.getElementById('grid-view-btn');

            if (view === 'table') {
                tableView.classList.remove('hidden');
                gridView.classList.add('hidden');
                tableBtn.classList.add('bg-indigo-600', 'text-white');
                tableBtn.classList.remove('bg-gray-200', 'text-gray-700');
                gridBtn.classList.remove('bg-indigo-600', 'text-white');
                gridBtn.classList.add('bg-gray-200', 'text-gray-700');
            } else {
                tableView.classList.add('hidden');
                gridView.classList.remove('hidden');
                gridBtn.classList.add('bg-indigo-600', 'text-white');
                gridBtn.classList.remove('bg-gray-200', 'text-gray-700');
                tableBtn.classList.remove('bg-indigo-600', 'text-white');
                tableBtn.classList.add('bg-gray-200', 'text-gray-700');
            }
        }

        // Clear all filters
        function clearFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('class-filter').value = '';
            document.getElementById('section-filter').value = '';
            filterStudents();
        }

        // Event listeners
        document.getElementById('search-input').addEventListener('input', filterStudents);
        document.getElementById('class-filter').addEventListener('change', filterStudents);
        document.getElementById('section-filter').addEventListener('change', filterStudents);

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeFilters();
            updateDisplay();
        });
    </script>

</body>

</html>