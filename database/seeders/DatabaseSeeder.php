<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'firstname' => 'Ahtesham',
                'lastname' => 'developer',
                'email' => 'ahtesham2000@gmail.com',
                'password' => Hash::make(23988725),
                'role' => 'developer',
                'gender' => 'Male',
                'created_at' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
                'date_of_birth' => '1988-12-07',
                'phone_number' => '9810763314'
            ],
            [
                'firstname' => 'Admin',
                'lastname' => 'User',
                'email' => 'support@aonetrades.com',
                'password' => Hash::make(23988725),
                'role' => 'admin',
                'gender' => 'Male',
                'created_at' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
                'date_of_birth' => '1990-01-01',
                'phone_number' => '9898989898'
            ],
            // [
            //     'firstname' => 'Ahtesham',
            //     'lastname' => 'user',
            //     'email' => 'ahtesham2000@mailinator.com',
            //     'password' => Hash::make(23988725),
            //     'role' => 'user',
            //     'gender' => 'Male',
            //     'created_at' => Carbon::now(),
            //     'email_verified_at' => Carbon::now()
            // ]
        ]);
        $this->call([
            Timezone::class,
            HelpFaqs::class
        ]);
    }
}
