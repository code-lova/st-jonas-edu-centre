<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            // Find all groups that have more than one score row for the same student/subject/class/session/term
            $duplicateGroups = DB::table('scores')
                ->select('student_id', 'class_id', 'subject_id', 'session_id', 'term_id')
                ->groupBy('student_id', 'class_id', 'subject_id', 'session_id', 'term_id')
                ->havingRaw('COUNT(*) > 1')
                ->get();

            foreach ($duplicateGroups as $group) {
                // Keep the row with the latest updated_at, using id as a tiebreaker
                $keepId = DB::table('scores')
                    ->where([
                        'student_id' => $group->student_id,
                        'class_id'   => $group->class_id,
                        'subject_id' => $group->subject_id,
                        'session_id' => $group->session_id,
                        'term_id'    => $group->term_id,
                    ])
                    ->orderByDesc('updated_at')
                    ->orderByDesc('id')
                    ->value('id');

                // Delete all other rows in this group
                DB::table('scores')
                    ->where([
                        'student_id' => $group->student_id,
                        'class_id'   => $group->class_id,
                        'subject_id' => $group->subject_id,
                        'session_id' => $group->session_id,
                        'term_id'    => $group->term_id,
                    ])
                    ->where('id', '!=', $keepId)
                    ->delete();
            }

            Schema::table('scores', function (Blueprint $table) {
                $table->unique(
                    ['student_id', 'class_id', 'subject_id', 'session_id', 'term_id'],
                    'scores_unique_per_student_subject'
                );
            });
        });
    }

    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropUnique('scores_unique_per_student_subject');
        });
    }
};
