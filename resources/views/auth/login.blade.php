

@extends('layouts.app')

@section('title', 'Sign In')

@section('content')

    <h1>Student Login</h1>

    <p>Enter your email and password to continue.</p>

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            autocomplete="username"
            required
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            autocomplete="current-password"
            required
        >

        <button type="submit">Sign In</button>
    </form>

    <p class="footer-text">
        Don't have an account?
        <a href="{{ route('register') }}">Create an account</a>
    </p>

@endsection

