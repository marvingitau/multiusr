<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

   

    

    public function run()
    {
        // factory(App\Model\Admin::class)->create();
        //
        DB::table('admins')->insert([
            'username' => 'Admin', 'email' => 'admin@example.com','password' => bcrypt('password'), 'status' => 1
        ]);
       // Admin::create(['username' => 'Admin', 'email' => 'admin@example.com','password' => bcrypt('password'), 'status' => 1]);
    }
}
