<?php

namespace App\Http\Controllers;
use App\Models\Author;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        $authors = Author::latest()->paginate(5);
        return view('author.index',compact('authors'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required',
            'image'=>'nullable',
            'publish'=>'nullable'
            ));

        $author = new Author;
        $author->name = $request->name;
        $author->publish = $request->has('publish');
        if ($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename=time() . '.' . $extension;
            $file->move('uploads/author', $filename);
            $author->image=$filename;
        } else{
            // return $request;
            $author->image= '';
        }         
        
        $author->save();

        return redirect()->route('author.index')
        ->with('success','Author created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        return view('author.show')->withAuthor($author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'publish'=>'nullable',
            'image'=>'nullable'
        ]);
    
        // $author->update($request->all());        
        $author=Author::find($id);
        $author->name=$request->input('name');
        $author->publish = $request->has('publish');

        if (request()->hasFile('image') && request('image') != '') {
            $imagePath = public_path('uploads/author/'.$author->image);
            if(Author::exists($imagePath)){
                unlink($imagePath);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename=time() . '.' . $extension;
            $file->move('uploads/author/', $filename);
            $author->image=$filename;
            $author->update();
        }
                 
        
        $author->update();
    
        return redirect()->route('author.index')
                        ->with('success','Author details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author= Author::find($id);
  
        $author->delete();
        return redirect()->route('author.index')
                        ->with('success','Author deleted successfully');
    }
}
