<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{   
    // function __construct()
    // {
    //      $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:category-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $categories = Category::latest()->paginate(5);
        return view('category.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        request()->validate([
            'name' => 'required',            
            'publish' => 'nullable', 
            'slug' => 'nullable',     
            
        ]);
               
        $category = new Category;
        $category->name = request('name');
        $category->slug = request('slug');;
        $category->publish = $request->has('publish');
        $category->save();

        return redirect()->route('category.index')
                        ->with('success','category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Category $category)
    {
        request()->validate([
            'name' => 'required',
            'publish'=>'nullable',
        ]);
    
        // $post->update($request->all());        
        $category=Category::find($id);
        $category->name=$request->input('name');
        $category->publish = $request->has('publish');
        
        $category->update();
    
        return redirect()->route('category.index')
                        ->with('success','category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Post $posts,Request $request)
    {
       $category= Category::find($id);
  
    //     $category->delete();
    if($posts->category){
        return "YOLO";
    }else{
        return "gg";
    }
    
        
   
    
        // return redirect()->route('category.index')->withPosts($posts)
        //                 ->with('success','category deleted successfully');
    }
}
