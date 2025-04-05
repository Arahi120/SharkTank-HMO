<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;  // Asegúrate de importar Carbon para el manejo de fechas

class PostController extends Controller
{
    public function list () {
        $posts = Post::all();

        $list = [];

        foreach($posts as $post){
            // Convertir la fecha al formato correcto
            $formattedDate = Carbon::parse($post->date)->format('Y-m-d');

            $object = [
                "id" => $post->id,
                "user_id" => $post->user_id,
                "label_id" => $post->label_id,
                "title" => $post->title,
                "content" => $post->content,
                "date" => $formattedDate,  // Formateamos la fecha
                "image" => $post->image,
                "asking" => $post->asking,
                'status' => $post->status,
                "created" => $post->created_at, 
                "updated" => $post->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function posts_users (Request $request) {
        // Aseguramos que 'user_id' esté en la consulta
        $userId = $request->query('user_id');
        $posts = Post::where('user_id', $userId)->get();

        // Construir la respuesta JSON
        $list = $posts->map(function($post) {
            // Convertir la fecha al formato correcto
            $formattedDate = Carbon::parse($post->date)->format('Y-m-d');
            
            return [
                "id" => $post->id,
                "user_id" => $post->user_id,
                "label_id" => $post->label_id,
                "title" => $post->title,
                "content" => $post->content,
                "date" => $formattedDate,  // Formateamos la fecha
                "image" => $post->image,
                "asking" => $post->asking,
                'status' => $post->status,
                "created" => $post->created_at, 
                "updated" => $post->updated_at
            ];
        });

        return response()->json($list);
    }

    public function item ($id) {
        $post = Post::where('id','=', $id)->first();

        // Verificamos si el post existe
        if (!$post) {
            return response()->json(["response" => "Error: Post not found."], 404);
        }

        // Convertir la fecha al formato correcto
        $formattedDate = Carbon::parse($post->date)->format('Y-m-d');

        $object = [
            "id" => $post->id,
            "user_id" => $post->user_id,
            "label_id" => $post->label_id,
            "title" => $post->title,
            "content" => $post->content,
            "date" => $formattedDate,  // Formateamos la fecha
            "image" => $post->image,
            "asking" => $post->asking,
            'status' => $post->status,
            "created" => $post->created_at, 
            "updated" => $post->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        // Validación de los datos
        $data = $request->validate([
            'user_id' => 'required|integer',
            'label_id' => 'required|integer',
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:3|max:500',
            'date' => 'required|string',  // Validar la fecha como string para luego convertirla
            'image' => 'nullable|string|max:255',
            'asking' => 'required|numeric',
            'status' => 'required|integer|in:0,1'
        ]);
        
        // Convertir la fecha al formato correcto
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');

        $post = Post::create([
            'user_id'=> $data['user_id'],
            'label_id'=> $data['label_id'],
            'title'=> $data['title'],
            'content'=> $data['content'],
            'date'=> $data['date'],
            'image'=> $data['image'],
            'asking'=> $data['asking'],
            'status'=> $data['status']
        ]);
    
        if ($post) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $post
            ];
        
            return response()->json($object);
        } else {
            $object = [
                "response" => 'Error: Something went wrong, please try again.'
            ];
        
            return response()->json($object);
        }
    }

    public function update(Request $request, $id) {
        // Validación de los datos
        $data = $request->validate([
            'user_id' => 'required|integer',
            'label_id' => 'required|integer',
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:3|max:500',
            'date' => 'required|string',  // Validar la fecha como string
            'image' => 'nullable|string|max:255',
            'asking' => 'required|numeric',
            'status' => 'required|integer|in:0,1',
        ]);
    
        // Buscar el post por ID
        $post = Post::find($id);
    
        if (!$post) {
            return response()->json(["response" => "Error: Post not found."], 404);
        }
    
        // Convertir la fecha al formato correcto
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
    
        // Actualizar el post con los datos validados
        $post->update($data);
    
        return response()->json([
            "response" => "Success. Item updated correctly.",
            "data" => $post
        ]);
    }

    public function delete($id)
    {
        // Buscar el post por ID
        $post = Post::find($id);

        // Verificar si el post existe
        if (!$post) {
            return response()->json([
                "response" => "Error: Post not found."
            ], 404); // Si el post no existe, devuelve un error 404
        }

        // Eliminar el post
        if ($post->delete()) {
            return response()->json([
                "response" => "Success. Post deleted successfully."
            ]);
        } else {
            return response()->json([
                "response" => "Error: Something went wrong, please try again."
            ], 500); // Si hay un error en la base de datos, devuelve un error 500
        }
    }
}
