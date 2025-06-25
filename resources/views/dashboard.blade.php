@extends('layout')
@section('content')
    <div class="min-h-screen flex flex-col gap-10 items-center">
        <div class="navbar bg-base-100 shadow-sm">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl">Dashboard</a>
            </div>
            <div class="flex-none">
                <form action="{{ route('logout') }}" method="post">@csrf <button class="btn btn-error">Logout</button></form>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="text-2xl">Welcome , {{ Auth::user()->name }}</div>
                <span class="text-sm">{{ Auth::user()->email }}</span>
            </div>
        </div>
    </div>
@endsection
