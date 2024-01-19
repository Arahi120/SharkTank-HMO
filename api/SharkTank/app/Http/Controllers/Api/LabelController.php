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
}
