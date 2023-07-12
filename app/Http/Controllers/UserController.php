<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        Log::info('UserController@store');
        $validate = $this->validate($request, [
            'name' => ['required','string'],
            'email' => ['required','string'],
            'is_active' => ['nullable','boolean'],
        ]);
        Log::info("Datos validados");

        if($request->password != $request->password2){
            // return error json
            return JsonResponse::create(['message' => 'Las contraseñas no coinciden'], 400);
        }
        // Crear el nuevo usuario
        $user = new User();
        $user->is_active = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Log::info("Usuario creado");

        // Retornar una respuesta de éxito
        return back()->with('exito', 'El usuario ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'name' => ['required','string'],
            'email' => ['required','string'],
        ]);

        Log::info('UserController@update');
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->is_active == 'on' ? 1 : 0;
        
        $user->update();

        Log::info("UserController@update");
        Log::info("Usuario actualizado: " . $user->id . " " . $user->email);

        return back()->with('exito', 'El usuario ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        Log::info("UserController@destroy");
        Log::info("Usuario eliminado: " . $user->id . " " . $user->email);
        $user->delete();
        return back()->with('exito', 'El usuario ha sido eliminado');
    }
}
