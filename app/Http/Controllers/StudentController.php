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
    public function index()
    {
        // Fetch all students ordered by roll (numeric order)
        $students = Student::orderBy(DB::raw('CAST(roll AS UNSIGNED)'), 'asc')->paginate(20);

        // Total students
        $totalStudents = Student::count();

        // Unique students (based on unique email or phone number)
        $uniqueStudents = Student::select('email', 'mobile_number')
            ->whereNotNull('email')
            ->orWhereNotNull('mobile_number')
            ->distinct()
            ->count();

        // Students grouped by course (admission_for)
        $studentsByCourse = Student::select('admission_for', DB::raw('COUNT(*) as total'))
            ->groupBy('admission_for')
            ->pluck('total', 'admission_for')
            ->toArray();

        return view('students.index', compact(
            'students',
            'totalStudents',
            'uniqueStudents',
            'studentsByCourse'
        ));
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
