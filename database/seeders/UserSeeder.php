<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // $admin = User::create([
        //     'username' => 'adminkopinetgtlo',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $admin->assignRole('admin');

        // $user = User::create([
        //     'username' => 'johndoe',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $user->assignRole('user');

        $manager = Employee::create([
            'id_employee' => '111',
            'username' => 'manager',
            'fullname' => 'Manager KOPINETGO',
            'position' => 'manager',
            'password' => bcrypt('12345678'),
            'role' => 'manager'
        ]);

        $admin = Employee::create([
            'id_employee' => '222',
            'username' => 'admin',
            'fullname' => 'Admin KOPINETGO',
            'position' => 'admin',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        $user = Employee::create([
            'id_employee' => '331',
            'username' => 'loremipsum',
            'fullname' => 'mas lorem ipsum',
            'position' => 'Software Engineering',
            'password' => bcrypt('12345678'),
            'role' => 'user'
        ]);
    }
}
