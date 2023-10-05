@extends('layout')


@section('conteiner')
                <!-- Contenido del mensaje -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Mensaje encriptado
                        </div>
                        <div class="card-body">
                            <p>{{$codigo}}</p>
                        </div>
                    </div>
                </div>
            </div>
@endsection
