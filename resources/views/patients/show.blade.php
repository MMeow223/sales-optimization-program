@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-8">
            <h3>Patient Details</h3>
        </div>
        <div class="d-flex justify-content-end">
            <a href='{{ url("/patients/$patient->id/edit") }}' class="btn btn-primary mx-2">Edit Patient Details</a>
                <a href='{{ url("/patients/") }}' class="btn btn-secondary mx-2">Go Back</a>
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
                        <p>: {{ $patient->patient_phone }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Patient's Email</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $patient->patient_email }}</p>
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



@endsection
