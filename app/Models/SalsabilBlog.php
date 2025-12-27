<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalsabilBlog extends Model
{
    protected $table = 'salsabilblogs';

    protected $fillable = [
        'title',
        'author',
        'content',
        'image_path',
        'reference_link',
        'tags',
    ];

    public $incrementing = true; // This is true by default, but can be added for clarity
    public $timestamps = true; // This is also true by default
}
