<?php

namespace App\Http\Controllers;
use App\Models\Page;
use Illuminate\Http\Request;
use DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = Page::orderBy('id','DESC')->get();
        return view('pages.index',compact('pages'));     

    }

    
    public function getData(){
        $page = Page::get();
        return json_encode(array('data'=>$page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'publish' => 'required',
        ]);
        Page::create($request->all());
        return json_encode(array(
            "statusCode"=>200
        ));
    }
        // $page = new Page;
        // $page->name = request('name');        
        // $page->publish = $request->has('publish');
        // $page->save();  
        // return response()->json($page);   
        
        
        // $request->validate([
        //     'name'       => 'required|max:255',
        //     'publish' => 'nullable',
        //   ]);
    
        //   $page = Page::updateOrCreate(['id' => $request->id], [
        //             'name' => $request->title,
        //             'publish' => $request->publish
        //           ]);
    
        //   return response()->json($page);
        

    public function show($id)
    {
        $page = Page::find($id);

        return response()->json($page);
    }
      

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDatabyID($id)
    {
        $page=Page::find($id);
        return response()->json($page);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $page  = Page::find($request->id);
        
        $page->name = request('name');        
        $page->publish = $request->has('publish');
        $page->save();  
        return response()->json($page);   

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id)->delete();

        return response()->json(['success'=>'Data Deleted successfully']);
    }
}