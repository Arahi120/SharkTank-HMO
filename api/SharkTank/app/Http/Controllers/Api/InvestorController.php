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
            "email" =>$investor->email,
            "password" =>$investor->password,
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
            "email" =>$investor->email,
            "password" =>$investor->password,
            "image" => $investor->image,
            "description" => $investor->description,
            "created" => $investor->created_at, 
            "updated" => $investor->updated_at

            ];

        

        return response()->json($object); 
    }

    public function create(Request $request) {
        $data = $request->validate([
            'name'=> 'required|min:3,max:20',
            'surname'=> 'required|min:3,max:20',
            'dob'=> 'required|min:3,max:20',
            'email'=> 'required|min:3,max:20',
            'password'=> 'required|min:3,max:20',
            'image'=> 'required|min:3,max:20'
            
        ]);
            
        $investor = Investor::create([
            'name'=> $data['name'],
            'surname'=> $data['surname'],
            'dob'=> $data['dob'],
            'email' => $data['email'],
            'password' => $data['password'],
            'image'=> $data['image']
                
        ]);
    
        if ($investor) {
            $object = [
    
                "response" => 'Succes.Item saved correctly.',
                "data" => $investor
        
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
            'surname'=> 'required|min:3,max:20',
            'dob'=> 'required|min:3,max:20',
            'email'=> 'required|min:3,max:20',
            'password'=> 'required|min:3,max:20',
            'image'=> 'required|min:3,max:20'
            
        ]);

        $investor = investor::where('id', '=', $data['id'])->first();
            
        $investor->name = $data['name'];
        $investor->surname = $data['surname'];
        $investor->dob = $data['dob'];
        $investor->email = $data['email'];
        $investor->password = $data['password'];
        $investor->image = $data['image'];
        
        if ($investor->update()) {
            $object = [
    
                "response" => 'Succes.Item updated correctly.',
                "data" => $investor
        
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
