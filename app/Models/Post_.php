<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isNull;

class Post extends Model
{
  private static $blog_posts = [
    "title" => "Blog",
    "posts" => [
      [
        "title_blog" => "Pernikahan Kaesang & Erina",
        "slug" => "pernikahan-kaesang-&-erina",
        "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis magnam recusandae ut."
      ],
      [
        "title_blog" => "Puan Maharani Calon Presiden 2024",
        "slug" => "puan-maharani-calon-presiden-2024",
        "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis magnam recusandae ut."
      ],
    ]
  ];

    public static function get_news(){
      return collect(self::$blog_posts);
    }    

    public static function get_specific_news($slug){
      $posts = collect(static::get_news()['posts']);      

      return $posts->firstWhere('slug', $slug);      
    }
}
