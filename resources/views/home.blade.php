@extends('layouts.app')

@section('title', 'Home')

@section('content-header')
    <div class="row mb-2">
        <div class="col-6">
            <h2>Calendario</h2>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div id='calendar' class='calendar shadow p-3 mb-5 bg-light-grey'></div>
    </div>

    <!-- Modal -->
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
                    <!-- Coloca aquí el formulario con los datos del evento -->
                    <div class="form-group">
                        <label for="editEventName">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" disabled>
                    </div>
                    <div class="form-group">
                        <label for="editEventTitle">Título</label>
                        <input type="string" class="form-control" id="title" name="title" placeholder="event" disabled>
                    </div>
                    <div class="form-group input-mini">
                        <label for="addEventColor">Fondo</label>
                        <input type="color" class="form-control" id="color" name="color" placeholder="color" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                    console.log(eventObj);
                    // Actualiza los campos del formulario con los datos del evento
                    document.getElementById('name').value = eventObj.extendedProps.name;
                    document.getElementById('title').value = eventObj.title;
                    document.getElementById('color').value = eventObj.backgroundColor;
                    document.getElementById('start').value = eventObj.extendedProps.start;
                    document.getElementById('end').value = eventObj.extendedProps.end;

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
