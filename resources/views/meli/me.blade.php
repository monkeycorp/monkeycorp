@extends('layouts.meli')

@section('content')

    <h1>My Profile</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="table-responsive">
                <h4>
                    <strong>Request <code>/users/me</code> -> JSON Output:</strong>
                </h4>
                <pre><code class="json">@json($me, JSON_PRETTY_PRINT)</code></pre>
            </div>
        </div>
        <div class="col-md-6">
            <h3>My Data</h3>
            <div class="table-responsive">
                @melitable($me)
            </div>
        </div>
    </div>
@endsection