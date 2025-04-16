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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('title')->nullable();
            $table->longText('site_description')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->longText('address')->nullable();
            $table->string('directors_name')->nullable();
            $table->string('principal_name')->nullable();
            $table->string('principal_signature')->nullable();
            $table->date('school_open')->nullable();
            $table->date('term_ends')->nullable();
            $table->date('term_begins')->nullable();
            $table->string('site_logo')->nullable();
            $table->tinyInteger('open_result')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
