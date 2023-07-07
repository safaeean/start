<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('admin.admin_name')) {

            foreach (config('admin.roles') as $role) {
                Role::query()->firstOrCreate(collect($role)->only(['name', 'guard_name'])->toArray());
            }

            $user = User::query()->firstOrCreate(
                [
                    'email' => config('admin.admin_email')], [
                    'name' => config('admin.admin_name'),
                    'password' => bcrypt(config('admin.admin_password')),
                ]
            );
            $user->roles()->sync(Role::query()->whereIn('name', config('admin.admin_roles'))->pluck('id'));
        }
    }
}
