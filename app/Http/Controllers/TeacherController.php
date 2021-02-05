<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
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
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function listTeachers(Request $request){

        $limit = 5;

        $count = Teacher::count();
        $teacher = Teacher::orderByDesc('id')->offset($request->page)
        ->limit($limit)->get();
        return json_encode(['count' => $count, 'data' => $teacher->toArray()]);

    }

    public function getTeacher(Request $request){
        $teacher = Teacher::where('id',$request->id)->first();       
        return $teacher;
    }

    public function deleteTeacher(Request $request){
            $teacher = Teacher::findOrFail($request->id)->delete();
    }

    public function saveTeacher(Request $request){
        $messages = [
            'first_name.required' => 'First Name is required',                
        ];
        
        Validator::make($request->all(), [
            'first_name' => 'required|max:255',            
        ], $messages)->validate();

        $teacher = new Teacher();
        if((int) $request->id > 0){
            $teacher = Teacher::findOrFail($request->id);
        }
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->gender = $request->gender;
        $teacher->email = $request->email;
        $teacher->doj = $request->doj;
        $teacher->save();
    }
}
