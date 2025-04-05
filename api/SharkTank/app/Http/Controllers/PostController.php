<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // Importar Carbon para manejo de fechas

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->paginate(10);
        $labels = Label::all(); 
        return view('admin.post.index', compact('posts','labels'));
    }
/*
    public function create()
    {
        return view('admin.post.create'); // Vista para agregar un nuevo post
    }*/

    public function add(Request $request)
    {
        //dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'label_id' => 'required|integer',
            'date' => 'required|date',
            'image' => 'required|string',
            'asking' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $post = Post::Create([
            'title' => $request['title'],
            'content' => $request['content'],
            'label_id' => $request['label_id'],
            'date' => $request['date'],
            'image' => $request['image'],
            'asking' => $request['asking'],
            'status' => $request['status'],
            'user_id' => 1,
        ]);

        return redirect()->route('post.index')->with('success', 'Post creado correctamente');
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3',
            'label_id' => 'required|exists:labels,id',
            'date' => 'required|string',
            'image' => 'required|string',
            'asking' => 'required|min:3|max:255',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data['date'] = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['date' => 'El formato de fecha debe ser dd/mm/yyyy'])->withInput();
        }

        $post = Post::findOrFail($id);
        //dd($post);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'label_id' => $request->label_id,
            'date' => $data['date'],
            'image' => $request->image,
            'asking' => $request->asking,
            'status' => $request->status,
        ]);
        //dd('actualizado');

        return redirect()->route('post.index')->with('success', 'Post actualizado correctamente');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Post no encontrado');
        }

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post eliminado correctamente');
    }

    public function show($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Post no encontrado');
        }
        
        return view('admin.post.show', compact('post'));
    }
}
