@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Upcoming Birthdays 🎉</h1>
        @include('partials.alerts')
        @if($contacts->isNotEmpty())
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Birthday</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->firstname }}</td>
                        <td>{{ $contact->lastname }}</td>
                        <td>{{ \Carbon\Carbon::parse($contact->birthday)->format('m/d/Y') }}</td>
                        <td>
                            <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit fa-fw"></i>
                            </a>

                            <form action="{{ route('contact.destroy',$contact->id) }}" method="POST"
                                  class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-times fa-fw"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="text-muted my-2">
                You haven't added any birthdays yet.
            </div>
        @endif
        <a href="{{ route('contact.create') }}" class="btn btn-primary"><i class="fas fa-plus fa-fw"></i> Add</a>
    </div>
@endsection
