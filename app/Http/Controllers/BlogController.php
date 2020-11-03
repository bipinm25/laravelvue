<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }

    public function listBlog(Request $request){
        $limit = $request->session()->get('limit');
        $count = Blog::with('category')->count();        
        $blog = Blog::with('category')->orderByDesc('id')->offset($request->page)
        ->limit($limit)->get();
        return json_encode(['count' => $count,'data' => $blog->toArray()]);

    }

    public function saveBlog(Request $request){

        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|numeric|gt:0',
        ]);

        $blog = new Blog();
        if($request->id > 0){
            $blog = Blog::findOrFail($request->id);
        }
        $blog->title = $request->title;
        $blog->category_id = $request->category_id;
        $blog->blog_content = $request->content?$request->content:'';
        $blog->status = $request->status=='true'?1:0;
        $blog->image = '';
        if($request->hasFile('image')){
            $blog->image = $request->file('image')->store('public/blog'); 
        }              
        $blog->save();

        if(strlen($request->tag_id) > 0) $blog->tag()->sync(explode(',', $request->tag_id)); //need blog id to save this

        //Log::info($request->file('image')->store('blog'));
    }

    public function getBlog($id){
       // Log::info($id);
       //return Storage::url('blog/QTmSCEGKG8CoTA0LuQEMu9ToxgIFFqCBxwsaOrag.jpeg');
       $blog = Blog::with('tag')->where('id',$id)->first();
       $blog->image = Storage::url($blog->image);
       return $blog;
    //    Log::info($blog);
    //    Log::info($blog->image);
        //return Blog::where('id',$id)->get();
    }

    public function deleteBlog(Request $request){

        $this->validate($request, [
            'id' => 'required',
            ]);
        
        return Blog::where('id', $request->id)->delete();

    }
}
