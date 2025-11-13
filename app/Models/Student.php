<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        // Basic Info
        'full_name',
        'fathers_name',
        'gender',
        'date_of_birth',

        // Contact Info
        'email',
        'mobile_number',
        'alternate_number',
        'emergency_contact',
        'facebook_id',

        // Address Info
        'present_address',
        'present_division',
        'country_name',
        'permanent_address',

        // Identity & Education
        'nid_or_birth_certificate',
        'present_occupation',
        'educational_qualification',
        'last_institution',
        'studied_subject',

        // Islamic Study Background
        'studied_islamic_institution',
        'school_of_thought',

        // Course Info
        'class_device',
        'admission_for',
        'selected_courses',

        // Payment Info
        'payment_method',
        'payment_amount',
        'transaction_id',
        'order_id',

        // Reference Info
        'know_about_iom',
        'reference',

        // Agreements
        'accepted_terms',

        // Old/Existing Fields
        'name',
        'roll',
        'class',
        'section',
        'phone',
    ];

    // Optional: for JSON column casting
    protected $casts = [
        'selected_courses' => 'array',
        'studied_islamic_institution' => 'boolean',
        'accepted_terms' => 'boolean',
        'date_of_birth' => 'date',
        'payment_amount' => 'decimal:2',
    ];
}
