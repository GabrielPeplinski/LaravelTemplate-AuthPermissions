<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdatePermissionsAndRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command to update roles and permissions according to the permissions, permissions_by_role and roles files in /config';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        $this->info('Updating permissions...');
        $this->updatePermissions();
        $this->info('Permissions updated!');
        $this->info('');

        $this->info('Updating roles...');
        $this->updateUserRoles();
        $this->info('Roles updated!');
    }

    private function updatePermissions()
    {
        $permissions = config('permissions');

        foreach ($permissions as $permission)
            Permission::updateOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
    }

    private function updateUserRoles()
    {
        $permissionsByRole = config('permissions_by_role');
        $roles = config('roles');

        for ($i = 0; $i < count($roles); $i++) {
            $this->info('Atualizando role: ' . $roles[$i]);

            Role::updateOrCreate(
                ['name' => $roles[$i]],
                ['name' => $roles[$i]]
            )->syncPermissions([
                $permissionsByRole[$roles[$i]]
            ]);
        }
    }
}
