<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ingredient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'unit',
    ];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
