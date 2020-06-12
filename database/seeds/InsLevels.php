<?php

use Illuminate\Database\Seeder;

class InsLevels extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instruction_levels')->insert([
            'id' => 1,
            'level' => 'Beginner'
        ]);

        DB::table('instruction_levels')->insert([
            'id' => 2,
            'level' => 'Intermediate'
        ]);

        DB::table('instruction_levels')->insert([
            'id' => 3,
            'level' => 'Advanced'
        ]);
    }
}
