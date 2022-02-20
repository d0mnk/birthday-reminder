@if(session()->has('message'))
    <div class="alert alert-{{ session('type') ?? 'info' }}">
        {{ session('message') }}
    </div>
@endif

@if (session('verified'))
    <div class="alert alert-success" role="alert">
        {{ __('Your account has been verified.') }}
    </div>
@endif
