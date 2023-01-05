<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'firstuser',
            'lastname' => 'root',
            'password' => Hash::make('p@ssWordT£5t'),
            'email' => 'root@producttest.com',
        ]);
    }
}
