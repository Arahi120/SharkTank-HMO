<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
        public function list () {

        $posts = Post::all();

        $list = [];

        foreach($posts as $post){

            $object = [

            "id" => $post->id,
            "user_id" => $post->user_id,
            "label_id" => $post->label_id,
            "title" => $post->title,
            "content" => $post->content,
            "date" => $post->date,
            "image" => $post->image,
            "asking" => $post->asking,
            "created" => $post->created_at, 
            "updated" => $post->updated_at

            ];

            array_push($list,$object);
        }

        return response()->json($list);
    }

    public function item ($id) {

        $post = Post::where('id','=', $id )->first();

            $object = [

                "id" => $post->id,
                "user_id" => $post->user_id,
                "label_id" => $post->label_id,
                "title" => $post->title,
                "content" => $post->content,
                "date" => $post->date,
                "image" => $post->image,
                "asking" => $post->asking,
                "created" => $post->created_at, 
                "updated" => $post->updated_at

            ];

        

        return response()->json($object); 
    }
}

