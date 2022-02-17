@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => 'devices.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="row mb-2">
        <div class="col-8 col-md-6">
            <h3>Add New Devices</h3>
        </div>
        <div class="d-flex justify-content-end">
            {{ Form::submit('ADD NEW DEVICE', ['class' => 'btn btn-success mx-2']) }}
            <a href='{{ url("/devices/") }}' class="btn btn-secondary mx-2">Go Back</a>
        </div>
    </div>

    <fieldset class="customFieldset p-2">
        <legend class="w-auto">Device Details</legend>

        <div class="col g-2 mb-2 text-center">
            <div class="col-12 col-md-6 mb-2 justify-content-center">
                <div class="form-floating">
                    {{ Form::text('device_brand','', ['class' => 'form-control', 'placeholder' => 'Device Brand*'])}}
                    {{ Form::label('device_brand', 'Device Brand*')}}
                </div>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <div class="form-floating">

                    {{ Form::text('device_model','', ['class' => 'form-control', 'placeholder' => 'Device Model*'])}}
                    {{ Form::label('device_model', 'Device Model*')}}
                </div>
            </div>
        </div>

    </fieldset>

    {!! Form::close() !!}

@endsection
