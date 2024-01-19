<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    // funcion lista
    public function list () {

        $investors = Investor::all();

        $list = [];

        foreach($investors as $investor){

            $object = [

            "id" => $investor->id,
            "name" => $investor->name,
            "surname" => $investor->surname,
            "dob" => $investor->dob,
            "image" => $investor->image,
            "description" => $investor->description,
            "created" => $investor->created_at, 
            "updated" => $investor->updated_at

            ];

            array_push($list,$object);
        }

        return response()->json($list);
    }

    public function item ($id) {

        $investor = Investor::where('id','=', $id )->first();

            $object = [

            "id" => $investor->id,
            "name" => $investor->name,
            "surname" => $investor->surname,
            "dob" => $investor->dob,
            "image" => $investor->image,
            "description" => $investor->description,
            "created" => $investor->created_at, 
            "updated" => $investor->updated_at

            ];

        

        return response()->json($object); 
    }

}
