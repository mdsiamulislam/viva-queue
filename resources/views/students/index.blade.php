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
            background-color: #f9fafb;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">🎓 Students Dashboard</h1>
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

        <!-- Statistics -->
        <div class="grid md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow card-hover">
                <h2 class="text-sm text-gray-500">Total Students</h2>
                <p class="text-2xl font-bold text-indigo-600">{{ $totalStudents }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow card-hover">
                <h2 class="text-sm text-gray-500">Unique Students (Email/Phone)</h2>
                <p class="text-2xl font-bold text-green-600">{{ $uniqueStudents }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow card-hover">
                <h2 class="text-sm text-gray-500">Courses Offered</h2>
                <p class="text-2xl font-bold text-amber-600">{{ count($studentsByCourse) }}</p>
            </div>
        </div>

        <!-- Students by Course -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
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

        <!-- Multi-Filter Dropdowns -->
        <form method="GET" class="flex flex-wrap gap-2 mb-6">
            @foreach($dropdowns as $field => $options)
            <select name="{{ $field }}"
                class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                <option value="">{{ ucfirst(str_replace('_', ' ', $field)) }}</option>
                @foreach($options as $opt)
                <option value="{{ $opt }}" {{ request($field)==$opt?'selected':'' }}>{{ $opt ?: 'N/A' }}</option>
                @endforeach
            </select>
            @endforeach
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Apply</button>
            <a href="{{ route('students.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Clear</a>
        </form>

        <!-- Students Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Full Name</th>
                        <th class="px-4 py-2 text-left">Father’s Name</th>
                        <th class="px-4 py-2 text-left">Gender</th>
                        <th class="px-4 py-2 text-left">DOB</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Mobile</th>
                        <th class="px-4 py-2 text-left">Alternate</th>
                        <th class="px-4 py-2 text-left">Emergency</th>
                        <th class="px-4 py-2 text-left">Facebook</th>
                        <th class="px-4 py-2 text-left">Present Address</th>
                        <th class="px-4 py-2 text-left">Division</th>
                        <th class="px-4 py-2 text-left">Country</th>
                        <th class="px-4 py-2 text-left">Occupation</th>
                        <th class="px-4 py-2 text-left">Admission For</th>
                        <th class="px-4 py-2 text-left">Selected Courses</th>
                        <th class="px-4 py-2 text-left">Payment</th>
                        <th class="px-4 py-2 text-left">Transaction</th>
                        <th class="px-4 py-2 text-left">Reference</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($students as $s)
                    <tr class="table-row-hover">
                        <td class="px-4 py-2">{{ $s->full_name }}</td>
                        <td class="px-4 py-2">{{ $s->fathers_name }}</td>
                        <td class="px-4 py-2">{{ ucfirst($s->gender) }}</td>
                        <td class="px-4 py-2">{{ $s->date_of_birth }}</td>
                        <td class="px-4 py-2">{{ $s->email }}</td>
                        <td class="px-4 py-2">{{ $s->mobile_number }}</td>
                        <td class="px-4 py-2">{{ $s->alternate_number }}</td>
                        <td class="px-4 py-2">{{ $s->emergency_contact }}</td>
                        <td class="px-4 py-2">{{ $s->facebook_id }}</td>
                        <td class="px-4 py-2">{{ $s->present_address }}</td>
                        <td class="px-4 py-2">{{ $s->present_division }}</td>
                        <td class="px-4 py-2">{{ $s->country_name }}</td>
                        <td class="px-4 py-2">{{ $s->present_occupation }}</td>
                        <td class="px-4 py-2">{{ $s->admission_for }}</td>
                        <td class="px-4 py-2">
                            @if(is_array($s->selected_courses))
                            {{ implode(', ', $s->selected_courses) }}
                            @else
                            {{ $s->selected_courses }}
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $s->payment_method }} - {{ $s->payment_amount }}</td>
                        <td class="px-4 py-2">{{ $s->transaction_id }}</td>
                        <td class="px-4 py-2">{{ $s->reference }}</td>
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
</body>

</html>