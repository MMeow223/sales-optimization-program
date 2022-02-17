@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6">
            <h3>Patients List</h3>
        </div>
    </div>

    <table class="table table-hover table-light">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Email</th>
{{--                <th>Address 1</th>--}}
{{--                <th>Address 2</th>--}}
{{--                <th>City</th>--}}
{{--                <th>State</th>--}}
                <th>Postcode</th>
                <th>Phone</th>
                <th>Diabetes Type</th>
                <th>Created At</th>
{{--                <th>Updated At</th>--}}
            </tr>
        </thead>
        <tbody>
        @if (count($patients) > 0)
            @foreach ($patients as $patient)
                <tr>
                    <td><a href="{{url("/patients/$patient->id")}}">{{$patient->id}}</a></td>
                    <td>{{ $patient->patient_name}}</td>
                    <td>{{ $patient->patient_dob }}</td>
                    <td><a href="mailto:{{ $patient->patient_email}}">{{ $patient->patient_email}}</a></td>
{{--                    <td>{{ $patient->patient_address_1 }}</td>--}}
{{--                    <td>{{ $patient->patient_address_2}}</td>--}}
{{--                    <td>{{ $patient->patient_city}}</td>--}}
{{--                    <td>{{ $patient->patient_state}}</td>--}}
                    <td>{{ $patient->patient_postcode}}</td>
                    <td><a href="tel:{{$patient->patient_phone}}">{{ $patient->patient_phone}}</a></td>
                    <td>{{ $patient->patient_diabetes_type}}</td>
                    <td>{{ $patient->created_at}}</td>
{{--                    <td>{{ $patient->updated_at}}</td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
            <!-- Pagination will appear when there's more than 4 items -->
            <div class="d-flex justify-content-center">
                {!! $patients->links() !!}
            </div>
        @else
            <tr>
                <td colspan="5">No records found</td>
            </tr>
        @endif

@endsection
