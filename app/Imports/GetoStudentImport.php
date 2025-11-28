<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GetoStudentImport implements ToModel, WithHeadingRow
{
    public $duplicates = [];
    public $success = 0;

    public function model(array $row)
    {
        // Duplicate checking
        if (Student::where('student_id', $row['id'])->exists()) {
            $this->duplicates[] = $row['id'];
            return null; // skip
        }

        $this->success++;

        return new Student([
            'student_name' => $row['student_name'],
            'batch' => $row['batch'],
            'student_id' => $row['id'],
            'phone' => $row['phone_number'],
            'email' => $row['email'],
            'total_male_guest' => $row['total_male_guest'],
            'total_female_guest' => $row['total_female_guest'],
            'guest_name' => $row['guest_name'],
            'floor_no' => $row['floor_no'],
            'attendance' => $row['attendance'] == 'yes' ? 1 : 0,
            'guest_attend' => $row['guest_attend'],
        ]);
    }
}
