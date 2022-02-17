@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-8">
            <h3>Exchange Program Record Details</h3>
        </div>
        <div class="d-flex justify-content-end">
            <a href='{{ url("/devices/$device->id/edit") }}' class="btn btn-primary mx-2">Edit Device Detail</a>
            @if($device->is_active == 1)
                {!! Form::open(['route' => ['devices.deactivate', $device->id], 'method' => 'GET']) !!}
                    {{ Form::submit('Deactivate Device', ['class' => 'btn btn-danger mx-2']) }}
                {!! Form::close() !!}
            @else
                {!! Form::open(['route' => ['devices.activate', $device->id], 'method' => 'GET']) !!}
                    {{ Form::submit('Activate Device', ['class' => 'btn btn-success mx-2']) }}
                {!! Form::close() !!}
            @endif
                <a href='{{ url("/devices/") }}' class="btn btn-secondary mx-2">Go Back</a>
        </div>

    </div>

    <!-- Device Details Content -->
    <div class="detailsBox p-2 mb-2">
        <div class="row">
            <div class="col-md-12">
                <h4>Device Details</h4>
            </div>
        </div>
        <div class="col">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Brand</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $device->device_brand }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <p>Model</p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $device->device_model }}</p>
                    </div>
                </div>
            </div>
        </div>



@endsection
