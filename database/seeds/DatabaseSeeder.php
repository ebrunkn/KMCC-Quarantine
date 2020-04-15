<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Model\User;
use App\Model\Emirate;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

use App\Model\Building;
use App\Model\State;
use App\Model\District;
use App\Model\Constituency;
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
        $this->call(EmirateTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(ConstituencyTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BuildingTableSeeder::class);
        $this->call(WarehouseTableSeeder::class);
        $this->call(RequestTypeTableSeeder::class);
        $this->call(FoodTimeTableSeeder::class);
        $this->call(FoodCuisineTableSeeder::class);
        $this->call(RequirementTableSeeder::class);
        // $this->call(UserPermissionSeeder::class);
        // $this->call(AssignPermissionForUser::class);
    }
}

class EmirateTableSeeder extends Seeder
{
	public function run()
	{
        $data = [];
        $emirates = ['Abu Dhabi','Dubai','Sharjah','Fujairah','Al Ain','Ras Al Khaima', 'Umm Ul Quoom'];
        foreach($emirates as $emirate){
            $data[] = [
                // 'location_id' => $faker->numberBetween(1, 5),
                'name' => $emirate,
            ];
        }

        Emirate::insert($data);

	}
}
class StateTableSeeder extends Seeder
{
	public function run()
	{
        $data = [];
        $states = [
            'Kerala',
        ];
        foreach($states as $state){
            $data[] = [
                // 'location_id' => $faker->numberBetween(1, 5),
                'name' => $state,
            ];
        }

        State::insert($data);

	}
}
class DistrictTableSeeder extends Seeder
{
	public function run()
	{
        $data = [];
        $districts = [
            'Kasargod',
            'Kannur',
            'Wayanad',
            'Kozhikode',
            'Malappuram',
            'Palakkad',
            'Thrissur',
            'Ernakulam',
            'Idukki',
            'Kottayam',
            'Alappuza',
            'Pathanamthitta',
            'Kollam',
            'Thiruvananthapuram',
        ];
        foreach($districts as $district){
            $data[] = [
                // 'location_id' => $faker->numberBetween(1, 5),
                'state_id' => 1,
                'name' => $district,
            ];
        }

        District::insert($data);

	}
}
class ConstituencyTableSeeder extends Seeder
{
	public function run()
	{
        $data = [];
        $constituencies = [
            [
                'Manjeshwaram',
                'Kasaragod',
                'Udma',
                'Kanhangad',
                'Thrikaripur',
            ],
            [
                'Payyanur',
                'Kalliasseri',
                'Taliparamba',
                'Irikkur',
                'Azhikode',
                'Kannur',
                'Dharmadom',
                'Thalassery',
                'Kuthuparamba',
                'Mattanur',
                'Peravoor',
            ]
        ];
        foreach($constituencies as $index=>$constituency_dist_group){
            foreach($constituency_dist_group as $constituency){
                $data[] = [
                    'district_id' => $index+1,
                    'name' => $constituency,
                ];
            }
        }

        Constituency::insert($data);

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
			'role_id' => User::DEVELOPER,
		));
		User::create(array(
			// 'location_id' => $faker->numberBetween(1, 5),
			'name' => 'Thaha',
			'email' => 'thahaac@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => User::DEVELOPER,
        ));

        User::create(array(
			// 'location_id' => $faker->numberBetween(1, 5),
			'name' => 'Test Abudhabi',
			'email' => 'testab@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => User::ADMIN,
            'emirate_id' => 1,
        ));

		User::create(array(
			// 'location_id' => $faker->numberBetween(1, 5),
			'name' => 'Vahab',
			'email' => 'vahabz@gmail.com',
            'password' => Hash::make('kmcc123'),
            'role_id' => User::ADMIN,
            'emirate_id' => 3,
        ));

		User::create(array(
			// 'location_id' => $faker->numberBetween(1, 5),
			'name' => 'Sameer',
			'email' => 'smr_kp@yahoo.com',
            'password' => Hash::make('kmcc123'),
            'role_id' => User::VOLUNTEER,
            'emirate_id' => 3,
            'district_id' => 2,
            'constituency_id' => 10,
		));

        // $data = [];
		// foreach (range(0, 5) as $lb) {
        //     $data[] = [
        //         // 'location_id' => $faker->numberBetween(1, 5),
        //         'name' => $faker->firstName,
        //         'email' => $faker->unique()->email,
        //         'password' => Hash::make('password'),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ];
		// }
        // User::insert($data);

	}
}

// class UserPermissionSeeder extends seeder {
//     public function run(){

//         DB::statement("SET foreign_key_checks=0");
// 		DB::table('role_has_permissions')->truncate();
// 		Role::truncate();
// 		Permission::truncate();
//         DB::statement("SET foreign_key_checks=1");

//         // Reset cached roles and permissions
//         app()[PermissionRegistrar::class]->forgetCachedPermissions();

//         // create permissions
//         Permission::create(['name' => 'building add']);
//         Permission::create(['name' => 'building edit']);
//         Permission::create(['name' => 'building list']);
//         Permission::create(['name' => 'building view']);
//         Permission::create(['name' => 'building delete']);

//         Permission::create(['name' => 'warehouse add']);
//         Permission::create(['name' => 'warehouse edit']);
//         Permission::create(['name' => 'warehouse list']);
//         Permission::create(['name' => 'warehouse view']);
//         Permission::create(['name' => 'warehouse delete']);

//         Permission::create(['name' => 'food add']);
//         Permission::create(['name' => 'food edit']);
//         Permission::create(['name' => 'food list']);
//         Permission::create(['name' => 'food view']);
//         Permission::create(['name' => 'food delete']);

//         Permission::create(['name' => 'delivery add']);
//         Permission::create(['name' => 'delivery edit']);
//         Permission::create(['name' => 'delivery list']);
//         Permission::create(['name' => 'delivery view']);
//         Permission::create(['name' => 'delivery delete']);

//         // create roles and assign existing permissions
//         $role1 = Role::create(['name' => 'building manager']);
//         $role1->givePermissionTo('building add');
//         $role1->givePermissionTo('building edit');
//         $role1->givePermissionTo('building list');
//         $role1->givePermissionTo('building view');
//         $role1->givePermissionTo('building delete');

//         $role2 = Role::create(['name' => 'warehouse manager']);
//         $role2->givePermissionTo('warehouse add');
//         $role2->givePermissionTo('warehouse edit');
//         $role2->givePermissionTo('warehouse list');
//         $role2->givePermissionTo('warehouse view');
//         $role2->givePermissionTo('warehouse delete');

//         $role3 = Role::create(['name' => 'food manager']);
//         $role3->givePermissionTo('food add');
//         $role3->givePermissionTo('food edit');
//         $role3->givePermissionTo('food list');
//         $role3->givePermissionTo('food view');
//         $role3->givePermissionTo('food delete');

//         $role4 = Role::create(['name' => 'delivery manager']);
//         $role4->givePermissionTo('delivery add');
//         $role4->givePermissionTo('delivery edit');
//         $role4->givePermissionTo('delivery list');
//         $role4->givePermissionTo('delivery view');
//         $role4->givePermissionTo('delivery delete');

//         // $role3 = Role::create(['name' => 'super-admin']);
//         // gets all permissions via Gate::before rule; see AuthServiceProvider

//         // // create demo users

//     }
// }

// class AssignPermissionForUser extends Seeder {
//     public function run() {
//         $allUsers = User::where('id', 1)->get();
//         $role = Role::find(1);
//         $permission = Permission::all();
//         // dd($allUsers);
//         foreach($allUsers as $user){
//             // $user->assignRole($role);
//             $user->givePermissionTo($permission);
//         }

//         $delivery_user = User::where('id', 2)->first();
//         $role = Role::find(4);
//         $delivery_user->givePermissionTo([
//             'delivery add',
//             'delivery edit',
//             'delivery list',
//             'delivery view',
//             'delivery delete'
//         ]);

//     }
// }
class BuildingTableSeeder extends Seeder {
    public function run() {
        $items = ['Al Wasel', 'Rockey', 'Aseel', 'Pen'];
        foreach($items as $item){
            Building::create(array(
                'building_name'=>$item,
                'emirate_id'=>3,
            ));
        }
    }
}
class WarehouseTableSeeder extends Seeder {
    public function run() {
        $items = ['Kettle', 'Bedsheet', 'Mug', 'Pen', 'Note'];
        foreach($items as $item){
            $item = Warehouse::create(array(
                'item_name'=>$item,
                'emirate_id'=>3,
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

            foreach(range(0, 20) as $index){
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
                    'emirate_id'=>3,
                ));
            }

        }
    }
}
