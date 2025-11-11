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
            // Drop the unique constraint on batch_id
            $table->dropUnique(['batch_id']);
            // Add a regular index instead
            $table->index('batch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotion_history', function (Blueprint $table) {
            // Remove the regular index
            $table->dropIndex(['batch_id']);
            // Add back the unique constraint
            $table->unique('batch_id');
        });
    }
};
