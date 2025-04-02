<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = 'years';

    protected $fillable = [
        'name',
        'is_current',
        'status'
    ];

    public static function setCurrentYear($id)
    {
        self::query()->update(['is_current' => 0]); // Reset all to false
        return self::where('id', $id)->update(['is_current' => 1]);
    }
}
