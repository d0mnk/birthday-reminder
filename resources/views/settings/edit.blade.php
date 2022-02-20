@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Settings</h1>
    @include('partials.alerts')
    <form method="POST" action="{{route("settings-update")}}">
        @method('PATCH')
        @csrf
        <div class="form-group row">
            <label for="pushover_key" class="col-sm-2 col-form-label">Pushover Device Key</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('pushover_key') is-invalid @enderror"
                       id="pushover_key" name="pushover_key" value="{{ auth()->user()->pushover_key }}">
                @error('pushover_key')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <hr/>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ @route('contact.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
