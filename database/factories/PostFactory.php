<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'category_id' => mt_rand(1, 3),
      'user_id' => mt_rand(1, 5),
      'title' => $this->faker->sentence(6),
      'slug' => $this->faker->unique()->slug(4),
      'quote' => $this->faker->sentence(15),
      'content' => "<p>" . implode("<p></p>", $this->faker->paragraphs(7)) . "</p>",
      'published_at' => $this->faker->date()
    ];
  }
}
