@extends('layouts.app')

@section('title', 'Home')

@section('content-header')
    <div class="row mb-2">
        <div class="col-6">
            <h2>Tipos de Evento</h2>
        </div>
        <div class="col-6 text-right mt-4">
            <button class="btn btn-success btn-add-event-type" data-toggle="modal" data-target="#addEventTypeModal">Añadir Tipo de Evento</button>
        </div>
    </div>
@endsection

@section('content')

    <!-- Tabla con tipos de evento -->
    <div class="table-responsive shadow p-3 mb-5 bg-light-grey">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event_types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td><span style="display: inline-block; width: 25px; height: 25px; border-radius: 50%; background-color: {{ $type->color }}"></span></td>
                    <td class="flex">
                        <button class="btn btn-edit-type" data-toggle="modal" data-target="#editEventTypeModal{{$type->id}}" data-event-id="{{ $type->id }}" id="editEventTypeBtn_{{ $type->id }}"><img src="{{ asset('edit.png') }}" alt="Edit" class="img-fluid" width=30></button>
                        <form action="{{ route('event-types.destroy',$type->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn" type="submit"><img src="{{ asset('delete.png') }}" alt="Delete" class="img-fluid" width=30></button>
                        </form>
                    </td>
                    <!-- Modal para editar tipo de evento -->
                    <div class="modal fade" id="editEventTypeModal{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="editEventTypeModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editeventModalLabel">Editar Evento</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para editar tipo de evento -->
                                    <form id="editeventForm" action="{{ route('event-types.update', $type->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="editEventName">Nombre</label>
                                            <input type="text" class="form-control" id="editEventTypeName" name="name" placeholder="Nombre" value="{{$type->name}}" required>
                                        </div>
                                        
                                        <div class="form-group input-mini">
                                            <label for="addEventTypeColor">Color</label>
                                            <input type="color" class="form-control" id="addEventTypeColor" name="color" placeholder="color" value="{{$type->color}}" required>
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

    <!-- Modal para añadir tipo de evento -->
    <div class="modal fade" id="addEventTypeModal" tabindex="-1" role="dialog" aria-labelledby="addEventTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventTypeModalLabel">Añadir Tipo de Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para añadir tipo de evento -->
                    <form id="addEventTypeForm" action="{{ route('event-types.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="addEventTypeName">Nombre</label>
                            <input type="text" class="form-control" id="addEventTypeName" name="name" placeholder="Nombre" required>
                        </div>
                        <div class="form-group input-mini">
                            <label for="addEventTypeColor">Color</label>
                            <input type="color" class="form-control" id="addEventTypeColor" name="color" placeholder="color" required>
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
        // Acción de añadir tipo de evento
        $('.btn-add-event-type').on('click', function() {
            $('#addEventTypeModal').modal('show');
        });
    });
</script>
@endsection
