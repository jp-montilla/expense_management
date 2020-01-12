<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
    	DB::table('users')->insert([
        'Email' => 'johndoe@gmail.com',
        'Name' => 'John Doe',
        'Role' => 'Administrator',
        'Password' => bcrypt('P@ssw0rd'),
        ]);

    }
}
