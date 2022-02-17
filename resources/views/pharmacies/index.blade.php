@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6">
            <h3>Devices Supported in Exchange Program</h3>
        </div>
        <div class="col-md-6 text-end">
           <a href='{{ url("/pharmacies/create") }}' class="btn btn-success">Add New Pharmacy</a>
        </div>
    </div>

    <table class="table table-hover table-light">
        <thead>
            <tr>
                <th>#</th>
                <th>Pharmacy Name</th>
                <th>Account No</th>
                <th>Person-In-Charge</th>
                <th>Phone</th>
                <th>Is Activate</th>
            </tr>
        </thead>
        <tbody>
        @if (count($pharmacies) > 0)
            @foreach ($pharmacies as $pharmacy)
                <tr>
                    <td><a href="{{url("/pharmacies/$pharmacy->id")}}">{{$pharmacy->id}}</a></td>
                    <td>{{ $pharmacy->pharmacy_name }}</td>
                    <td>{{ $pharmacy->pharmacy_account_no }}</td>
                    <td>{{ $pharmacy->pharmacy_pic}}</td>
                    <td>{{ $pharmacy->pharmacy_phone}}</td>
                    <td class="{{ ($pharmacy->is_active) ? 'text-success' : 'text-danger'}}">{{ ($pharmacy->is_active) ? 'Active' : 'Inactive'}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <!-- Pagination will appear when there's more than 4 items -->
            <div class="d-flex justify-content-center">
                {!! $pharmacies->links() !!}
            </div>
        @else
            <tr>
                <td colspan="5">No records found</td>
            </tr>
        @endif

@endsection
