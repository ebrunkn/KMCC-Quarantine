<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Model\User;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

use App\Model\Building;
use App\Model\Warehouse;
use App\Model\WarehouseStock;
use App\Model\RequestType;
use App\Model\Requirement;
use App\Model\FoodTime;
use App\Model\FoodCuisine;

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
        $this->call(BuildingTableSeeder::class);
        $this->call(WarehouseTableSeeder::class);
        $this->call(RequestTypeTableSeeder::class);
        $this->call(FoodTimeTableSeeder::class);
        $this->call(FoodCuisineTableSeeder::class);
        $this->call(RequirementTableSeeder::class);
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
class BuildingTableSeeder extends Seeder {
    public function run() {
        $items = ['Al Wasel', 'Rockey', 'Aseel', 'Pen'];
        foreach($items as $item){
            Building::create(array(
                'building_name'=>$item
            ));
        }
    }
}
class WarehouseTableSeeder extends Seeder {
    public function run() {
        $items = ['Kettle', 'Bedsheet', 'Mug', 'Pen', 'Note'];
        foreach($items as $item){
            $item = Warehouse::create(array(
                'item_name'=>$item
            ));

            WarehouseStock::create(array(
                'item_id'=>$item->id,
                'qty'=>50,
            ));
        }
    }
}
class RequestTypeTableSeeder extends Seeder {
    public function run() {
        $items = [
            'Warehouse Items', 'Food'
            // 'Maintenance', 'Other'
        ];
        foreach($items as $item){
            RequestType::create(array(
                'type'=>$item
            ));
        }
    }
}

class FoodTimeTableSeeder extends Seeder {
    public function run() {
        $items = ['Breakfast', 'Brunch', 'Lunch', 'Snacks', 'Dinner'];
        foreach($items as $item){
            FoodTime::create(array(
                'name'=>$item
            ));
        }
    }
}

class FoodCuisineTableSeeder extends Seeder {
    public function run() {
        $items = ['Arabic', 'Indian', 'Philippino', 'SriLankan'];
        foreach($items as $item){
            FoodCuisine::create(array(
                'name'=>$item
            ));
        }
    }
}

class RequirementTableSeeder extends Seeder {
    public function run() {
        $types = RequestType::get();
        $building_count = Building::count();
        foreach($types as $type){

            foreach(range(0, 5) as $index){
                if($type->id == 1){
                    $ware_house_item_count = rand(1, Warehouse::count());
                    $food_time_count = null;
                    $food_cuisine_count = null;
                }elseif($type->id == 2){
                    $ware_house_item_count = null;
                    $food_time_count = rand(1, FoodTime::count());
                    $food_cuisine_count = rand(1, FoodCuisine::count());
                    // dd($food_cuisine_count);
                }else{
                    $ware_house_item_count = null;
                    $food_time_count = null;
                    $food_cuisine_count = null;
                }
    
    
                Requirement::create(array(
                    'user_id'=>1,
                    'building_id'=>rand(1, $building_count),
                    'room_no'=>rand(100, 200),
                    'type_id'=>$type->id,
                    'food_time_id'=>$food_time_count,
                    'food_cuisine_id'=>$food_cuisine_count,
                    'warehouse_item_id'=>$ware_house_item_count,
                    'requested_qty'=>rand(20, 50),
                    'info'=>'custom text',
                ));
            }
            
        }
    }
}