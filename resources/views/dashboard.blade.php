@extends('layout')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Mi Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('signout')}}">Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</nav>

@section('conteiner')

@if ($message = Session::get('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{$message}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="row mt-3">
    <div class="col-12 col-lg-8 offset-0 offset-lg-2">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1">
            Encriptar
        </button>
        @if (Auth::user()->rol_id == 1)
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Desencriptar
        </button>
        @endif
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{url('encryptWeb')}}">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-graduation-cap"></i></span>
                <input type="string" name="codigo" class="form-control" placeholder="mensaje" aria-label="Username"><br>
                @error('codigo')
                <br> <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Encriptar</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{url('decrypt')}}">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-graduation-cap"></i></span>
                <input type="string" name="codigo" class="form-control" placeholder="mensaje" aria-label="Username"><br>
                @error('codigo')
                <br> <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Desencriptar</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@include('alerts')

@endsection
