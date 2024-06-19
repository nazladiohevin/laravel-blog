<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    User::create([
      'name' => "Nazla Hevin",
      'username' => "contohsaja",
      'email' => "inicontoh@gmail.com",
      'password' => bcrypt('123456')
    ]);

    User::factory(4)->create();

    $this->call([
      CategorySeeder::class,
      PostSeeder::class
    ]);
  }
}
