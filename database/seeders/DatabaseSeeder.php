<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		$user                    = new User();
		$user->name              = "Admin";
		$user->email             = "asikur22@gmail.com";
		$user->email_verified_at = now();
		$user->password          = Hash::make( 'Dhaka' );
		$user->remember_token    = Str::random( 10 );
		$user->save();
		
		User::factory( 5 )->create();
		Todo::factory( 15 )->create();
	}
}
