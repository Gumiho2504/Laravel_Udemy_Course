<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Work as Job;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->count(100)->create();

        $users = User::all()->shuffle();
        // User::factory()->create([

        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        for( $i = 0; $i < 10; $i++ ){
            Employer::factory()->create([
                "user_id"=> $users->pop()->id,
            ]);
        }

        $employers = Employer::all();

        for( $i = 0; $i < 1000; $i++ ){
            Job::factory()->create([
                'employer_id' => $employers->random()->id,
            ]);
        }

        foreach( $users as $user ){
            $jobs = Job::inRandomOrder()->take(rand(0,4))->get();
            foreach( $jobs as $job ){
                JobApplication::factory()->create([
                    'work_id' => $job->id,
                    'user_id' => $user->id,
                ]);
            }
        }

    }
}
