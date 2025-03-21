<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','user_id','body'];

    public function post(){
        $this->belongsTo(Post::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}
