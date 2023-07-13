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
    <div class="table-responsive shadow p-3 mb-5 bg-light-grey">
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
                        <td>
                            <span style="display: inline-block; width: 25px; height: 25px; border-radius: 50%; background-color: {{ $event->color }}"></span>
                        </td>
                        <td>{{ date('Y-m-d H:i:s', strtotime($event->start)) }}</td>
                        <td>{{ date('Y-m-d H:i:s', strtotime($event->end)) }}</td>
                        <td class="flex">
                            <button class="btn btn-edit-event" data-toggle="modal" data-target="#editEventModal{{$event->id}}" data-event-id="{{ $event->id }}" id="editEventBtn_{{ $event->id }}">
                                <img src="{{ asset('edit.png') }}" alt="Edit" class="img-fluid" width=30>
                            </button>
                            <form action="{{ route('events.destroy',$event->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn" type="submit">
                                    <img src="{{ asset('delete.png') }}" alt="Delete" class="img-fluid" width=30>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal para editar evento -->
                    <div class="modal fade" id="editEventModal{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editeventModalLabel">Editar Evento</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para editar evento -->
                                    <form id="editeventForm" action="{{ route('events.update', $event->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="editEventName" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="editeventName" name="name" placeholder="Nombre" value="{{$event->name}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editEventTitle" class="form-label">Título</label>
                                            <input type="text" class="form-control" id="editEventTitle" name="title" placeholder="Título" value="{{$event->title}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addEventType" class="form-label">Tipo de evento</label>
                                            <select class="form-control" id="addEventType" name="event_type_id" required>
                                                @foreach ($event_types as $event_type)
                                                    <option value="{{ $event_type->id }}">{{ $event_type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="form-group">
                                                <label for="editEventStart" class="form-label">Fecha de inicio</label>
                                                <input type="datetime-local" class="form-control" id="editEventStart" name="start" placeholder="Inicio" value="{{ date('Y-m-d\TH:i', strtotime($event->start)) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editEventEnd" class="form-label">Fecha de fin</label>
                                                <input type="datetime-local" class="form-control" id="editEventEnd" name="end" placeholder="Fin" value="{{ date('Y-m-d\TH:i', strtotime($event->end)) }}" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para añadir evento -->
                    <form id="addEventForm" action="{{ route('events.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="addEventName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="addEventName" name="name" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEventTitle" class="form-label">Título</label>
                            <input type="text" class="form-control" id="addEventTitle" name="title" placeholder="Título" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEventType" class="form-label">Tipo de evento</label>
                            <select class="form-control" id="addEventType" name="event_type_id" required>
                                @foreach ($event_types as $event_type)
                                    <option value="{{ $event_type->id }}">{{ $event_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-group">
                                <label for="addEventStart" class="form-label">Fecha de inicio</label>
                                <input type="datetime-local" class="form-control" id="addEventStart" name="start" placeholder="Inicio" required>
                            </div>
                            <div class="form-group">
                                <label for="addEventEnd" class="form-label">Fecha de fin</label>
                                <input type="datetime-local" class="form-control" id="addEventEnd" name="end" placeholder="Fin" required>
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
        $(document).ready(function () {
            // Acción de añadir evento
            $('.btn-add-event').on('click', function () {
                $('#addEventModal').modal('show');
            });
        });
    </script>
@endsection
