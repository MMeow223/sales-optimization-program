@if (count($errors) > 0)
    <div class="row">
        @foreach ($errors->all() as $error)
            <div class="col-6">
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            </div>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif