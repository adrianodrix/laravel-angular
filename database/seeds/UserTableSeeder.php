<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('posts')->delete();
        DB::table('users')->delete();

        $faker = Faker::create();

        User::create([
	        'name' => $faker->name,
	        'email' => 'a@com1',
	        'password' => bcrypt('123456'),
    	]);

        User::create([
            'name' => $faker->name,
            'email' => 'a@com2',
            'password' => bcrypt('123456'),
        ]);
    }

}