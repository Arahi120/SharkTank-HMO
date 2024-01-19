<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function list () {

        $comments = Comment::all();

        $list = [];

        foreach($comments as $comment){

            $object = [

            "id" => $comment->id,
            "post_id" => $comment->post_id,
            "user_id" => $comment->user_id,
            "content" => $comment->content,
            "created" => $comment->created_at, 
            "updated" => $comment->updated_at

            ];

            array_push($list,$object);
        }

        return response()->json($list);
    }

    public function item ($id) {

        $comment = Comment::where('id','=', $id )->first();

            $object = [

            "id" => $comment->id,
            "name" => $comment->name,
            "description" => $comment->description,
            "created" => $comment->created_at, 
            "updated" => $comment->updated_at

            ];

        

        return response()->json($object); 
    }
}

