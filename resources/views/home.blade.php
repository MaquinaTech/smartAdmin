@extends('layouts.app')

@section('title', 'Home')

@section('content-header')
    <div class="row mb-2">
        <div class="col-6">
            <h2>Calendario</h2>
        </div>
        <div class="col-6 text-right mt-4">
            <button class="btn btn-success btn-add-event" data-toggle="modal" data-target="#addEventModal">Añadir Evento</button>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div id='calendar' class='calendar shadow p-3 mb-5 bg-light-grey'></div>
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


    <!-- Modal para editar evento -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Detalles del Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar evento -->
                    <form id="editEventForm" action="{{ route('update-events') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="editEventId" name="id">
                        <div class="mb-3">
                            <label for="editEventName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEventTitle" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Título" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEventType" class="form-label">Tipo de evento</label>
                            <select class="form-control" id="editEventType" name="event_type_id" required>
                                @foreach ($event_types as $event_type)
                                    <option value="{{ $event_type->id }}">{{ $event_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-group">
                                <label for="editEventStart" class="form-label">Fecha de inicio</label>
                                <input type="datetime-local" class="form-control" id="start" name="start" placeholder="Inicio" required>
                            </div>
                            <div class="form-group">
                                <label for="editEventEnd" class="form-label">Fecha de fin</label>
                                <input type="datetime-local" class="form-control" id="end" name="end" placeholder="Fin" required>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('delete-events') }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" id="deleteEventId" name="id">
                        <button class="btn" type="submit">
                            <img src="{{ asset('delete.png') }}" alt="Delete" class="img-fluid" width=30>
                        </button>
                    </form>
                </div>        
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                eventClick: function(info) {
                    var eventObj = info.event;
                    
                    // Abre el modal al hacer clic en un evento
                    $('#eventModal').modal('show');
                    
                    // Obtiene la fecha de inicio del evento
                    var dateString = eventObj.start.toString();
                    var dateComponents = dateString.split(' ');
                    var date = dateComponents[1] + ' ' + dateComponents[2] + ' ' + dateComponents[3];
                    var time = dateComponents[4];
                    var formattedStartDate = new Date(date + ' ' + time).toISOString().slice(0, 16);

                    // Obtiene la fecha de fin del evento
                    dateString = eventObj.end.toString();
                    dateComponents = dateString.split(' ');
                    date = dateComponents[1] + ' ' + dateComponents[2] + ' ' + dateComponents[3];
                    time = dateComponents[4];
                    var formattedEndDate = new Date(date + ' ' + time).toISOString().slice(0, 16);
                    
                    console.log(eventObj.id);
                    // Actualiza los campos del formulario con los datos del evento
                    document.getElementById('name').value = eventObj.extendedProps.name;
                    document.getElementById('title').value = eventObj.title;
                    document.getElementById('editEventType').value = eventObj.extendedProps.event_type_id;
                    document.getElementById('start').value = formattedStartDate;
                    document.getElementById('end').value = formattedEndDate;
                    document.getElementById('editEventId').value = eventObj.id;
                    document.getElementById('deleteEventId').value = eventObj.id;

                    info.jsEvent.preventDefault(); // previene que el navegador siga el enlace o realice la acción predeterminada
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                events: 'get-events',
            });
            calendar.render();
        });
    </script>
@endsection
