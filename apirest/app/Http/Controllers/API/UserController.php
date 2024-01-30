<?php

namespace App\Http\Controllers\API;
use App\Models\User;


use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $this->sendResponse(UserResource::collection( $users), 'Users retrieved succesfully. ');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $usuario = User::find($id);
        return view('usuarios.editar', compact('usuario'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin')->with('error', 'Usuario no encontrado');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('admin')->with('success', 'Usuario actualizado correctamente');
    }

    // Método para realizar un soft delete
    public function destroy($id)
    {
        
    }

    
    

}
