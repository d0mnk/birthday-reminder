@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($contact->id > 0)
            <h1>Edit {{$contact->firstname}} {{ $contact->lastname }}</h1>
            <form method="POST" action="/contact/{{$contact->id}}">
                @method('PUT')
                @else
                    <h1>Create new Contact</h1>
                    <form method="POST" action="/contact">
                        @endif
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-sm-2 col-form-label">Firtstname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                       id="firstname"
                                       name="firstname"
                                       value="{{$contact->firstname}}">
                                @error('firstname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-2 col-form-label">Lastname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                       id="lastname"
                                       name="lastname"
                                       value="{{$contact->lastname}}">
                                @error('lastname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthday" class="col-sm-2 col-form-label">Birthday</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                       id="birthday"
                                       name="birthday"
                                    value="{{$contact->birthday}}">
                                @error('date')
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
