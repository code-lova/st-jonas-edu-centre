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
        Schema::table('promotion_history', function (Blueprint $table) {
            $table->unsignedBigInteger('previous_last_class_passed')->nullable()->after('to_class_id');
            $table->foreign('previous_last_class_passed')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotion_history', function (Blueprint $table) {
            $table->dropForeign(['previous_last_class_passed']);
            $table->dropColumn('previous_last_class_passed');
        });
    }
};
