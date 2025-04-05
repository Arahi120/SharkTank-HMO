<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Post;
use App\Models\User;
use App\Models\Investor;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    // Mostrar todas las ofertas
    public function index()
    {
        $offers = Offer::paginate(10);  // Puedes usar paginate o all() dependiendo de tus necesidades
        $posts = Post::all();  // Obtener todas las publicaciones disponibles
        $investors = Investor::all(); 

        return view('admin.offer.index', compact('offers', 'posts', 'investors'));
    }

    // Ver detalles de una oferta
    public function show($id)
    {
        $offer = Offer::findOrFail($id);

        return view('admin.offers.show', compact('offer'));
    }

    // Mostrar formulario para crear una oferta
    public function create()
    {
        $posts = Post::all();  // Obtener todas las publicaciones disponibles
        $investors = User::where('level_id', 2)->get();  // Suponiendo que el nivel 2 son los inversionistas

        return view('admin.offers.create', compact('posts', 'investors'));
    }

    // Guardar una nueva oferta
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'investor_id' => 'required|exists:users,id',
            'offer' => 'required|string|max:255',
        ]);

        $offer = Offer::create([
            'post_id' => $request->post_id,
            'investor_id' => $request->investor_id,
            'offer' => $request->offer,
        ]);

        return redirect()->route('offer.index')->with('success', 'Oferta creada correctamente');
    }

    // Mostrar formulario para editar una oferta
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $posts = Post::all();
        $investors = User::where('level_id', 2)->get();  // Suponiendo que el nivel 2 son los inversionistas

        return view('admin.offer.edit', compact('offer', 'posts', 'investors'));
    }

    // Actualizar una oferta existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'investor_id' => 'required|exists:users,id',
            'offer' => 'required|string|max:255',
        ]);

        $offer = Offer::findOrFail($id);

        $offer->update([
            'post_id' => $request->post_id,
            'investor_id' => $request->investor_id,
            'offer' => $request->offer,
        ]);

        return redirect()->route('offer.index')->with('success', 'Oferta actualizada correctamente');
    }

    // Eliminar una oferta
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        return redirect()->route('offer.index')->with('success', 'Oferta eliminada correctamente');
    }
}
