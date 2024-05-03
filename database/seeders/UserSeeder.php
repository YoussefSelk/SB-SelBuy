<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'password' => Hash::make('Estk@23@24'),
        ]);

        $adminRole = Role::where('name', 'Admin')->first();
        $SuperadminRole = Role::where('name', 'SuperAdmin')->first();
        $admin->roles()->attach($adminRole);
        $admin->roles()->attach($SuperadminRole);


        
    }
}
