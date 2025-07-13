<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $roles = [
            'admin',
            'guru',
            'yayasan',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $permissions = [
            // Admin
            'dashboard.admin',
            'jadwalmengajar.index',
            'jadwalmengajar.create',
            'jadwalmengajar.store',
            'jadwalmengajar.edit',
            'jadwalmengajar.update',
            'jadwalmengajar.destroy',
            'dataguru.index',
            'dataguru.create',
            'dataguru.store',
            'dataguru.edit',
            'dataguru.update',
            'dataguru.destroy',
            'datasantri.index',
            'datasantri.create',
            'datasantri.store',
            'datasantri.edit',
            'datasantri.update',
            'datasantri.destroy',
            'kelolapengguna.index',
            'kelolapengguna.create',
            'kelolapengguna.store',
            'kelolapengguna.edit',
            'kelolapengguna.update',
            'periode.index',
            'periode.store',
            'kategoripenilaian.index',
            'kategoripenilaian.store',
            'kehadiranA.index',
            'kehadiranA.detail',
            'hafalanadmin.index',
            'hafalanadmin.detail',
            'kinerjaguru.index',

            // Guru
            'dashboard.guru',
            'kehadiranG.index',
            'kehadiranG.input',
            'hafalansantri.index',
            'hafalansantri.input',

            // Yayasan
            'dashboard.yayasan',
            'kehadiranY.index',
            'kehadiranY.input',
            'hafalansantriY.index',
            'hafalansantriY.input',
            'kategorinilai.index',
        ];

        foreach ($permissions as $permission_all) {
            Permission::firstOrCreate(['name' => $permission_all]);
        }

        $perm_admin = [
            'dashboard.admin',
            'jadwalmengajar.index',
            'jadwalmengajar.create',
            'jadwalmengajar.store',
            'jadwalmengajar.edit',
            'jadwalmengajar.update',
            'jadwalmengajar.destroy',
            'dataguru.index',
            'dataguru.create',
            'dataguru.store',
            'dataguru.edit',
            'dataguru.update',
            'dataguru.destroy',
            'datasantri.index',
            'datasantri.create',
            'datasantri.store',
            'datasantri.edit',
            'datasantri.update',
            'datasantri.destroy',
            'kelolapengguna.index',
            'kelolapengguna.create',
            'kelolapengguna.store',
            'kelolapengguna.edit',
            'kelolapengguna.update',
            'periode.index',
            'periode.store',
            'kategoripenilaian.index',
            'kategoripenilaian.store',
            'kehadiranA.index',
            'kehadiranA.detail',
            'hafalanadmin.index',
            'hafalanadmin.detail',
            'kinerjaguru.index',
        ];
        $perm_guru = [
            'dashboard.guru',
            'kehadiranG.index',
            'kehadiranG.input',
            'hafalansantri.index',
            'hafalansantri.input',
        ];
        $perm_yayasan = [
            'dashboard.yayasan',
            'kehadiranY.index',
            'kehadiranY.input',
            'hafalansantriY.index',
            'hafalansantriY.input',
            'kategorinilai.index',
        ];

        $role_admin = Role::findByName('admin');
        if ($role_admin) {
            $role_admin->givePermissionTo($perm_admin);
        }

        $role_guru = Role::findByName('guru');
        foreach ($perm_guru as $permission_guru) {
            $role_guru->givePermissionTo($permission_guru);
        }

        $role_yayasan = Role::findByName('yayasan');
        foreach ($perm_yayasan as $permission_yayasan) {
            $role_yayasan->givePermissionTo($permission_yayasan);
        }

        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }
        $user = User::find(2);
        if ($user) {
            $user->assignRole('guru');
        }
        $user = User::find(3);
        if ($user) {
            $user->assignRole('yayasan');
        }
    }
}
