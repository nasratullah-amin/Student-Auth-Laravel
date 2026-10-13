

@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')

    <h1>Student Dashboard</h1>

    <p>Welcome! You have successfully signed in.</p>

    <hr>

    <h3>Student Information</h3>

    <p>
        <strong>Name:</strong>
        {{ auth()->user()->name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ auth()->user()->email }}
    </p>

    <p>
        Your account is active, and you can access this page
        while you are signed in.
    </p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit">Sign Out</button>
    </form>

@endsection
