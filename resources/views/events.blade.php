@extends('layouts.app')

@section('title', 'Home')

@section('content-header')
    <div class="row mb-2">
            <div class="col-6">
                <h2>Eventos</h2>
            </div>
            <div class="col-6 text-right mt-4">
                <button class="btn btn-success btn-add-event" data-toggle="modal" data-target="#addEventModal">Añadir Evento</button>
            </div>
    </div>
@endsection

@section('content')
    <!-- Tabla con eventos -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Título</th>
                    <th>Color</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->title }}</td>
                    <td><span style="display: inline-block; width: 25px; height: 25px; border-radius: 50%; background-color: {{ $event->color }}"></span></td>
                    <td>{{ $event->start }}</td>
                    <td>{{ $event->end }}</td>
                    <td class="flex">
                        <button class="btn btn-edit-event" data-toggle="modal" data-target="#editEventModal{{$event->id}}" data-event-id="{{ $event->id }}" id="editEventBtn_{{ $event->id }}"><img src="{{ asset('edit.png') }}" alt="Edit" class="img-fluid" width=30></button>
                        <form action="{{ route('events.destroy',$event->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn" type="submit"><img src="{{ asset('delete.png') }}" alt="Delete" class="img-fluid" width=30></button>
                        </form>
                    </td>
                    <!-- Modal para editar evento -->
                    <div class="modal fade" id="editEventModal{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editeventModalLabel">Editar Evento</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para editar evento -->
                                    <form id="editeventForm" action="{{ route('events.update', $event->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="editEventName">Nombre</label>
                                            <input type="text" class="form-control" id="editeventName" name="name" placeholder="Nombre" value="{{$event->name}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editEventTitle">Título</label>
                                            <input type="string" class="form-control" id="editEventTitle" name="title" placeholder="event" value="{{$event->title}}" required>
                                        </div>
                                        
                                        <div class="form-group input-mini">
                                            <label for="addEventColor">Fondo</label>
                                            <input type="color" class="form-control" id="addEventColor" name="color" placeholder="color" value="{{$event->color}}" required>
                                        </div>
                                        <div class="form-group input-mini">
                                            <label for="addEventTextColor">Texto</label>
                                            <input type="color" class="form-control" id="addEventTextColor" name="text_color" placeholder="text_color" value="{{$event->text_color}}"required>
                                        </div>
                                        <div class="flex between mb-4">
                                            <div class="form-group">
                                                <label for="editEventStart">Fecha de inicio</label>
                                                <input type="date" class="form-control" id="editEventStart" name="start" placeholder="start" value="{{$event->start}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editEventEnd">Fecha de fin</label>
                                                <input type="date" class="form-control" id="editEventEnd" name="end" placeholder="end" value="{{$event->end}}" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para añadir evento -->
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Añadir Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para añadir evento -->
                    <form id="addeventForm" action="{{ route('events.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="addEventName">Nombre</label>
                            <input type="text" class="form-control" id="addEventName" name="name" placeholder="Nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="addEventTitle">Título</label>
                            <input type="title" class="form-control" id="addEventTitle" name="title" placeholder="title" required>
                        </div>
                        <div class="form-group input-mini">
                            <label for="addEventColor">Fondo</label>
                            <input type="color" class="form-control" id="addEventColor" name="color" placeholder="color" required>
                        </div>
                        <div class="form-group input-mini">
                            <label for="addEventTextColor">Texto</label>
                            <input type="color" class="form-control" id="addEventTextColor" name="text_color" placeholder="text_color" required>
                        </div>
                        <div class="flex between mb-4">
                            <div class="form-group">
                                <label for="addEventStart">Fecha de inicio</label>
                                <input type="date" class="form-control" id="addEventStart" name="start" placeholder="start" required>
                            </div>
                            <div class="form-group">
                                <label for="addEventEnd">Fecha de fin</label>
                                <input type="date" class="form-control" id="addEventEnd" name="end" placeholder="end" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Acción de añadir evento
        $('.btn-add-event').on('click', function() {
            $('#addEventModal').modal('show');
        });
    });
</script>
@endsection
