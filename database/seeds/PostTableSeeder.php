<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Post;

class PostTableSeeder extends Seeder {

    public function run()
    {
        DB::table('posts')->delete();

        $faker = Faker::create();

        foreach(range(1, 100) as $index)
        {
            $user = App\User::first();
            
            if ($index % 2 == 0){
                $user = App\User::orderBy('created_at','desc')->first();    
            }

            Post::create([
                'title' => $index .': '. $faker->sentence,
                'body' => $faker->paragraph,
                'user_id' => $user->id,
            ]);
        };        
    }

}