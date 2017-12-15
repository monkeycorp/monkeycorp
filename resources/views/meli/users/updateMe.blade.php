@extends('layouts.meli')

@section('content')
    <h1>
        Update My Profile <small>Test</small>
    </h1>

    <div class="row">
        <div class="col-md-6">
            <div class="well">
                <form action="{{ route('meli.users.me.update') }}" method="POST" class="form-horizontal">
                    <legend>Profile</legend>

                    <div class="form-group">
                        <label for="first_name" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            {{ csrf_field() }}
                            <input type="text" class="form-control input-sm"
                                   name="first_name" id="first_name" value="{{ $me->first_name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm"
                                   name="last_name" id="last_name" value="{{ $me->last_name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="identification_type" class="col-md-3 control-label">Identification Type</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm"
                                   name="identification_type" id="identification_type"
                                   value="{{ $me->identification->type }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="identification_number" class="col-md-3 control-label">Identification Number</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm"
                                   name="identification_number" id="identification_number"
                                   value="{{ $me->identification->number }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="col-md-3 control-label">City</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm"
                                   name="city" id="city"
                                   value="{{ $me->address->city }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="zip_code" class="col-md-3 control-label">Zip Code</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm"
                                   name="zip_code" id="zip_code"
                                   value="{{ $me->address->zip_code }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-sm btn-success" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="col-md-6">
                <div class="alert alert-danger">
                    <h4>
                        <strong>Errors</strong>
                    </h4>
                    <hr>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (! empty($status) && $status === 200)
            <div class="col-md-6">
                <div class="alert alert-success">
                    <p>
                        <strong>Your profile was updated successfully</strong>
                    </p>
                </div>
            </div>
        @endif

        @if (! empty($status) && $status !== 200)
            <div class="col-md-6">
                <div class="alert alert-danger">
                    <p>
                        <strong>{{ $result->message }}</strong>
                    </p>
                </div>
            </div>
        @endif
    </div>
@endsection