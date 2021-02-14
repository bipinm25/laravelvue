<?php

namespace App\Http\Controllers;

use App\Models\ParentMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParentMasterController extends Controller
{
    public function saveParent(Request $request){
        $messages = [
            'first_name.required' => 'First Name is required',                 
        ];
        
        Validator::make($request->all(), [
            'first_name' => 'required|max:255',
        ], $messages)->validate();

        $parent = new ParentMaster();
        if($request->id > 0){
            $parent = ParentMaster::findOrFail($request->id);
        }
        $parent->first_name = $request->first_name;
        $parent->last_name = $request->last_name;
        $parent->email = $request->email;
        $parent->phone = $request->phone;
        $parent->save();
    }

    public function listParent(Request $request){
        $limit = $request->session()->get('limit');        
        
        $count = ParentMaster::count();       
        $parent = ParentMaster::orderByDesc('id')->offset($request->page)
        ->limit($limit)->get();
        return json_encode(['count' => $count,'data' => $parent->toArray()]);
    }

    public function getParent(Request $request){
        $parent = new ParentMaster();
        return ParentMaster::where('id',$request->id)->first();       
    }

    public function deleteParent(Request $request){
        $parent = ParentMaster::findOrFail($request->id)->delete();
    }
}
