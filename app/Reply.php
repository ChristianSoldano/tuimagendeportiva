<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\User;

class Reply extends Model
{
    protected $fillable = [
        'user_id', 'reply', 'comment_id', 'article_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
