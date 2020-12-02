<?php

namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Newsportal;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsportalController extends Controller
{
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsportal  $newsportal
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('newsportal.index');
         
           
        $categories = Category::latest()->paginate(5);
        $posts = Post::latest()->paginate(5);
        // categories  posts
        return view('newsportal.index', compact('posts', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }

    

}
