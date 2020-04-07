<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Model\User;

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