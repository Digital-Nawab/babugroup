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
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('university_id');
            $table->string('college_name');
            $table->string('college_code')->unique();
            $table->string('slug_url')->nullable();
            $table->text('description')->nullable();
            $table->string('college_email')->nullable();
            $table->string('college_contact')->nullable();
            $table->string('logo')->nullable();
            $table->string('gstn')->nullable();
            $table->string('address')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
