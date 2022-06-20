<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('customers')->insert([
<<<<<<< HEAD
            'full_name' => 'Fauzan Avidiansyah',
            'email' =>'fauzanavidian2@gmail.com',
            'phone' => '085921952456',
            'password' => Hash::make('test'),
=======
            'full_name' => 'yusuf',
            'email' =>'user@gmail.com',
            'phone' => '08123232325',
            'password' => Hash::make('testing'),
>>>>>>> 4932eb86139a64fbff4ed8b0faefc67df5f7d7c2
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
