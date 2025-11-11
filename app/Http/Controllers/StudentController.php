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
        $students = Student::orderBy(DB::raw('CAST(roll AS UNSIGNED)'), 'asc')->paginate(20);
        return view('students.index', compact('students'));
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
