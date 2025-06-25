@extends('layout')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <form class="card w-[300px] shadow" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="card-body">
                <div class="card-title">Login to foodpanda</div>
                <fieldset class="fieldset">
                    <label class="label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="Email" />
                    @error('email')
                        <span class="badge badge-soft badge-warning">{{ $message }}</span>
                    @enderror

                    <label class="label mt-2">Password</label>
                    <input type="password" name="password" class="input" placeholder="Password" />
                    @error('password')
                        <span class="badge badge-soft badge-warning">{{ $message }}</span>
                    @enderror

                    @if(session('error'))
                        <span class="badge badge-soft badge-warning mt-2">{{ session('error') }}</span>
                    @endif
                    <p>Don't have account <a href="{{ route('register') }}" class="link link-hover">Register</a> now.</p>
                    <button type="submit" class="btn btn-neutral mt-4 w-full">Login</button>
                </fieldset>
            </div>
        </form>
    </div>
@endsection
