<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
{
    // Skip duplicate roll numbers
    if (Student::where('roll', $row['roll'])->exists()) {
        return null;
    }

    return new Student([
        // Basic Info
        'full_name'                => $row['full_name'] ?? null,
        'fathers_name'             => $row['fathers_name'] ?? null,
        'gender'                   => $row['gender'] ?? null,
        'date_of_birth'            => isset($row['date_of_birth']) ? \Carbon\Carbon::parse($row['date_of_birth'])->format('Y-m-d') : null,

        // Contact Info
        'email'                    => $row['email'] ?? null,
        'mobile_number'            => $row['mobile_number'] ?? null,
        'alternate_number'         => $row['alternate_number'] ?? null,
        'emergency_contact'        => $row['emergency_contact'] ?? null,
        'facebook_id'              => $row['facebook_id'] ?? null,

        // Address Info
        'present_address'          => $row['present_address'] ?? null,
        'present_division'         => $row['present_division'] ?? null,
        'country_name'             => $row['country_name'] ?? null,
        'permanent_address'        => $row['permanent_address'] ?? null,

        // Identity & Education
        'nid_or_birth_certificate' => $row['nid_or_birth_certificate'] ?? null,
        'present_occupation'       => $row['present_occupation'] ?? null,
        'educational_qualification'=> $row['educational_qualification'] ?? null,
        'last_institution'         => $row['last_institution'] ?? null,
        'studied_subject'          => $row['studied_subject'] ?? null,

        // Islamic Study Background
        'studied_islamic_institution' => isset($row['studied_islamic_institution'])
            ? filter_var($row['studied_islamic_institution'], FILTER_VALIDATE_BOOLEAN)
            : null,
        'school_of_thought'        => $row['school_of_thought'] ?? null,

        // Course Info
        'class_device'             => $row['class_device'] ?? null,
        'admission_for'            => $row['admission_for'] ?? null,
        'selected_courses'         => isset($row['selected_courses'])
            ? json_encode(explode(',', $row['selected_courses']))
            : null,

        // Payment Info
        'payment_method'           => $row['payment_method'] ?? null,
        'payment_amount'           => $row['payment_amount'] ?? null,
        'transaction_id'           => $row['transaction_id'] ?? null,
        'order_id'                 => $row['order_id'] ?? null,

        // Reference Info
        'know_about_iom'           => $row['know_about_iom'] ?? null,
        'reference'                => $row['reference'] ?? null,

        // Agreements
        'accepted_terms'           => isset($row['accepted_terms'])
            ? filter_var($row['accepted_terms'], FILTER_VALIDATE_BOOLEAN)
            : false,

        // Existing fields (for compatibility)
        'roll'                     => $row['roll'] ?? null,
        'class'                    => $row['class'] ?? null,
        'section'                  => $row['section'] ?? null,
    ]);
}

}
