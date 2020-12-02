<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;    
    protected $table='categories';

    protected $fillable = [
        'name', 'publish', 'slug'
    ];
    protected $casts = [
        'publish' => 'boolean',
        
    ];
    
//     public function posts()
// {
//     return $this->belongsToMany(Post::class);
// }
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post','category_post','category_id','post_id');
    }
}
