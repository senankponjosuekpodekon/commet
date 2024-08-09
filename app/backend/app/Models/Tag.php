<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // public $guarded = [];
    public $timestamps = false;

    public function posts () {
        return $this->belongsToMany(Posts::class, 'post_tag', 'post_id', 'tag_id');
    }
}
