<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function list () {

        $labels = Label::all();

        $list = [];

        foreach($labels as $label){

            $object = [

            "id" => $label->id,
            "name" => $label->name,
            "description" => $label->description,
            "created" => $label->created_at, 
            "updated" => $label->updated_at

            ];

            array_push($list,$object);
        }

        return response()->json($list);
    }

    public function item ($id) {

        $label = Label::where('id','=', $id )->first();

            $object = [

            "id" => $label->id,
            "name" => $label->name,
            "description" => $label->description,
            "created" => $label->created_at, 
            "updated" => $label->updated_at

            ];

        

        return response()->json($object); 
    }
    public function create(Request $request) {
        $data = $request->validate([
            'name'=> 'required|min:3,max:20',
            'description'=> 'required|min:3,max:20'
            
        ]);
            
        $label = Label::create([
            'name'=> $data['name'],
            'description'=> $data['description']
                
        ]);
    
        if ($label) {
            $object = [
    
                "response" => 'Succes.Item saved correctly.',
                "data" => $label
        
            ];
        
            return response()->json($object);
        }else {
            $object = [

                "response" => 'Error:Something went wrong, please try again.',
        
            ];
        
            return response()->json($object);
    }
}

    public function update(Request $request) {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
            'name'=> 'required|min:3,max:20',
            'description'=> 'required|min:3,max:20'
            
        ]);

        $label = label::where('id', '=', $data['id'])->first();
            
        $label->name = $data['name'];
        $label->description = $data['description'];
        
        if ($label->update()) {
            $object = [
    
                "response" => 'Succes.Item updated correctly.',
                "data" => $label
        
            ];
        
            return response()->json($object);
        }else {
            $object = [

                "response" => 'Error:Something went wrong, please try again.',
        
            ];
        
            return response()->json($object);

        }
    
    }
}
