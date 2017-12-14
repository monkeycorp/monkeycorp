@extends('layouts.meli')

@section('content')

    <h1>My Profile - MercadoLibre</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>My Data</h3>
            <div class="table-responsive">
                <table class="table striped hover boder">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($me as $key => $value)
                            @if (
                                gettype($value) != 'object' &&
                                gettype($value) != 'NULL' &&
                                gettype($value) != 'array'
                            )
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $value }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-6">
            <div class="table-responsive">
                <h3>JSON Output -> </h3>
                <code>
                    @json($me)
                </code>
            </div>
        </div>
    </div>
@endsection