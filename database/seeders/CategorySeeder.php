<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Category::create(
      [
        'name' => 'Politik',
        'slug' => 'politik'
      ],
    );
    Category::create([
      'name' => 'Teknologi',
      'slug' => 'teknologi'
    ]);
    Category::create([
      'name' => 'Gaya Hidup',
      'slug' => 'gaya-hidup'
    ]);
  }
}
