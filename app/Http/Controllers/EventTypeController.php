<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventType;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventTypeController extends Controller
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
        $event_types = Event::all();
        return view('event_types', compact('event_types'));
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
        Log::info('EventTypeController@store');
        $validate = $this->validate($request, [
            'name' => ['required','string'],
        ]);
        Log::info("Datos validados");

        // Crear el nuevo tipo de evento
        $event_type = new EventType();
        $event_type->name = $request->name;
        $event_type->save();

        Log::info("Tipo de evento creado");

        // Retornar una respuesta de éxito
        return back()->with('exito', 'El tipo de evento ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info("EventTypeController@update");

        // Validar los datos del formulario
        $validate = $this->validate($request, [
            'name' => ['required','string'],
        ]);

        // Actualizar el evento
        $event_type = EventType::find($id);
        $event_type->name = $request->name;
        $event_type->update();

        Log::info("Evento actualizado: " . $event->id . " " . $event->name);

        // Retornar una respuesta de éxito
        return back()->with('exito', 'El evento ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar el evento
        $event_type = Event::find($id);
        Log::info("EventTypeController@destroy");
        Log::info("Tipo de evento eliminado: " . $event_type->id . " " . $event_type->name);
        $event_type->delete();
        
        // Retornar una respuesta de éxito
        return back()->with('exito', 'El tipo de evento ha sido eliminado');
    }
}
