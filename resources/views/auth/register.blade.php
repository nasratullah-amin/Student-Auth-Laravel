
@extends('layouts.app')

@section('title', 'Create Account')

@section('content')

    <h1>Create Account</h1>

    <p>Register to access your student dashboard.</p>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <label for="name">Full Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            maxlength="255"
            autocomplete="name"
            required
        >

        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            maxlength="255"
            autocomplete="email"
            required
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            minlength="8"
            autocomplete="new-password"
            required
        >

        <label for="password_confirmation">Confirm Password</label>
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            minlength="8"
            autocomplete="new-password"
            required
        >

        <button type="submit">Create Account</button>
    </form>

    <p class="footer-text">
        Already have an account?
        <a href="{{ route('login') }}">Sign in</a>
    </p>

@endsection


