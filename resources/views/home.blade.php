@extends('layouts.app')

@section('title', 'Home')
<head>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                
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
</head>
@section('content-header')
    <h1>Calendario de eventos</h1>
@endsection
@section('content')

        <div class="row">
            <div id='calendar' class='calendar'></div>
        </div>
    
    
@endsection
