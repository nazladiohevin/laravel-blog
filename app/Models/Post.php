<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
  use HasFactory, Sluggable;


  // Yang boleh diisi adalah title, quote, dan content selain mereka tidak bisa diisi
  // protected $fillable = ['title', 'quote', 'content'];
  // Yang boleh diisi selain id
  protected $guarded = ['id'];

  // Untuk menghindari N + 1 Problem 
  protected $with = ['category', 'author'];

  // Nama function harus sama dengan nama model dari category
  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function scopeFilter($query, array $filters)
  {

    /* if($filters['search'] ?? false) {
        return $query
          ->where('title', 'like', '%' . $filters['search'] . '%')
          ->orWhere('content', 'like', '%' . $filters['search'] . '%');
      } */

    // code yang diatas diganti dengan ini
    $query->when($filters['search'] ?? false, function ($query, $search) {
      return $query
        ->where('title', 'like', "%$search%")
        ->orWhere('content', 'like', "%$search%");
    });

    $query->when($filters['category'] ?? false, function ($query, $category) {
      // Pake use karena $category di method when
      // tidak bisa digunakan di method whereHas
      return $query->whereHas('category', function ($query) use ($category) {
        $query->where('slug', $category);
      });
    });

    $query->when($filters['author'] ?? false, function ($query, $author) {
      // Memakai arrow function menjadikan $author supaya bisa diakses
      // tak perlu harus memakai keyword use
      return $query->whereHas(
        'author',
        fn ($query) =>
        $query->where('username', $author)
      );
    });
  }

  // Pakai menthod ini supaya mencari postnya pakai slug
  // bukan pakai id
  public function getRouteKeyName()
  {
    return 'slug';
  }

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }
}
