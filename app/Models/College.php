<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class College extends Model
{
    use HasFactory;

    protected $table = 'colleges';

    protected $fillable = [
        'category_id',
        'university_id',
        'college_name',
        'college_code',
        'slug_url',
        'description',
        'college_email',
        'college_contact',
        'logo',
        'gstn',
        'address',
        'status'
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
