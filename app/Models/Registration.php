<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name', 'gender', 'email', 'dob', 'religion', 'nationality',
        'father_name', 'mother_name', 'mobile_num', 'guardians_contact',
        'relation', 'guardian_name', 'caste', 'what_app_num', 'adhar_number',
        'profile_image', 'signature','college_id', 'academic_year', 'category_id', 'course_id',
        'subjects', 'last_exam', 'mark_obtain', 'last_percentage',
        'last_exam_marksheet', 'aadhar_front_image', 'aadhar_back_image',
        'class_10th_marksheet', 'class_12th_marksheet', 'pincode', 'district',
        'state', 'city', 'permanent_address', 'local_address', 'village',
        'post_office', 'tehsil', 'block', 'police_station', 'amount',
        'payment_id', 'payment_status', 'status', 'payment_mode', 'added_by',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
