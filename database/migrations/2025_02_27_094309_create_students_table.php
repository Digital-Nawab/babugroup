<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('admission_form_no')->default(0);
            $table->string('student_register_id')->nullable();
            $table->string('university_enrolment_no')->nullable();
            $table->string('student_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('relation')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('gender');
            $table->string('email');
            $table->string('mobile_num', 20);
            $table->string('what_app_num', 20)->nullable();
            $table->string('adhar_number', 25)->nullable();
            $table->string('scholar_number')->nullable();
            $table->string('caste')->nullable();
            $table->string('caste_type')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('guardians_contact', 20);
            $table->date('dob');
            $table->string('last_education')->nullable();
            $table->string('last_education_board')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('rank')->nullable();
            $table->string('entrance_exam_name')->nullable();
            $table->string('entrance_exam_roll_no')->nullable();
            $table->string('entrance_exam_rank')->nullable();
            $table->string('entrance_exam_date')->nullable();
            $table->string('document')->nullable();
            $table->longText('profile_image')->nullable();
            $table->longText('signature')->nullable();
            $table->enum('is_active', ['0', '1', '2', '3'])->default('0');
            $table->boolean('status')->default(1);
            $table->integer('institution_id');
            $table->string('password')->nullable();
            $table->string('salt_password')->nullable();
            $table->string('_token')->nullable();
            $table->dateTime('date_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('added_by');
            $table->string('updated_by')->nullable();
            $table->dateTime('updated_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
