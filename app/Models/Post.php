<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'category_id',
    ];

    
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredient');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    
}
