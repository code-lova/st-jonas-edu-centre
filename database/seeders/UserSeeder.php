<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'firstname' => 'Admin',
                'middlename' => 'Super',
                'lastname' => 'User',
                'username' => 'admin_user',
                'role' => 'admin',
                'sex' => 'Male',
                'date_of_birth' => '1980-01-01',
                'passport' => 'admin.jpg',
                'place_of_birth' => 'New York',
                'blood_group' => 'O+',
                'genotype' => 'AA',
                'residential_address' => '123 Admin Street',
                'local_govt_origin' => 'Admin Locality',
                'religion' => 'None',
                'nationality' => 'American',
                'last_class_passed' => null,
                'current_class_applying' => null,
                'class_teacher' => null,
                'password' => Hash::make('admin123'),
            ],
            [
                'firstname' => 'John',
                'middlename' => 'Doe',
                'lastname' => 'Student',
                'username' => 'student_user',
                'role' => 'student',
                'sex' => 'Male',
                'date_of_birth' => '2010-05-15',
                'passport' => 'student.jpg',
                'place_of_birth' => 'Los Angeles',
                'blood_group' => 'A+',
                'genotype' => 'AS',
                'residential_address' => '456 Student Lane',
                'local_govt_origin' => 'Student Locality',
                'religion' => 'Christianity',
                'nationality' => 'American',
                'last_class_passed' => 'JSS2',
                'current_class_applying' => 'JSS3',
                'class_teacher' => 'Mr. Smith',
                'password' => Hash::make('student123'),
            ],
            [
                'firstname' => 'Jane',
                'middlename' => 'Mary',
                'lastname' => 'Teacher',
                'username' => 'teacher_user',
                'role' => 'teacher',
                'sex' => 'Female',
                'date_of_birth' => '1990-08-20',
                'passport' => 'teacher.jpg',
                'place_of_birth' => 'Chicago',
                'blood_group' => 'B+',
                'genotype' => 'AC',
                'residential_address' => '789 Teacher Road',
                'local_govt_origin' => 'Teacher Locality',
                'religion' => 'Islam',
                'nationality' => 'American',
                'last_class_passed' => null,
                'current_class_applying' => null,
                'class_teacher' => null,
                'password' => Hash::make('teacher123'),
            ]
        ]);
    }
}
