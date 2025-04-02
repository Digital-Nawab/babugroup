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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('student_name', 255);
            $table->enum('gender', ['male', 'female','other']);
            $table->date('dob');
            $table->string('email');
            $table->string('religion', 255)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->string('father_name', 255);
            $table->string('mother_name', 255);
            $table->string('mobile_num', 20);
            $table->string('guardians_contact', 20)->nullable();;
            $table->string('relation', 255)->nullable();
            $table->string('guardian_name', 255)->nullable();
            $table->string('caste', 255)->nullable();
            $table->string('what_app_num', 20)->nullable();
            $table->string('adhar_number', 25)->nullable();
            $table->string('profile_image')->nullable();
            $table->string('signature')->nullable();
            // Academic Info
            $table->integer('college_id');
            $table->integer('academic_year');
            $table->integer('category_id');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->text('subjects')->nullable();
            $table->string('last_exam')->nullable();
            $table->integer('mark_obtain')->nullable();
            $table->integer('last_percentage')->nullable();
            $table->string('last_exam_marksheet')->nullable();
            $table->string('aadhar_front_image')->nullable();
            $table->string('aadhar_back_image')->nullable();
            $table->string('class_10th_marksheet')->nullable();
            $table->string('class_12th_marksheet')->nullable();
            // Address Info
            $table->string('pincode')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('local_address')->nullable();
            $table->string('village')->nullable();
            $table->string('post_office')->nullable();
            $table->string('tehsil')->nullable();
            $table->string('block')->nullable();
            $table->string('police_station')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('payment_id')->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->enum('status', ['new', 'approved', 'verified', 'rejected'])->default('new');
            $table->enum('payment_mode', ['cash', 'upi','gateway','bank', 'cheque'])->nullable();
            $table->integer('added_by')->nullable();
            // $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
