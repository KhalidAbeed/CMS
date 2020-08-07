<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable=['title','description','content','image','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::Class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
