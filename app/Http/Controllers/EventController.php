<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
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
        $events = Event::all();
        return view('events', compact('events'));
    }

    /**
     * Get all events.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEvents()
    {
        $events = Event::all();
        Log::info($events);
        return response()->json($events);
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
        Log::info('EventController@store');
        $validate = $this->validate($request, [
            'name' => ['required','string'],
            'title' => ['required','string'],
            'color' => ['required','string'],
            'text_color' => ['required','string'],
            'start' => ['required','date'],
            'end' => ['required','date'],
        ]);
        Log::info("Datos validados");
        // Crear el nuevo usuario
        $event = new Event();
        $event->name = $request->name;
        $event->title = $request->title;
        $event->color = $request->color;
        $event->text_color = $request->text_color;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();

        Log::info("Eventoo creado");

        // Retornar una respuesta de éxito
        return back()->with('exito', 'El evento ha sido creado');
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
        $validate = $this->validate($request, [
            'name' => ['required','string'],
            'title' => ['required','string'],
            'color' => ['required','string'],
            'text_color' => ['required','string'],
            'start' => ['required','date'],
            'end' => ['required','date'],
        ]);
        $event = Event::find($id);
        $event->name = $request->name;
        $event->title = $request->title;
        $event->update();

        Log::info("EventController@update");
        Log::info("Evento actualizado: " . $event->id . " " . $event->name);

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
        $event = Event::find($id);
        Log::info("EventController@destroy");
        Log::info("Evento eliminado: " . $event->id . " " . $event->name);

        $event->delete();
        
        return back()->with('exito', 'El evento ha sido eliminado');
    }
}
