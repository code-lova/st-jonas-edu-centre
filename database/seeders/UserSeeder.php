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
                'firstname' => 'Super',
                'middlename' => 'Administartor',
                'lastname' => 'User',
                'username' => 'admin_user99',
                'role' => 'admin',
                'sex' => 'Male',
                'email' => 'admin@gmail.com',
                'date_of_birth' => '1980-01-01',
                'passport' => 'admin.jpg',
                'place_of_birth' => 'New York',
                'blood_group' => 'O+',
                'genotype' => 'AA',
                'residential_address' => '123 Admin Street',
                'local_govt_origin' => 'Admin Locality',
                'religion' => 'None',
                'nationality' => 'American',
                'previous_school' => null,
                'last_class_passed' => null,
                'current_class_applying' => null,
                'class_teacher' => null,
                'password' => Hash::make('admin123'),
            ],
        ]);
    }
}
