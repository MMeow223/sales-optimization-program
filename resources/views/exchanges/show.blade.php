@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-8">
            <h3>Exchange Program Record Details</h3>
        </div>
        <div class="d-flex justify-content-end">
            <a href='{{ url("/exchanges/$exchangeRecord->id/edit") }}' class="btn btn-primary mx-2">Edit Exchange Program Detail</a>
            {!! Form::open(['route' => ['exchanges.destroy', $exchangeRecord->id], 'method' => 'POST']) !!}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete Exchange Program Detail', ['class' => 'btn btn-danger mx-2']) }}
            {!! Form::close() !!}
                <a href='{{ url("/exchanges/") }}' class="btn btn-secondary mx-2">Go Back</a>
        </div>

    </div>

    <!-- Device Details Content -->
    <div class="detailsBox p-2 mb-2">
        <div class="row">
            <div class="col-md-12">
                <h4>Device Details</h4>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Brand</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $otherDevice->device_brand }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Model</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $otherDevice->device_model }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Serial Number</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $exchangeRecord->other_device_serial_no }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-thumbnail" src="{{ url("/storage/serial_no_images/$exchangeRecord->other_device_serial_no_image") }}" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Exchanged Model</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $ourDevice->device_model }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Exchanged Serial Number</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $exchangeRecord->our_device_serial_no }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Details Content -->
    <div class="detailsBox p-2 mb-2">
        <div class="row">
            <div class="col-md-12">
                <h4>Patient Details</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's Name</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $patient->patient_name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's Date of Birth</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $patient->patient_dob }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's Phone Number</p>
                    </div>
                    <div class="col-md-8">
                        <p>: <a href="tel:{{ $patient->patient_phone }}">{{ $patient->patient_phone }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's Email</p>
                    </div>
                    <div class="col-md-8">
                        <a href="mailto:{{ $patient->patient_email }}">{{ $patient->patient_email }}</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's Address Line 1</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $patient->patient_address_1 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's Address Line 2</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $patient->patient_address_2 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's City</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $patient->patient_city }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's State</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $patient->patient_state }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's Zipcode</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $patient->patient_postcode }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's Diabetes Type</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $patient->patient_diabetes_type }}</p>
                    </div>
                </div>
            </div>
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
