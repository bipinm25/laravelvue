<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }

    public function saveTag(Request $request){
        
        $tag = new Tag();
        if(isset($request->id) &&  $request->id > 0){
            $tag = Tag::findOrFail($request->id);
        }        
        $tag->tag = $request->fieldvalue;
        $tag->save();
    }

    public function getTag(Request $request){
        $limit = $request->session()->get('limit');
        $count = Tag::count();
        //\Log::info($count);
        $tag = Tag::orderByDesc('id')->offset($request->page)
        ->limit($limit)->get();
        return response()->json(['count' => $count,'data' => $tag->toArray()]);
    }

    public function deleteTag(Request $request){

        $this->validate($request, [
            'id' => 'required',
            ]);
            
        return Tag::where('id', $request->id)->delete();
    }
}
