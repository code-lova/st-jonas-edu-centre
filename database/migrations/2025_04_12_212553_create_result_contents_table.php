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
        Schema::create('result_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('number_in_class');
            $table->string('class_teacher_name');
            $table->unsignedBigInteger('class_id')->comment('The actual class');
            $table->string('directors_name');
            $table->date('school_open');
            $table->date('term_ends');
            $table->date('term_begins');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_contents');
    }
};
