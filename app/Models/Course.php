<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    //
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'semesters',
        'category_id',
        'description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function college()
    {
        return $this->belongsTo(College::class);
    }

}
