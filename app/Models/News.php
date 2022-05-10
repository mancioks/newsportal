<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class News extends Model
{
    use HasFactory, Searchable;

    public function toSearchableArray()
    {
        $collection = collect([
            'title' => $this->title,
            'content' => $this->content,
        ]);
        $array = $collection->toArray();

        return $array;
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'news_id', 'id');
    }
}
