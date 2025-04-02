<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'admission_form_no',
        'student_register_id',
        'university_enrolment_no',
        'student_name',
        'father_name',
        'mother_name',
        'relation',
        'guardian_name',
        'gender',
        'email',
        'mobile_num',
        'what_app_num',
        'adhar_number',
        'scholar_number',
        'caste',
        'caste_type',
        'religion',
        'nationality',
        'guardians_contact',
        'dob',
        'last_education',
        'last_education_board',
        'roll_no',
        'rank',
        'entrance_exam_name',
        'entrance_exam_roll_no',
        'entrance_exam_rank',
        'entrance_exam_date',
        'document',
        'profile_image',
        'signature',
        'is_active',
        'institution_id',
        'password',
        'salt_password',
        '_token',
        'date_time',
        'added_by',
        'updated_by',
        'updated_date'
    ];
}
