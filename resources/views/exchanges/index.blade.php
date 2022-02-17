@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6">
            <h3>Control Exchange Program List</h3>
        </div>
        <div class="col-md-6 text-end">
           <a href='{{ url("/exchanges/create") }}' class="btn btn-success">Add Exchange Program Record</a>
        </div>
    </div>

    <table class="table table-hover table-light">
        <thead>
            <tr>
                <th>#</th>
                <th>Others Brand</th>
                <th>Others Model</th>
                <th>Others Serial Number</th>
                <th>Ours Model</th>
                <th>Ours Serial Number</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
        @if (count($exchanges) > 0)
            @foreach ($exchanges as $exchange)
                <tr>
                    <td><a href="{{url("/exchanges/$exchange->id")}}">{{$exchange->id}}</a></td>
                    <td>{{ $devices->find($exchange->other_device_id)->device_brand }}</td>
                    <td>{{ $devices->find($exchange->other_device_id)->device_model }}</td>
                    <td>{{ $exchange->other_device_serial_no}}</td>
                    <td>{{ $devices->find($exchange->our_device_id)->device_model }}</td>
                    <td>{{ $exchange->our_device_serial_no}}</td>
                    <td>{{ $exchange->created_at}}</td>
                    <td>{{ $exchange->updated_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <!-- Pagination will appear when there's more than 4 items -->
            <div class="d-flex justify-content-center">
                {!! $exchanges->links() !!}
            </div>
        @else
            <tr>
                <td colspan="5">No records found</td>
            </tr>
        @endif

@endsection
