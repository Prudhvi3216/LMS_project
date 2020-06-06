<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Instructor;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('name', 'admin')->first(); //ID->1
        $instructor_role = Role::where('name', 'instructor')->first(); //ID->2
        $student_role = Role::where('name', 'student')->first(); //ID->3

        /* Below Create method only accepts plain PHP array, while save method accepts full model instance.
        $admin = User::create([
          'name'=>'Admin',
          'email'=>'admin@maxprolearn.com',
          'password'=>bcrypt('Pirates!9742'),
          'is_active'=>1,
        ]);
        */
        $is_exist = User::all();

        if(!$is_exist->count())
        {
          //Admin import
          $admin = new User;
          $admin->first_name = 'Admin';
          $admin->last_name = 'A';
          $admin->email = 'admin@maxprolearn.com';
          $admin->password = bcrypt('Pirates!9742');
          $admin->is_active = 1;
          $admin->save();
          $admin->roles()->attach($admin_role);

          //Student import
          $student = new User;
          $student->first_name = 'Student';
          $student->last_name = 'S';
          $student->email = 'student@maxprolearn.com';
          $student->password = bcrypt('student');
          $student->is_active = 1;
          $student->save();
          $student->roles()->attach($student_role);

          //import instructors
          $instructor_user = new User();
          $instructor_user->first_name = 'Budda';
          $instructor_user->last_name = 'Seshu';
          $instructor_user->email = 'buddaseshu@maxprolearn.com';
          $instructor_user->password = bcrypt('seshu@123');
          $instructor_user->is_active = 1;
          $instructor_user->save();
          $instructor_user->roles()->attach($student_role);

          $instructor = new Instructor();
          $instructor->user_id = $instructor_user->id;
          $instructor->first_name = 'Budda';
          $instructor->last_name = 'Seshu';
          $instructor->instructor_slug = 'budda-seshu';
          $instructor->contact_email = 'buddaseshu@maxprolearn.com';
          $instructor->telephone = '+61 (800) 123-54323';
          $instructor->mobile = '+61 800-1233-8766';
          $instructor->paypal_id = 'buddaseshu@maxprolearn.com';
          $instructor->biography = '<p>Aenean commodo ligula eget dolor. Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, eta rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis. Lorem ipsum dolor sit amet,Aenean commodo ligula eget dolor. Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, eta rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis. Lorem ipsum dolor sit amet,Aenean commodo ligula eget dolor. Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>';
          $instructor->instructor_image = 'instructor/1/angela.jpg';
          $instructor->save();
          $instructor_user->roles()->attach($instructor_role);
        }
    }
}
