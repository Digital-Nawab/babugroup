<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class student_fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'academic_year_id',
        'academic_course_id',
        'academic_course_type_id',
        'student_academy_id',
        'admission_number',
        'installment_date',
        'installment_amount',
        'payed_amount',
        'type_invoice',
        'invoice_id',
        'payment_date',
        'payment_mode',
        'fee_status',
        'any_note',
        'is_active',
        'is_approve',
        'date_time',
        'added_by',
        'updated_by',
        'updated_date',
        'institution_id'
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function academicCourse()
    {
        return $this->belongsTo(AcademicCourse::class);
    }

    public function academicCourseType()
    {
        return $this->belongsTo(AcademicCourseType::class);
    }

    public function studentAcademy()
    {
        return $this->belongsTo(StudentAcademy::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
