<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => 'Admin',
                'lastName' => 'Admin',
                'address' => '-',
                'phone' => '-',
                'postalCode' => '-',
                'email' => 'admin@gmail.com',
                'role' => "admin",
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User',
                'lastName' => '001',
                'address' => '-',
                'phone' => '-',
                'postalCode' => '-',
                'email' => 'user@gmail.com',
                'role' => "user",
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Super',
                'lastName' => 'User',
                'address' => '-',
                'phone' => '-',
                'postalCode' => '-',
                'email' => 'superuser@gmail.com',
                'role' => "su",
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ]
            ];

     
        DB::table('users')->insert($data);
    }
}
