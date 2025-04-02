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
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');            // Auto-incrementing ID
            $table->string('queue')->index();       // Queue name
            $table->longText('payload');            // Job payload (serialized data)
            $table->unsignedTinyInteger('attempts'); // Number of attempts
            $table->unsignedInteger('reserved_at')->nullable(); // Time reserved
            $table->unsignedInteger('available_at'); // Time available to run
            $table->unsignedInteger('created_at');   // Creation timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
