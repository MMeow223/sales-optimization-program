@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6">
            <h3>Devices Supported in Exchange Program</h3>
        </div>
        <div class="col-md-6 text-end">
           <a href='{{ url("/devices/create") }}' class="btn btn-success">Add New Device</a>
        </div>
    </div>

    <table class="table table-hover table-light">
        <thead>
            <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Created At</th>
{{--                <th>Updated At</th>--}}
                <th>Is Activate</th>
            </tr>
        </thead>
        <tbody>
        @if (count($devices) > 0)
            @foreach ($devices as $device)
                <tr>
                    <td><a href="{{url("/devices/$device->id")}}">{{$device->id}}</a></td>
                    <td>{{ $device->device_brand }}</td>
                    <td>{{ $device->device_model }}</td>
                    <td>{{ $device->created_at}}</td>
{{--                    <td>{{ $device->updated_at}}</td>--}}
                    <td class="{{ ($device->is_active) ? 'text-success' : 'text-danger'}}">{{ ($device->is_active) ? 'Active' : 'Inactive'}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <!-- Pagination will appear when there's more than 4 items -->
            <div class="d-flex justify-content-center">
                {!! $devices->links() !!}
            </div>
        @else
            <tr>
                <td colspan="5">No records found</td>
            </tr>
        @endif

@endsection
