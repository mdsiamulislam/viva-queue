<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Roll ডুপ্লিকেট হলে স্কিপ করবে
        if (Student::where('roll', $row['roll'])->exists()) {
            return null;
        }

        return new Student([
            'name'    => $row['name'],
            'roll'    => $row['roll'],
            'class'   => $row['class'],
            'section' => $row['section'] ?? null,
            'phone'   => $row['phone'] ?? null,
        ]);
    }
}
