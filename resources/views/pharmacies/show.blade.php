@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-8">
            <h3>Exchange Program Record Details</h3>
        </div>
        <div class="d-flex justify-content-end">
            <a href='{{ url("/pharmacies/$pharmacy->id/edit") }}' class="btn btn-primary mx-2">Edit Pharmacy Detail</a>
            @if($pharmacy->is_active == 1)
                {!! Form::open(['route' => ['pharmacies.deactivate', $pharmacy->id], 'method' => 'GET']) !!}
                {{ Form::submit('Deactivate Pharmacy', ['class' => 'btn btn-danger mx-2']) }}
                {!! Form::close() !!}
            @else
                {!! Form::open(['route' => ['pharmacies.activate', $pharmacy->id], 'method' => 'GET']) !!}
                {{ Form::submit('Activate Pharmacy', ['class' => 'btn btn-success mx-2']) }}
                {!! Form::close() !!}
            @endif
            <a href='{{ url("/pharmacies/") }}' class="btn btn-secondary mx-2">Go Back</a>
        </div>

    </div>


    <!-- Pharamacy Details Content -->
    <div class="detailsBox p-2 mb-2">
        <div class="row">
            <div class="col-md-12">
                <h4>Pharmacy Details</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Pharmacy's Name</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $pharmacy->pharmacy_name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Pharmacy's Account Number</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $pharmacy->pharmacy_account_no }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Pharmacy's Address Line 1</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $pharmacy->pharmacy_address_1 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Pharmacy's Address Line 2</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $pharmacy->pharmacy_address_2 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Pharmacy's City</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $pharmacy->pharmacy_city }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Pharmacy's State</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $pharmacy->pharmacy_state }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Pharmacy's Zipcode</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $pharmacy->pharmacy_postcode }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Pharmacy's PIC</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $pharmacy->pharmacy_pic }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Pharmacy's PIC Contact</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $pharmacy->pharmacy_phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
