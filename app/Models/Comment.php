<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['post_id', 'parent_id', 'content'];

    public function parent(){
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Comment::class,'parent_id');
    }

    public function post(){
        return $this ->belongsTo(Posts::class);
    }
}
