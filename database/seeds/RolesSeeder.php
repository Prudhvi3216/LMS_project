<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles seeding
        $admin = Role::Create([
          'name'=>'admin',
          'description'=>'Admin',
        ]);

        $student = Role::Create([
          'name'=>'instructor',
          'description'=>'Instructor',
        ]);

        $student = Role::Create([
          'name'=>'student',
          'description'=>'Student',
        ]);
    }
}
