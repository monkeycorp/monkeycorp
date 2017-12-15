@extends('layouts.meli')

@section('content')
    <h1>Update My Profile</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="well">
                <form action="{{ url('mercado-libre') }}" class="form-horizontal">
                    <legend>Profile</legend>

                    <div class="form-group">
                        <label for="firstName" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm" name="firstName" id="firstName">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection