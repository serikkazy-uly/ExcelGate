
@extends('layouts.app')

@section('content')
    <div>
        <h1>Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
@endsection
