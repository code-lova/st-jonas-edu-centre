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
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->after('id');
            $table->string('middlename')->after('firstname');
            $table->string('lastname')->after('middlename');
            $table->string('username')->unique()->after('lastname');
            $table->enum('role', ['admin', 'teacher', 'student'])->default('student')->after('username');
            $table->string('sex')->after('password');
            $table->string('date_of_birth')->after('sex');
            $table->string('passport')->after('date_of_birth');
            $table->string('place_of_birth')->after('passport');
            $table->string('blood_group')->after('place_of_birth');
            $table->string('genotype')->after('blood_group');
            $table->string('residential_address')->after('genotype');
            $table->string('local_govt_origin')->after('residential_address');
            $table->string('religion')->after('local_govt_origin');
            $table->string('nationality')->after('religion');
            $table->string('last_class_passed')->after('nationality')->nullable();
            $table->string('current_class_applying')->after('last_class_passed')->nullable();
            $table->string('class_teacher')->after('current_class_applying')->nullable()->comment('only for teachers');
            $table->enum('is_active', ['0', '1'])->default(1)->after('class_teacher');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'firstname',
                'middlename',
                'lastname',
                'username',
                'role',
                'sex',
                'date_of_birth',
                'passport',
                'place_of_birth',
                'blood_group',
                'genotype',
                'residential_address',
                'local_govt_origin',
                'religion',
                'nationality',
                'last_class_passed',
                'current_class_applying',
                'class_teacher',
            ]);
        });
    }
};
