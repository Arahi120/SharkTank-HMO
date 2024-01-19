<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list () {

        $users = User::all();

        $list = [];

        foreach($users as $user){

            $object = [

            "id" => $user->id,
            "name" => $user->name,
            "surname" => $user->surname,
            "email" => $user->email,
            "phone" => $user->phone,
            "email_verified" => $user->email_verified_at,
            "password" => $user->password,
            "image" => $user->image,
            "token" => $user->remember_token,
            "created" => $user->created_at, 
            "updated" => $user->updated_at

            ];

            array_push($list,$object);
        }

        return response()->json($list);
    }

    public function item ($id) {

        $user = User::where('id','=', $id )->first();

            $object = [

                "id" => $user->id,
            "name" => $user->name,
            "surname" => $user->surname,
            "email" => $user->email,
            "phone" => $user->phone,
            "email_verified" => $user->email_verified_at,
            "password" => $user->password,
            "image" => $user->image,
            "token" => $user->remember_token,
            "created" => $user->created_at, 
            "updated" => $user->updated_at
    

            ];

        

        return response()->json($object); 
    }

}
