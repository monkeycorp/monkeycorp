@extends('layouts.meli')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Authentication with MercadoLibre</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 text-center">
            <a href="{{ $authLink }}" class="btn btn-md btn-primary">
                Ingresa con MercadoLibre
            </a>
        </div>
    </div>

@endsection

