<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = 'authors';
    protected $fillable = [
        'name', 'image','publish',
    ];
    protected $casts = [
        'publish' => 'boolean',        
    ];

    public function posts()
    {
    	return $this->hasMany('App\Models\Post');
    }
}
