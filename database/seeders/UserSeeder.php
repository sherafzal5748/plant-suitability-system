<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(path: 'resources/js/users.json'); //path to json file
        $users = json_decode($json); //convert json formate into php array

        foreach($users as $user){    
            User::create([
                'first_name' => $user->first_name,

                'last_name' => $user->last_name,

                'role' => $user->role,

                'email' => $user->email,

                'phone' => $user->phone,

                // always hash passwords
                'password' => Hash::make($user->password),

                'country' => $user->country,

                'state' => $user->state,

                'city' => $user->city,

                'street_address' => $user->street_address,

                'image' => $user->image
            ]);
        }
    }
}
