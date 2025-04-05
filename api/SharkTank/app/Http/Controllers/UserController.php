<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);
        return view('admin.user.index', compact('users'));
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name'=> 'required|min:3,max:50',
        'surname'=> 'required|min:3,max:50',
        'email'=> 'required|min:1,max:50',
        'phone'=> 'required|min:1,max:50',
        'password'=> 'required|min:1,max:50',
        'level_id'=> 'required|min:1,max:2',
        'image'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'surname' => $request->surname,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
        'level_id' => $request->level_id,
        'status' => $request->status,
    ]);

    return redirect()->route('user.index')->with('success', 'Usuario actualizada exitosamente');
}


    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'El usuario no existe.');
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuario eliminado correctamente!');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name'=> 'required|min:3,max:50',
            'surname'=> 'required|min:3,max:50',
            'email'=> 'required|min:1,max:50',
            'phone'=> 'required|min:1,max:50',
            'password'=> 'required|min:1,max:50',
            'level_id'=> 'required|min:1,max:2'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->level_id = $request->level_id;  
        $user->save(); // Guardar el nuevo registro en la base de datos

        return redirect()->route('user.index')->with('success', 'Usuario creada correctamente.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }



    
}
