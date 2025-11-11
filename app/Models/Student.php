<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    // এই অংশটাই গুরুত্বপূর্ণ 🔽
    protected $fillable = [
        'name',
        'roll',
        'class',
        'section',
        'phone',
    ];
}
