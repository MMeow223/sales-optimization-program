@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => 'exchanges.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="row mb-2">
        @if (!Auth::guest())
            <div class="col-8 col-md-6">
                <h3>Add Exchange Program Record</h3>
            </div>
            <div class="d-flex justify-content-end">
                {{ Form::submit('ADD EXCHANGE PROGRAM RECORD', ['class' => 'btn btn-success mx-2']) }}
                <a href='{{ url("/exchanges/") }}' class="btn btn-secondary mx-2">Go Back</a>
            </div>
        @else
            <div class="col-12 col-md-12 text-center">
                <h3>Add Exchange Program Record</h3>
            </div>
        @endif

    </div>



        <fieldset class="customFieldset p-2">
            <legend class="w-auto">Device Details</legend>



            <div class="row g-2 mb-2">

                <div class="col-6">
                    <div class="form-floating">
{{--                        {{ Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Brand*'])}}--}}
                        {{Form::select('brand',array(
                            'Brand1' => 'Brand1',
                            'Brand2' => 'Brand2',
                            'Brand3' => 'Brand3',
                        ),'',['class' => 'form-control', 'placeholder' => 'Old Device Brand Name*'])}}
                        {{ Form::label('brand', 'Brand*')}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
{{--                        {{ Form::text('model', '', ['class' => 'form-control', 'placeholder' => 'Model*'])}}--}}
                        {{Form::select('model',array(
                            'Model1' => 'Model1',
                            'Model2' => 'Model2',
                            'Model3' => 'Model3',
                        ),'',['class' => 'form-control', 'placeholder' => 'Old Device Model Name*'])}}
                        {{ Form::label('model', 'Model*')}}

                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        {{ Form::text('serial_no', '', ['class' => 'form-control', 'placeholder' => 'Serial No*'])}}
                        {{ Form::label('serial_no', 'Serial No*')}}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    {{ Form::label('serial_no_image', 'Serial Number Image') }}
                    {{ Form::file('serial_no_image', ['class' => 'form-control'], ['accept' => 'image/png', 'image/gif', 'image/jpeg']) }}
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-12 col-md-6">
                    <div class="form-floating">
{{--                        {{ Form::text('exchange_model', '', ['class' => 'form-control', 'placeholder' => 'Exchanged Model*'])}}--}}
                        {{Form::select('exchange_model',array(
                            'Model1' => 'Model1',
                            'Model2' => 'Model2',
                            'Model3' => 'Model3',
                        ),'',['class' => 'form-control', 'placeholder' => 'New Device Model Name*'])}}
                        {{ Form::label('exchange_model', 'Exchanged Model*')}}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        {{ Form::text('exchange_serial_no', '', ['class' => 'form-control', 'placeholder' => 'Exchanged Serial No*'])}}
                        {{ Form::label('exchange_serial_no', 'Exchanged Serial No*')}}
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="customFieldset p-2">
            <legend class="w-auto">Patient Details</legend>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('patient_name', '', ['class' => 'form-control', 'placeholder' => "Name*"])}}
                        {{ Form::label('patient_name', "Name*")}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::date('patient_dob', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
                        {{ Form::label('patient_dob', "Date of Birth*")}}
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('patient_phone_no', '', ['class' => 'form-control', 'placeholder' => "Phone No*"])}}
                        {{ Form::label('patient_phone_no', "Phone No*")}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('patient_email', '', ['class' => 'form-control', 'placeholder' => "Email Address*"])}}
                        {{ Form::label('patient_email', "Email Address*")}}
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('patient_addr_1', '', ['class' => 'form-control', 'placeholder' => "Address Line 1*"])}}
                        {{ Form::label('patient_addr_1', "Address Line 1*")}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('patient_addr_2', '', ['class' => 'form-control', 'placeholder' => "Address Line 2"])}}
                        {{ Form::label('patient_addr_2', "Address Line 2")}}
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('patient_city', '', ['class' => 'form-control', 'placeholder' => "City*"])}}
                        {{ Form::label('patient_city', "City*")}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::select('patient_state', [
                            'Johor' => 'Johor',
                            'Kedah' => 'Kedah',
                            'Kelantan' => 'Kelantan',
                            'Malacca' => 'Malacca',
                            'Negeri Sembilan' => 'Negeri Sembilan',
                            'Pahang' => 'Pahang',
                            'Penang' => 'Penang',
                            'Perak' => 'Perak',
                            'Perlis' => 'Perlis',
                            'Sabah' => 'Sabah',
                            'Sarawak' => 'Sarawak',
                            'Selangor' => 'Selangor',
                            'Terengganu' => 'Terengganu'
                        ], 'Sarawak', ['class' => 'form-select']) }}
                        {{ Form::label('patient_state', "State*")}}
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('patient_zipcode', '', ['class' => 'form-control', 'placeholder' => "Zipcode*"])}}
                        {{ Form::label('patient_zipcode', "Zipcode*")}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::select('patient_diabetes', [
                            'Type 1' => 'Type 1',
                            'Type 2' => 'Type 2',
                            'Gestational' => 'Gestational',
                            'Non-diabetic' => 'Non-diabetic'
                        ], 'Non-diabetic', ['class' => 'form-select']) }}
                        {{ Form::label('patient_diabetes', "Diabetes Type*")}}
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="customFieldset p-2">
            <legend class="w-auto">Pharmacy Details</legend>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('pharmacy_name', '', ['class' => 'form-control', 'placeholder' => "Outlet Name*"])}}
                        {{ Form::label('pharmacy_name', "Outlet Name*")}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('pharmacy_account_no', '', ['class' => 'form-control', 'placeholder' => "Account Number*"])}}
                        {{ Form::label('pharmacy_account_no', "Account Number*")}}
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('pharmacy_addr_1', '', ['class' => 'form-control', 'placeholder' => "Address Line 1*"])}}
                        {{ Form::label('pharmacy_addr_1', "Address Line 1*")}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('pharmacy_addr_2', '', ['class' => 'form-control', 'placeholder' => "Address Line 2"])}}
                        {{ Form::label('pharmacy_addr_2', "Address Line 2")}}
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('pharmacy_city', '', ['class' => 'form-control', 'placeholder' => "City*"])}}
                        {{ Form::label('pharmacy_city', "City*")}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::select('pharmacy_state', [
                            'Johor' => 'Johor',
                            'Kedah' => 'Kedah',
                            'Kelantan' => 'Kelantan',
                            'Malacca' => 'Malacca',
                            'Negeri Sembilan' => 'Negeri Sembilan',
                            'Pahang' => 'Pahang',
                            'Penang' => 'Penang',
                            'Perak' => 'Perak',
                            'Perlis' => 'Perlis',
                            'Sabah' => 'Sabah',
                            'Sarawak' => 'Sarawak',
                            'Selangor' => 'Selangor',
                            'Terengganu' => 'Terengganu'
                        ], 'Sarawak', ['class' => 'form-select']) }}
                        {{ Form::label('pharmacy_state', "State*")}}
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-12">
                    <div class="form-floating">
                        {{ Form::text('pharmacy_zipcode', '', ['class' => 'form-control', 'placeholder' => "Zipcode*"])}}
                        {{ Form::label('pharmacy_zipcode', "Zipcode*")}}
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('pharmacy_pic', '', ['class' => 'form-control', 'placeholder' => "PIC*"])}}
                        {{ Form::label('pharmacy_pic', "PIC*")}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        {{ Form::text('pharmacy_contact', '', ['class' => 'form-control', 'placeholder' => "PIC Contact*"])}}
                        {{ Form::label('pharmacy_contact', "PIC Contact*")}}
                    </div>
                </div>
            </div>
        </fieldset>


    {!! Form::close() !!}

@endsection
