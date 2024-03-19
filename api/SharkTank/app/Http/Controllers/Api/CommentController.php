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
    public function create(Request $request) {
            $data = $request->validate([
                'post_id'=> 'required|min:3,max:20',
                'user_id'=> 'required|min:3,max:20',
                'content'=> 'required|min:3,max:20'
                
            ]);
                
            $comment = Comment::create([
                'post_id'=> $data['post_id'],
                'user_id'=> $data['user_id'],
                'content'=> $data['content']
                    
            ]);
        
            if ($comment) {
                $object = [
        
                    "response" => 'Succes.Item saved correctly.',
                    "data" => $comment
            
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
                'post_id'=> 'required|min:3,max:20',
                'user_id'=> 'required|min:3,max:20',
                'content'=> 'required|min:3,max:20'
                
            ]);

            $comment = comment::where('id', '=', $data['id'])->first();
                
            $comment->post_id = $data['post_id'];
            $comment->user_id = $data['user_id'];
            $comment->content = $data['content'];
            
            if ($comment->update()) {
                $object = [
        
                    "response" => 'Succes.Item updated correctly.',
                    "data" => $comment
            
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

