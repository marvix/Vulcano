<?php

use App\User;
use Illuminate\Database\Seeder;

class DummyUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        $nroFakers = 12;
        $this->command->info('Gerando '.$nroFakers.' usuários fakers.');
        for ($i = 1; $i <= $nroFakers; $i++) {
            $id = DB::table('users')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('user1234'),
                'active' => true,
                'gender' => 'N',
                'skin' => 'blue',
                'remember_token' => str_random(10),
                'created_at' => now(),
            ]);

            User::find($id)->assignRole('User');
        }
    }
}
