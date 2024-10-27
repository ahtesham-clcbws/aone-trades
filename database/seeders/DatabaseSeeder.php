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
                'create_at' => Carbon::now()
            ],
            [
                'firstname' => 'Ahtesham',
                'lastname' => 'admin',
                'email' => 'ahtesham2000@ymail.com',
                'password' => Hash::make(23988725),
                'role' => 'admin',
                'gender' => 'Male',
                'create_at' => Carbon::now()
            ],
            [
                'firstname' => 'Ahtesham',
                'lastname' => 'user',
                'email' => 'ahtesham2000@mailinator.com',
                'password' => Hash::make(23988725),
                'role' => 'user',
                'gender' => 'Male',
                'create_at' => Carbon::now()
            ]
        ]);
        $this->call([
            Timezone::class,
            HelpFaqs::class
        ]);
    }
}
