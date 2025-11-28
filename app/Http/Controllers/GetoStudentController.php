<?php

namespace App\Http\Controllers;

use App\Imports\GetoStudentImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GetoStudentController extends Controller
{

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx'
        ]);

        $import = new GetoStudentImport;
        Excel::import($import, $request->file('file'));

        return redirect()
            ->route('students.import.status')
            ->with([
                'success_count' => $import->success,
                'duplicates' => $import->duplicates
            ]);
    }
}
