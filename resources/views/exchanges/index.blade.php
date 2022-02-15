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

    @if (count($exchanges) > 0)
        @foreach ($exchanges as $exchange)
            <a href='{{ url("/exchanges/$exchange->id") }}' class="linkCard">
                <div class="card p-3 mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Brand: {{ $exchange->brand }}</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <small>Created at: {{ $exchange->created_at }}</small>
                            <br>
                            <small>Updated at: {{ $exchange->updated_at }}</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Model</p>
                                </div>
                                <div class="col-md-8">
                                    <p>: {{ $exchange->model }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Serial Number</p>
                                </div>
                                <div class="col-md-8">
                                    <p>: {{ $exchange->serial_no }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Exchanged Model</p>
                                </div>
                                <div class="col-md-8">
                                    <p>: {{ $exchange->exchange_model }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Exchanged Serial Number</p>
                                </div>
                                <div class="col-md-8">
                                    <p>: {{ $exchange->exchange_serial_no }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </a>
        @endforeach

        <!-- Pagination will appear when there's more than 4 items -->
        <div class="d-flex justify-content-center">
            {!! $exchanges->links() !!}
        </div>

    @else
        <p>No exchanges found.</p>
    @endif
@endsection
