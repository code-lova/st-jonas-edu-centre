<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remove duplicate score rows, keeping only the latest one per student/class/subject/session/term
        DB::statement('
            DELETE s1 FROM scores s1
            INNER JOIN scores s2
            WHERE s1.id < s2.id
              AND s1.student_id  = s2.student_id
              AND s1.class_id    = s2.class_id
              AND s1.subject_id  = s2.subject_id
              AND s1.session_id  = s2.session_id
              AND s1.term_id     = s2.term_id
        ');

        Schema::table('scores', function (Blueprint $table) {
            $table->unique(
                ['student_id', 'class_id', 'subject_id', 'session_id', 'term_id'],
                'scores_unique_per_student_subject'
            );
        });
    }

    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropUnique('scores_unique_per_student_subject');
        });
    }
};
