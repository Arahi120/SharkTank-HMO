<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index()
    {
        $investors = Investor::paginate(10);
        return view('admin.investor.index', compact('investors'));
    }

    public function create()
    {
        return view('admin.investor.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:20',
            'surname' => 'required|min:3|max:20',
            'dob' => 'required|date',
            'email' => 'required|email|unique:investors,email',
            'password' => 'required|min:6',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);
        $investor = Investor::create($data);

        return redirect()->route('admin.investor.index')->with('success', 'Investor creado correctamente.');
    }

    public function edit(Investor $investor)
    {
        return view('admin.investor.edit', compact('investor'));
    }

    public function update(Request $request, Investor $investor)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:20',
            'surname' => 'required|min:3|max:20',
            'dob' => 'required|date',
            'email' => 'required|email|unique:investors,email,' . $investor->id,
            'password' => 'nullable|min:6',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $investor->update($data);
        return redirect()->route('investor.index')->with('success', 'Investor actualizado correctamente.');
    }

    public function destroy(Investor $investor)
    {
        $investor->delete();
        return redirect()->route('admin.investor.index')->with('success', 'Investor eliminado correctamente.');
    }
}
