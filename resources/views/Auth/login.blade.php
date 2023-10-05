@extends('layout')

@section('conteiner')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Iniciar sesión</div>
            <div class="card-body">
                <form method="POST" action="{{url('sesion')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" placeholder="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" name="password" placeholder="password" class="form-control" id="exampleInputPassword1">
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </form>
            </div>
            <div class="mt-3 text-center">
                <p>¿No tienes una cuenta? <a href="/registrar">Regístrate aquí</a></p>
            </div>
        </div>
    </div>
</div>

@include('alerts')

@endsection
