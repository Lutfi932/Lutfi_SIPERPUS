<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(["name" => "pustakawan"]);
        Permission::create(["name" => "edit_book"]);
        Permission::create(["name" => "edit_user"]);

        Role::create(["name" => "mahasiswa"]);
        Permission::create(["name" => "view_book"]);
    }
}
