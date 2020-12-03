<?php

namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','show']]);
         $this->middleware('permission:post-create', ['only' => ['create','store']]);
         $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::latest()->paginate(5);
        $categories = Category::all();
        $authors = Author::all();   
        // ['posts'=> $posts,'categories'=>$categories,'authors'=>$authors];
        
        return view('posts.index',compact('categories','posts','authors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $post = Post::all();
        $categories = Category::all();   
        $authors = Author::all();     
        // return view('posts.create', compact('categories'));
        return view('posts.create')->withCategories($categories)->withAuthors($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Post $post, Category $category)
    {
        
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'nullable',
            'publish' => 'nullable',  
            'author_id'=>'required|integer',         
            
        ]);
        
        $post = new Post;
        $post->name = request('name');;
        $post->publish = $request->has('publish');
        $post->detail = request('detail');
        $post->categories()->attach($request->categories_id);
        $post->author_id = $request->author_id;
        if ($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename=time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $post->image=$filename;
        } else{
            // return $request;
            $post->image= '';
        } 
        
        $post->save();


        $post->categories()->sync($request->categories, false);
        

        // $posts = Post::all();

        // Post::create($request->all());
        
        return redirect()->route('posts.index',$post->id)
                        ->with('success','post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
        // return view('posts.show',compact('post'))['post'=>$post,'categories'=>$categories];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post = Post::find($id);
       // get edit routing......... 
       $categories = Category::all();
       $categories2 = array();
       foreach ($categories as $category) {
           $categories2[$category->id] = $category->name;
       }
       $authors = Author::all();
        $aut = array();
        foreach ($authors as $author) {
            $aut[$author->id] = $author->name;
        }
       // return the view and pass in the var we previously created
       return view('posts.edit')->withPost($post)->withCategories($categories2)->withAuthors($authors);
  
        
        // return view('posts.edit',['post'=>$post,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Post $post)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'image'=>'nullable',
            'publish'=>'nullable',
            'author_id'=>'required|integer'
        ]);
        $categories = Category::all();
        // $post->update($request->all());        
        $post=Post::find($id);
        $post->name=$request->input('name');
        $post->publish = $request->has('publish');
        $post->author_id = $request->input('author_id');
        $post->detail = request('detail');

        if (request()->hasFile('image') && request('image') != '') {
            $imagePath = public_path('uploads/'.$post->image);
            if(Post::exists($imagePath)){
                unlink($imagePath);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename=time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $post->image=$filename;
            $post->update();
        }
                 
        $post->update();
        
        if (isset($request->categories)) {
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->sync(array());
        }

        
    
        return redirect()->route('posts.index',$post->id)
                        ->with('success','post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->categories()->detach();
        $post->delete();
        $categories = Category::all();
        return redirect()->route('posts.index')
                        ->with('success','post deleted successfully');
    }
}
