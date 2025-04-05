<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(10);
        $users = User::all(); // Obtener todos los usuarios disponibles
        return view('admin.comment.index', compact('comments', 'users'));
    }

    public function create()
    {
        return view('admin.comments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|min:3|max:500',
        ]);

        Comment::create($request->all());

        return redirect()->route('admin.comments.index')->with('success', 'Comentario agregado correctamente.');
    }

    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
{
    $request->validate([
        'content' => 'required|min:3|max:500',
    ]);

    $comment->update([
        'content' => $request->content,
    ]);
    

    // Redirigir a la vista de comentarios con un mensaje de éxito
    return redirect()->route('comment.index')->with('success', 'Comentario actualizado correctamente.');
}


    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Comentario eliminado correctamente.');
    }
}
