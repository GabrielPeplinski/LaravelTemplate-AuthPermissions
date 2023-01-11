# Laravel Template

## This template has:
- Authentication: Powered by Laravel Sanctum
- Permissions and Roles: Provided by Spatie Permissions

## How to Set your Roles and Permissions
You can create your own permissions and roles updating the following config files:
(this files can be found at app/config)

**permissions.php** => Create all your permissions
**permissions_by_role.php** => Each role must have it's permissions
**roles.php** => All tour roles should be stored here

## How to Update your Roles and Permissions
You can update your roles and permissions using the command :
    `php artisan update:permisisons`
Then the permissions and roles will be updated according to the config files
