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
        Schema::create('graduated_students', function (Blueprint $table) {
            $table->id();

            // Student personal information (copied from users table)
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->nullable();
            $table->string('sex');
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('profile_pic')->nullable();

            // Academic information
            $table->string('student_id')->unique(); // Original student ID for reference
            $table->unsignedBigInteger('graduated_from_class_id'); // SS3 class they graduated from
            $table->string('academic_year'); // e.g., "2024/2025"
            $table->date('graduation_date');
            $table->text('graduation_note')->nullable(); // Any special notes

            // System tracking
            $table->string('batch_id')->nullable(); // Link to promotion batch for rollback
            $table->unsignedBigInteger('processed_by')->nullable(); // Admin who processed graduation
            $table->timestamps();

            // Foreign keys
            $table->foreign('graduated_from_class_id')->references('id')->on('classes');
            $table->foreign('processed_by')->references('id')->on('users');

            // Indexes for better performance
            $table->index(['academic_year', 'graduation_date']);
            $table->index('batch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduated_students');
    }
};
