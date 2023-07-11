@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <div class="table-responsive">
      <table class="table table-striped">
          <thead>
              <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Alta</th>
                  <th>Email</th>
                  <th>Activado</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($users as $user)
                  <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->created_at }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->is_active }}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
@endsection
