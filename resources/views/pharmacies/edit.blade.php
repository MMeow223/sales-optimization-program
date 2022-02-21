@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['pharmacies.update', $pharmacy->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="row mb-2">
        <div class="col-md-8">
            <h3>Edit Pharmacy Details</h3>
        </div>

        <div class="d-flex justify-content-end">
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::submit('UPDATE PHARMACY DETAILS', ['class' => 'btn btn-primary mx-2']) }}
            <a href='{{ url("/pharmacies/".$pharmacy->id) }}' class="btn btn-secondary mx-2">Go Back</a>
        </div>

    </div>

    <fieldset class="customFieldset p-2">
        <legend class="w-auto">Pharmacy Details</legend>
        <div class="row g-2 mb-2">
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('pharmacy_name', $pharmacy->pharmacy_name, ['class' => 'form-control', 'placeholder' => "Outlet Name*"])}}
                    {{ Form::label('pharmacy_name', "Outlet Name*")}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('pharmacy_account_no', $pharmacy->pharmacy_account_no, ['class' => 'form-control', 'placeholder' => "Account Number*"])}}
                    {{ Form::label('pharmacy_account_no', "Account Number*")}}
                </div>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('pharmacy_address_1', $pharmacy->pharmacy_address_1, ['class' => 'form-control', 'placeholder' => "Address Line 1*"])}}
                    {{ Form::label('pharmacy_address_1', "Address Line 1*")}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('pharmacy_address_2', $pharmacy->pharmacy_address_2, ['class' => 'form-control', 'placeholder' => "Address Line 2"])}}
                    {{ Form::label('pharmacy_address_2', "Address Line 2")}}
                </div>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('pharmacy_city', $pharmacy->pharmacy_city, ['class' => 'form-control', 'placeholder' => "City*"])}}
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
                    ], $pharmacy->pharmacy_state, ['class' => 'form-select']) }}
                    {{ Form::label('pharmacy_state', "State*")}}
                </div>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-12">
                <div class="form-floating">
                    {{ Form::text('pharmacy_postcode', $pharmacy->pharmacy_postcode, ['class' => 'form-control', 'placeholder' => "Zipcode*"])}}
                    {{ Form::label('pharmacy_postcode', "Zipcode*")}}
                </div>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('pharmacy_pic', $pharmacy->pharmacy_pic, ['class' => 'form-control', 'placeholder' => "PIC*"])}}
                    {{ Form::label('pharmacy_pic', "PIC*")}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    {{ Form::text('pharmacy_phone', $pharmacy->pharmacy_phone, ['class' => 'form-control', 'placeholder' => "PIC Contact*"])}}
                    {{ Form::label('pharmacy_phone', "PIC Contact*")}}
                </div>
            </div>
        </div>
    </fieldset>



    {!! Form::close() !!}

@endsection
