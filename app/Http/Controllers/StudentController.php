<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Exports\StudentsExport;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Multi-filter support for dropdowns
        $filters = ['class', 'section', 'admission_for', 'gender', 'present_division'];
        foreach ($filters as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        // Fetch paginated students
        $students = $query->orderBy(DB::raw('CAST(roll AS UNSIGNED)'), 'asc')->paginate(25)->withQueryString();

        // Prepare statistics
        $totalStudents = Student::count();
        $uniqueStudents = Student::select('email', 'mobile_number')->distinct()->count();
        $studentsByCourse = Student::select('admission_for', DB::raw('count(*) as total'))
            ->groupBy('admission_for')
            ->pluck('total', 'admission_for')
            ->toArray();

        // Prepare dropdown options dynamically
        $dropdowns = [];
        foreach ($filters as $filter) {
            $dropdowns[$filter] = Student::select($filter)->distinct()->pluck($filter)->sort()->toArray();
        }

        return view('students.index', compact('students', 'totalStudents', 'uniqueStudents', 'studentsByCourse', 'dropdowns'));
    }



    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new StudentsImport, $request->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }

    public function export()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    public function deleteAll()
    {
        Student::truncate();
        return back()->with('success', 'All student records have been deleted.');
    }
}
