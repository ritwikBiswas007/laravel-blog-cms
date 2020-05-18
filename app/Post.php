<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravelista\Comments\Commentable;

class Post extends Model
{
    use Sluggable, Commentable;

    protected $fillable = [
        'user_id', 'title', 'cover', 'content'
    ];

    public function setCoverAttribute($cover)
    {
        $this->attributes['cover'] = str_replace("http://localhost:8000", "", $cover);
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }
}
