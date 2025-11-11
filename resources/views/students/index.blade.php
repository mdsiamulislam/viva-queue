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
                            <div class="text-3xl font-bold">{{ $students->total() }}</div>
                            <div class="text-sm opacity-90">Total Students</div>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold">{{ $students->count() }}</div>
                            <div class="text-sm opacity-90">This Page</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="glass-effect rounded-xl shadow-lg p-6 mb-6 animate-slide-in">
            <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                <!-- Search -->
                <form method="GET" class="flex-1 w-full lg:w-auto">
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by name, roll, phone..."
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:outline-none transition">
                    </div>
                </form>

                <!-- Filters -->
                <div class="flex flex-wrap gap-3">
                    <select name="class" onchange="this.form.submit()"
                        class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:outline-none transition">
                        <option value="">All Classes</option>
                        <option value="1">Class 1</option>
                        <option value="2">Class 2</option>
                        <option value="3">Class 3</option>
                        <option value="4">Class 4</option>
                        <option value="5">Class 5</option>
                    </select>

                    <select name="section" onchange="this.form.submit()"
                        class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:outline-none transition">
                        <option value="">All Sections</option>
                        <option value="A">Section A</option>
                        <option value="B">Section B</option>
                        <option value="C">Section C</option>
                    </select>

                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition shadow-lg">
                        <i class="fas fa-filter mr-2"></i>Apply Filters
                    </button>
                </div>

                <!-- Upload & Export -->
                <div class="flex gap-3">
                    <label for="file-upload" class="cursor-pointer bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition shadow-lg flex items-center gap-2">
                        <i class="fas fa-upload"></i>
                        <span>Import</span>
                        <input id="file-upload" type="file" name="file" class="hidden"
                            onchange="document.getElementById('import-form').submit()">
                    </label>

                    <form id="import-form" action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" class="hidden">
                        @csrf
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
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($students as $s)
                        <tr class="table-row-hover">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold">
                                        {{ substr($s->name, 0, 1) }}
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $s->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                    {{ $s->roll }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                    Class {{ $s->class }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    {{ $s->section }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                <i class="fas fa-phone-alt text-indigo-500 mr-2"></i>{{ $s->phone }}
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <i class="fas fa-inbox text-6xl text-gray-300"></i>
                                    <p class="text-gray-500 text-lg">No students found.</p>
                                    <p class="text-gray-400 text-sm">Try adjusting your search or filters</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Grid View -->
        <div id="grid-view" class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($students as $s)
                <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white text-3xl font-bold mb-4">
                            {{ substr($s->name, 0, 1) }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $s->name }}</h3>

                        <div class="w-full space-y-3 mt-4">
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-600 text-sm">Roll:</span>
                                <span class="font-semibold text-indigo-600">{{ $s->roll }}</span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-600 text-sm">Class:</span>
                                <span class="font-semibold">{{ $s->class }}</span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-600 text-sm">Section:</span>
                                <span class="font-semibold">{{ $s->section }}</span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-600 text-sm">Phone:</span>
                                <span class="font-semibold text-gray-700">{{ $s->phone }}</span>
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
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-inbox text-6xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500 text-lg">No students found.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $students->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
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
    </script>

</body>

</html>