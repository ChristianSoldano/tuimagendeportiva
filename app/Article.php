<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'excerpt', 'body', 'status', 'image','observations','created_at','updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function scopeSearch($query, $searchTerm)
    {
        return $query
            ->where('title', 'like', "%" . $searchTerm . "%")
            ->orWhere('body', 'like', "%" . $searchTerm . "%")
            ->orWhere('excerpt', 'like', "%" . $searchTerm . "%");
    }
    
        public function scopeHomeSearch($query, $searchTerm)
    {
        return $query
            ->where('title', 'like', "%" . $searchTerm . "%")
            ->orWhere('body', 'like', "%" . $searchTerm . "%")
            ->orWhere('excerpt', 'like', "%" . $searchTerm . "%");
    }

}
