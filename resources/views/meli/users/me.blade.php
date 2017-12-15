@extends('layouts.meli')

@section('content')

    <h1>My Profile</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="table-responsive">
                <h4>
                    <strong>JSON Output:</strong>
                </h4>
                <hr>
                <pre><code class="json">@json($me, JSON_PRETTY_PRINT)</code></pre>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h4>
                        <strong>My Data - Request</strong>
                        <code>/users/me</code>
                    </h4>
                    <a href="{{ route('meli.users.me.update') }}" class="btn btn-sm btn-primary">
                        Update my profile
                    </a>
                    <hr>
                    <div class="table-responsive">
                        @melitable($me)
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <strong>Payments - Request </strong>
                        <code>/users/{{ $me->id }}/accepted_payment_methods</code>
                    </p>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Payment Type Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments->results as $payment)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ $payment->secure_thumbnail }}" class="img-responsive" alt="">
                                        </td>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->name }}</td>
                                        <td>{{ $payment->payment_type_id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <strong>Addresses - Request</strong>
                        <code>/users/{{ $me->id }}/adresses</code>
                    </p>
                    <hr>
                    @if (count($address->results) > 0)
                        @melitable($address->results[0])
                    @endif

                    @if (count($address->results) < 1)
                        <p class="text-danger text-center">
                            <strong>Address Not Found</strong>
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <strong>Listing Types - Request</strong>
                        <code>/users/{{ $me->id }}/available_listing_types</code>
                    </p>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Site ID</th>
                                    <th>Remaining Listings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listingTypes->available as $listingType)
                                    <tr>
                                        <td>{{ $listingType->id }}</td>
                                        <td>{{ $listingType->name }}</td>
                                        <td>{{ $listingType->site_id }}</td>
                                        <td>{{ $listingType->remaining_listings }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <strong>Brands - Request</strong>
                        <code>/users/{{ $me->id }}/brands</code>
                    </p>
                    <hr>
                    @if (isset($brands->message))
                        <p class="text-danger text-center">
                            <strong>{{ $brands->message }}</strong>
                        </p>
                    @endif

                    @if (! isset($brands->message))
                        <pre><code class="json">@json($brands, JSON_PRETTY_PRINT)</code></pre>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection