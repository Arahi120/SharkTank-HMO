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
    public function create(Request $request) {
        $data = $request->validate([
            'user_id'=> 'required|min:3,max:20',
            'label_id'=> 'required|min:3,max:20',
            'title'=> 'required|min:3,max:20',
            'content'=> 'required|min:3,max:20',
            'date'=> 'required|min:3,max:20',
            'image'=> 'required|min:3,max:20',
            'asking'=> 'required|min:3,max:20'
            
        ]);
            
        $post = Post::create([
            'user_id'=> $data['user_id'],
            'label_id'=> $data['label_id'],
            'title'=> $data['title'],
            'content'=> $data['content'],
            'date'=> $data['date'],
            'image'=> $data['image'],
            'asking'=> $data['asking']
                
        ]);
    
        if ($post) {
            $object = [
    
                "response" => 'Succes.Item saved correctly.',
                "data" => $post
        
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
            'user_id'=> 'required|min:3,max:20',
            'label_id'=> 'required|min:3,max:20',
            'title'=> 'required|min:3,max:20',
            'content'=> 'required|min:3,max:20',
            'date'=> 'required|min:3,max:20',
            'image'=> 'required|min:3,max:20',
            'asking'=> 'required|min:3,max:20'
            
        ]);

        $post = post::where('id', '=', $id)->first();
            
        $post->user_id = $data['user_id'];
        $post->label_id = $data['label_id'];
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->date = $data['date'];
        $post->image = $data['image'];
        $post->asking = $data['asking'];
        
        if ($post->update()) {
            $object = [
    
                "response" => 'Succes.Item updated correctly.',
                "data" => $post
        
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

