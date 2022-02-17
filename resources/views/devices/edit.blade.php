@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['devices.update', $device->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="row mb-2">
        <div class="col-md-8">
            <h3>Edit Devices Details</h3>
        </div>

        <div class="d-flex justify-content-end">
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::submit('UPDATE DEVICE DETAILS', ['class' => 'btn btn-primary mx-2']) }}
            <a href='{{ url("/devices/".$device->id) }}' class="btn btn-secondary mx-2">Go Back</a>
        </div>

    </div>
        <fieldset class="customFieldset p-2">
            <legend class="w-auto">Device Details</legend>
            <div class="col g-2 mb-2">
                <div class="col-md-6 mb-2">
                    <div class="form-floating">
                        {{Form::text('device_brand',$device->device_brand,['class' => 'form-control'])}}
                        {{ Form::label('device_brand', 'Device Brand*')}}
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-floating">
                        {{Form::text('device_model',$device->device_model,['class' => 'form-control'])}}
                        {{ Form::label('device_model', 'Device Model*')}}
                    </div>
                </div>
            </div>
        </fieldset>


        {!! Form::close() !!}

@endsection
