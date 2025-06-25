@extends('layout')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <form class="card w-[300px] shadow" method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="card-body">
                <div class="card-title">Register to foodpanda</div>
                <fieldset class="fieldset">
                    <label class="label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input" placeholder="Name" />
                    @error('name')
                        <span class="badge badge-soft badge-warning">{{ $message }}</span>
                    @enderror

                    <label class="label mt-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="Email" />
                    @error('email')
                        <span class="badge badge-soft badge-warning">{{ $message }}</span>
                    @enderror

                    <label class="label mt-2">Password</label>
                    <input type="password" name="password" class="input" placeholder="Password" />
                    @error('password')
                        <span class="badge badge-soft badge-warning">{{ $message }}</span>
                    @enderror

                    <label class="label mt-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="input" placeholder="Confirm Password" />
                    <p>Have an account <a href="{{ route('home') }}" class="link link-hover">Login</a> now.</p>
                    <button type="submit" class="btn btn-neutral mt-4 w-full">Register</button>
                </fieldset>
            </div>
        </form>
    </div>
@endsection
