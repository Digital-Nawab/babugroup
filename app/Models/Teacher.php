<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'whatsapp',
        'phone',
        'address',
        'status',
        'image',
        'college_id',
    ];
}
