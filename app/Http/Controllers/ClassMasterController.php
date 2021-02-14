<?php

namespace App\Http\Controllers;

use App\Models\ClassMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassMasterController extends Controller
{
    public function listClassMaster(Request $request){
         $limit = $request->session()->get('limit');

         $count = ClassMaster::count();
         $class = ClassMaster::with('teacher')->orderByDesc('id')->offset($request->page)
         ->limit($limit)->get();
         return json_encode(['count' => $count, 'data' => $class->toArray()]);
    }

    public function getClassMaster(Request $request){
        $class = ClassMaster::where('id',$request->id)->first();       
        return $class;
    }

    public function saveClassMaster(Request $request){
        $messages = [
            'class_name.required' => 'Class Name is required',                
        ];
        
        Validator::make($request->all(), [
            'class_name' => 'required|max:255',            
        ], $messages)->validate();

        $class = new ClassMaster();
        if((int) $request->id > 0){
            $class = ClassMaster::findOrFail($request->id);
        }
        $class->class_name = $request->class_name;
        $class->class_division = $request->class_division;
        $class->teacher_id = (int)$request->teacher_id;
        $class->save();
    }

    public function deleteClassMaster(Request $request){
        ClassMaster::findOrFail($request->id)->delete();
    }
}
