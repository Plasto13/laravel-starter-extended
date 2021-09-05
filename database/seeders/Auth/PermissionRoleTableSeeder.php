<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        // Create Roles
        $super_admin = Role::create(['name' => 'super admin']);
        $admin = Role::create(['name' => 'administrator']);
        $manager = Role::create(['name' => 'manager']);
        $executive = Role::create(['name' => 'executive']);
        $user = Role::create(['name' => 'user']);

        // Create Permissions
        Permission::firstOrCreate(['name' => 'view_backend',
            'module_name' => 'core',
            'display_name' => 'core::core.permissions.view_backend_title',
            'description' => 'core::core.permissions.view_backend_description',
        ]);
        Permission::firstOrCreate(['name' => 'edit_settings',
            'module_name' => 'core',
            'display_name' => 'core::core.permissions.edit_settings_title',
            'description' => 'core::core.permissions.edit_settings_description',
        ]);
        Permission::firstOrCreate(['name' => 'view_logs',
            'module_name' => 'core',
            'display_name' => 'core::core.permissions.view_logs_title',
            'description' => 'core::core.permissions.view_logs_description',
        ]);

        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms,
            'module_name' => 'core',
            'display_name' => 'core::core.permissions.'.$perms.'_title',
            'description' => 'core::core.permissions.'.$perms.'_description',
        ]);
        }
        //Post Permissions
        Permission::firstOrCreate([
            'name' => 'view_posts',
            'module_name' => 'articles',
            'display_name' => 'article::posts.permissions.view_posts_title',
            'description' => 'article::posts.permissions.view_posts_description',
        ]);
        Permission::firstOrCreate([
            'name' => 'edit_posts',
            'module_name' => 'articles',
            'display_name' => 'article::posts.permissions.edit_posts_title',
            'description' => 'article::posts.permissions.edit_posts_description',
        ]);
        //Categories Permissions
        Permission::firstOrCreate([
            'name' => 'view_categories',
            'module_name' => 'articles',
            'display_name' => 'article::categories.permissions.view_categories_title',
            'description' => 'article::categories.permissions.view_categories_description',
        ]);
        Permission::firstOrCreate([
            'name' => 'edit_categories',
            'module_name' => 'articles',
            'display_name' => 'article::categories.permissions.view_categories_title',
            'description' => 'article::categories.permissions.view_categories_description',
        ]);
        //Categories Permissions
        Permission::firstOrCreate([
            'name' => 'view_tags',
            'module_name' => 'tags',
            'display_name' => 'tag::tags.permissions.view_tags_title',
            'description' => 'tag::tags.permissions.view_tags_description',
        ]);

        Permission::firstOrCreate([
            'name' => 'view_comments',
            'module_name' => 'comments',
            'display_name' => 'comment::comments.permissions.view_comments_title',
            'description' => 'comment::comments.permissions.view_comments_description',
        ]);

        echo "\n\n";

        // Assign Permissions to Roles
        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo('view_backend');
        $executive->givePermissionTo('view_backend');

        Schema::enableForeignKeyConstraints();
    }
}
