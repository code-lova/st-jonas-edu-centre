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
        Schema::create('promotion_history', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id')->unique(); // Unique identifier for each promotion batch
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('from_class_id');
            $table->unsignedBigInteger('to_class_id')->nullable(); // null for graduating students
            $table->string('previous_graduation_status')->default('active');
            $table->string('new_graduation_status')->default('active');
            $table->string('operation_type')->default('promote'); // promote, graduate
            $table->timestamp('promoted_at');
            $table->boolean('is_rolled_back')->default(false);
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from_class_id')->references('id')->on('classes');
            $table->foreign('to_class_id')->references('id')->on('classes');
            
            $table->index(['batch_id', 'is_rolled_back']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_history');
    }
};
