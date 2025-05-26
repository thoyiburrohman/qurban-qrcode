<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Receiver;
use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $receiver = Receiver::create([
        //     'name' => 'Ahmad Ridho',
        //     'nik' => '3201234567890001',

        //     'password' => Hash::make('password'),
        // ]);

        // Coupon::create([
        //     'receiver_id' => $receiver->id,
        //     'code' => strtoupper(Str::random(8)), // atau UUID
        // ]);
        // Receiver::factory(50)->create();
        // Ini adalah permission yang biasanya dibuat oleh Filament Shield jika Anda memiliki
        // resource untuk Role dan Permission.
        // Contoh:
        Permission::firstOrCreate(['name' => 'view_any_role']);
        Permission::firstOrCreate(['name' => 'view_role']);
        Permission::firstOrCreate(['name' => 'create_role']);
        Permission::firstOrCreate(['name' => 'update_role']);
        Permission::firstOrCreate(['name' => 'delete_role']);
        Permission::firstOrCreate(['name' => 'view_any_permission']);
        Permission::firstOrCreate(['name' => 'view_permission']);
        Permission::firstOrCreate(['name' => 'create_permission']);
        Permission::firstOrCreate(['name' => 'update_permission']);
        Permission::firstOrCreate(['name' => 'delete_permission']);
        Permission::firstOrCreate(['name' => 'view_any_user']);
        Permission::firstOrCreate(['name' => 'view_user']);
        Permission::firstOrCreate(['name' => 'create_user']);
        Permission::firstOrCreate(['name' => 'update_user']);
        Permission::firstOrCreate(['name' => 'delete_user']);


        // 2. Buat role 'admin' jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole = Role::firstOrCreate(['name' => 'panitia']);
        $adminRole = Role::firstOrCreate(['name' => 'penerima']);

        // 3. Berikan semua permission yang ada kepada role 'admin'
        // Ini memastikan admin memiliki akses penuh untuk mengelola semua aspek sistem,
        // termasuk membuat user baru, role, dan permission.
        $adminRole->givePermissionTo(Permission::all());

        $admin  = Role::where('name', 'admin')->first();
        $adminUser = User::firstOrCreate([
            'email' => 'admin@qurban.com',
        ], [
            'name' => 'Admin',
            'password' => hash::make('adminqurban'),
        ]);

        $adminUser->assignRole($admin);
    }
}
