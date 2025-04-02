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
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained('years')->onDelete('cascade');
            $table->foreignId('academic_course_id')->constrained('courses')->onDelete('cascade');
            $table->integer('academic_course_type_id');
            $table->integer('student_academy_id');
            $table->string('admission_number');
            $table->date('installment_date')->nullable();
            $table->float('installment_amount')->default(0);
            $table->float('payed_amount');
            $table->string('type_invoice')->nullable();
            $table->string('invoice_id')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_mode')->nullable();
            $table->enum('fee_status', ['pay', 'remain', 'return']);
            $table->string('any_note')->nullable();
            $table->enum('is_active', ['1', '2', '3']);
            $table->enum('is_approve', ['y', 'n']);
            $table->timestamp('date_time')->useCurrent();
            $table->string('added_by');
            $table->string('updated_by')->nullable();
            $table->dateTime('updated_date')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};
