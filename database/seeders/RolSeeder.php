<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;
class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rol = new Rol();
        $rol->rol = "Admin";
        $rol->save();

        $rol1 = new Rol();
        $rol1->rol = "mortal";
        $rol1->save();
    }
}
