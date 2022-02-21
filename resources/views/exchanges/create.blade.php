@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => 'exchanges.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="row mb-2">
        <div class="col-8 col-md-6">
            <h3>Add Exchange Program Record</h3>
        </div>
        <div class="d-flex justify-content-end">
            {{ Form::submit('ADD EXCHANGE PROGRAM RECORD', ['class' => 'btn btn-success mx-2']) }}
            <a href='{{ url("/exchanges/") }}' class="btn btn-secondary mx-2">Go Back</a>
        </div>


    </div>

    <script>

        $(document).ready(function(){
            $("#other-device-brand").click(function(){
                $.ajax({
                    type: "GET",
                    url: "/update-device-model-option/{devicebrand}",
                    data: {devicebrand : $( "#other-device-brand" ).val()},
                    success: function(data){
                        $('#other-device-model').html(data);
                    }
                })
            })
        })
    </script>

    <h1 id="ThisIsSoemthing" >Something</h1>

    <fieldset class="customFieldset p-2">
        <legend class="w-auto">Device Details</legend>
        <div class="row g-2 mb-2">

            <div class="col-6">
                <div class="form-floating">
                    {{Form::select('other_device_brand',$otherDeviceBrands,'',['class' => 'form-control', 'id' => 'other-device-brand'],)}}
                    {{ Form::label('other_device_brand', 'Brand*')}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">

                    {{Form::select('other_device_model',$otherDeviceModels,'',['class' => 'form-control', 'id' => 'other-device-model'])}}
                    {{ Form::label('other_device_model', 'Model*')}}

                </div>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-12 col-md-6">
                <div class="form-floating">
                    {{ Form::text('other_device_serial_no', '', ['class' => 'form-control', 'placeholder' => 'Serial Number*'])}}
                    {{ Form::label('other_device_serial_no', 'Serial Number*')}}
                </div>
            </div>
            <div class="col-12 col-md-6">
                {{ Form::label('other_device_serial_no_image', 'Serial Number Image') }}
                {{ Form::file('other_device_serial_no_image', ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-12 col-md-6">
                <div class="form-floating">

                    {{Form::select('our_device_model',$ourDeviceModels ,'',['class' => 'form-control'])}}
                    {{ Form::label('our_exchange_model', 'Exchanged Model*')}}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating">

                    {{ Form::text('our_device_serial_no','', ['class' => 'form-control', 'placeholder' => 'Exchanged Serial Number*'])}}
                    {{ Form::label('our_device_serial_no', 'Exchanged Serial Number*')}}
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="customFieldset p-2">
        <legend class="w-auto">Patient Details</legend>
        <div class="row g-2 mb-2">
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('patient_name', '', ['class' => 'form-control', 'placeholder' => "Patient's Name*"])}}
                    {{ Form::label('patient_name', "Patient's Name*")}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::date('patient_dob', \Carbon\Carbon::createFromDate(now()), ['class' => 'form-control']) }}
                    {{ Form::label('patient_dob', "Patient's Date of Birth*")}}
                </div>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('patient_phone', '', ['class' => 'form-control', 'placeholder' => "Patient's Phone Number*"])}}
                    {{ Form::label('patient_phone', "Patient's Phone Number*")}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('patient_email', '', ['class' => 'form-control', 'placeholder' => "Patient's Email*"])}}
                    {{ Form::label('patient_email', "Patient's Email*")}}
                </div>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('patient_address_1', '', ['class' => 'form-control', 'placeholder' => "Patient's Address Line 1*"])}}
                    {{ Form::label('patient_addr_1', "Patient's Address Line 1*")}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('patient_address_2', '', ['class' => 'form-control', 'placeholder' => "Patient's Address Line 2"])}}
                    {{ Form::label('patient_address_2', "Patient's Address Line 2")}}
                </div>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-6">
                <div class="form-floating">

                    {{ Form::text('patient_city', '', ['class' => 'form-control', 'placeholder' => "Patient's City*"])}}
                    {{ Form::label('patient_city', "Patient's City*")}}
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
                    {{ Form::text('patient_postcode', '', ['class' => 'form-control', 'placeholder' => "Patient's Zipcode*"])}}
                    {{ Form::label('patient_postcode', "Patient's Zipcode*")}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::select('patient_diabetes_type', [
                        'Type 1' => 'Type 1',
                        'Type 2' => 'Type 2',
                        'Gestational' => 'Gestational',
                        'Non-diabetic' => 'Non-diabetic'
                    ], 'Non-diabetic', ['class' => 'form-select']) }}
                    {{ Form::label('patient_diabetes_type', "Diabetes Type*")}}
                </div>
            </div>
        </div>
    </fieldset>


    <fieldset class="customFieldset p-2">
        <legend class="w-auto">Pharmacy Details</legend>
        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <div class="form-floating">
                    {{Form::select('pharmacy_account_no',$pharmacyArray,'',['class' => 'form-control'])}}
                    {{ Form::label('pharmacy_account_no', "Pharmacy's Name*")}}
                </div>
            </div>
        </div>
    </fieldset>


    {!! Form::close() !!}

@endsection
