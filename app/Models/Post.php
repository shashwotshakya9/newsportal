<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'detail', 'image','publish','category'
    ];
    protected $casts = [
        'publish' => 'boolean',        
    ];
//   
    public function categories()
        {
            return $this->belongsToMany('App\Models\Category', 'category_post','post_id','category_id');
        }
    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }
// 
}
