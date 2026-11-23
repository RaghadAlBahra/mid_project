<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SupperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name'=>'raghad',
            'email'=>'raghad@roro.com',
            'password'=>Hash::make('9112005'),
            'phone_number'=>'0988116178',
            'address'=>'kafarsoseh',
            'type'=>'super_admin',

        ]);
    }
}
