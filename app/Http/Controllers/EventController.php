<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventType;
use Carbon\Carbon;
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
        // Events
        $events = Event::all();

        // Add color to each event
        foreach ($events as $event) {
            $event->color = $event->eventType->color;
            $event->start = Carbon::parse($event->start)->format('Y-m-d H:i:s');
            $event->end = Carbon::parse($event->end)->format('Y-m-d H:i:s');
        }

        // Event types
        $event_types = EventType::all();

        // Return the view
        return view('events', compact(['events', 'event_types']));
    }

    /**
     * Get all events.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEvents()
    {
        $events = Event::all();

        // Agregar tipo de evento a cada evento
        foreach ($events as $event) {
            $event->extendedProps = [
                'type' => $event->eventType->name,
            ];
            // Add color to each event
            $event->color = $event->eventType->color;
            $event->start = Carbon::parse($event->start)->format('Y-m-d\TH:i');
            $event->end = Carbon::parse($event->end)->format('Y-m-d\TH:i');

        }
        // Retornar los eventos en formato JSON
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
            'event_type_id' => ['required','integer'],
            'title' => ['required','string'],
            'start' => ['required','date'],
            'end' => ['required','date'],
        ]);
        Log::info("Datos validados");

        // Crear el nuevo evento
        $event = new Event();
        $event->name = $request->name;
        $event->title = $request->title;
        $event->event_type_id = $request->event_type_id;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();

        Log::info("Evento creado");

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
        Log::info("EventController@update");

        // Validar los datos del formulario
        $validate = $this->validate($request, [
            'name' => ['required','string'],
            'event_type_id' => ['required','integer'],
            'title' => ['required','string'],
            'start' => ['required','date'],
            'end' => ['required','date'],
        ]);

        // Actualizar el evento
        $event = Event::find($id);
        $event->name = $request->name;
        $event->title = $request->title;
        $event->event_type_id = $request->event_type_id;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->update();

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
        $event = Event::find($id);
        Log::info("EventController@destroy");
        Log::info("Evento eliminado: " . $event->id . " " . $event->name);

        $event->delete();
        
        return back()->with('exito', 'El evento ha sido eliminado');
    }
}
