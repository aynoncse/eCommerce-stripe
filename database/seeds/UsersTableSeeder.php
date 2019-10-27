<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'aynonbiz@gmail.com')->first();

    	if (!$user) {
    		User::create([
    			'name' 	=> 'Md Aynon',
    			'email' => 'aynonbiz@gmail.com',
    			'role' => 'admin',
    			'password' => Hash::make('12345678')
    		]);
    	}
    }
}
