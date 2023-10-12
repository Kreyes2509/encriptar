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

@if ($message = Session::get('msj'))
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Desencriptar
        </button>
    </div>
</div>
<br>

<div class="row mt-3">
    <div class="col-12 col-lg-8 offset-0 offset-lg-2">
        <h2>Mensajes enviados</h2>
        <div class="table-responsive">
            <table class="table table-fixed">
                <thead>
                    <tr>
                        <th scope="col" class="col-3">mensaje</th>
                        <th scope="col" class="col-4">desencriptado</th>
                        <th scope="col" class="col-4">destinatario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($codigos as $codigo)
                        <tr>
                            <td class="col-3">{{$codigo->encryptar}}</td>
                            @if ($codigo->status == 1)
                                <td class="col-4">{{$codigo->desencryptar}}</td>
                            @else
                                <td class="col-4">el mensaje no a sido descifrado</td>
                            @endif
                            <td class="col-4">{{$codigo->destinatario}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 col-lg-8 offset-0 offset-lg-2">
        <h2>Mensajes recibidos</h2>
        <div class="table-responsive">
            <table class="table table-fixed">
                @if (count($mensaje) > 0)
                    <thead>
                        <tr>
                            <th scope="col" class="col-3">mensaje</th>
                            <th scope="col" class="col-4">desencriptado</th>
                            <th scope="col" class="col-4">destinatario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mensaje  as $codigo1)
                            <tr>
                                <td class="col-3">{{$codigo1->encryptar}}</td>
                                @if ($codigo1->status == 1)
                                    <td class="col-4">{{$codigo1->desencryptar}}</td>
                                @else
                                    <td class="col-4">el mensaje no a sido descifrado</td>
                                @endif
                                <td class="col-4">{{$codigo1->destinatario}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <p>no tienes mensajes</p>
                @endif
            </table>
        </div>
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
            <form method="POST" action="{{ url('encryptWeb') }}">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-graduation-cap"></i></span>
                    <input type="string" name="codigo" class="form-control" placeholder="mensaje" aria-label="Username">
                    @error('codigo')
                    <br> <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Usuario a quien va dirigida la frase</label>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" name="user_id" aria-label="Default select example">
                            <option selected>Usuarios</option>
                            @foreach ($users as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
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

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('5160c8cff0011923445c', {
            cluster: 'us2'
            });

            var channel = pusher.subscribe('mensaje');
            channel.bind('msj-event', function(data) {
            let mensaje = JSON.stringify(data);
            console.log(mensaje)
            window.location.href = "{{route('dashboard')}}";
        });
  </script>
