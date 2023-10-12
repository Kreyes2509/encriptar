<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'mena',
            'email'=> 'dragonfollador@gmail.com',
            'password'=>bcrypt('12345678'),
            'rol_id'=>1,
        ]);
        $user = User::create([
            'name'=>'kenneth',
            'email'=> 'kreyes.dev@gmail.com',
            'password'=>bcrypt('12345678'),
            'rol_id'=>1,
        ]);
    }
}
