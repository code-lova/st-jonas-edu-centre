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
        Schema::table('teacher_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id')->nullable()->after('student_id'); // teacher

            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_comments', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
        });
    }
};
