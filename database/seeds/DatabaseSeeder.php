<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Model\User;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UserPermissionSeeder::class);
        // $this->call(AssignPermissionForUser::class);
    }
}

class UsersTableSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create();
		$data = [];

		User::create(array(
			// 'location_id' => $faker->numberBetween(1, 5),
			'name' => 'Ebrahim',
			'email' => 'ebru.nkn@gmail.com',
			'password' => Hash::make('password'),
		));
		User::create(array(
			// 'location_id' => $faker->numberBetween(1, 5),
			'name' => 'Thaha',
			'email' => 'thahaac@gmail.com',
			'password' => Hash::make('password'),
		));

        $data = [];
		foreach (range(0, 5) as $lb) {
            $data[] = [
                // 'location_id' => $faker->numberBetween(1, 5),
                'name' => $faker->firstName,
                'email' => $faker->unique()->email,
                'password' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
		}
        User::insert($data);

	}
}

class UserPermissionSeeder extends seeder {
    public function run(){

        DB::statement("SET foreign_key_checks=0");
		DB::table('role_has_permissions')->truncate();
		Role::truncate();
		Permission::truncate();
        DB::statement("SET foreign_key_checks=1");

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'building add']);
        Permission::create(['name' => 'building edit']);
        Permission::create(['name' => 'building list']);
        Permission::create(['name' => 'building view']);
        Permission::create(['name' => 'building delete']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'building manager']);
        $role1->givePermissionTo('building add');
        $role1->givePermissionTo('building edit');
        $role1->givePermissionTo('building list');
        $role1->givePermissionTo('building view');
        $role1->givePermissionTo('building delete');

        // $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // // create demo users
        
    }
}

class AssignPermissionForUser extends Seeder {
    public function run() {
        $allUsers = User::get();
        $role = Role::find(1);
        $permission = Permission::all();
        foreach($allUsers as $user){
            $user->assignRole($role);
            $user->givePermissionTo($permission);
        }
    }
}