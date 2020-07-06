<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Article;
use app\User;
class Comment extends Model
{
    protected $fillable = [
        'user_id', 'article_id', 'commentary'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
