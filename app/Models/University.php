<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = ['name', 'location'];

    public function colleges()
    {
        return $this->hasMany(College::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
