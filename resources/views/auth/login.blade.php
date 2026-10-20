


<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | IT Student Portal</title><style>
    * { box-sizing: border-box; }

    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        font-family: Arial, Helvetica, sans-serif;
        background: #f3f5f9;
        color: #202938;
    }

    .card {
        width: 100%;
        max-width: 420px;
        padding: 36px;
        background: #fff;
        border: 1px solid #e5e9f0;
        border-radius: 16px;
        box-shadow: 0 12px 40px rgba(31, 41, 55, 0.07);
    }

    .brand {
        width: 48px;
        height: 48px;
        display: grid;
        place-items: center;
        margin-bottom: 24px;
        border-radius: 13px;
        background: #e9efff;
        color: #3159c9;
        font-size: 23px;
        font-weight: bold;
    }

    h1 {
        margin: 0 0 9px;
        font-size: 27px;
        letter-spacing: -0.7px;
    }

    .subtitle {
        margin: 0 0 27px;
        color: #697386;
        font-size: 14px;
        line-height: 1.6;
    }

    .field { margin-bottom: 20px; }

    label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
    }

    input {
        width: 100%;
        padding: 13px;
        border: 1px solid #d8dee8;
        border-radius: 8px;
        outline: none;
        font-size: 14px;
        transition: border-color .2s, box-shadow .2s;
    }

    input:focus {
        border-color: #4169e1;
        box-shadow: 0 0 0 3px rgba(65, 105, 225, .12);
    }

    button {
        width: 100%;
        margin-top: 5px;
        padding: 13px;
        border: 0;
        border-radius: 8px;
        background: #3159c9;
        color: white;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
    }

    button:hover { background: #2448ad; }

    .message {
        margin-bottom: 18px;
        padding: 12px;
        border-radius: 8px;
        font-size: 14px;
    }

    .success {
        background: #eaf8ef;
        color: #207443;
    }

    .errors {
        background: #fff0f0;
        color: #b42318;
        font-size: 13px;
        line-height: 1.7;
    }

    .footer {
        margin: 24px 0 0;
        text-align: center;
        color: #697386;
        font-size: 14px;
    }

    a {
        color: #3159c9;
        font-weight: 600;
        text-decoration: none;
    }

    a:hover { text-decoration: underline; }

    @media (max-width: 480px) {
        body { padding: 16px; }
        .card { padding: 28px 22px; }
        h1 { font-size: 24px; }
    }
</style>

</head>
<body>
    <main class="card">
        <div class="brand">IT</div> <h1>Welcome back</h1>
    <p class="subtitle">
        Sign in to continue to your IT Student Portal.
    </p>

    @if (session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="message errors">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="field">
            <label for="email">Email address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="you@example.com"
                autocomplete="email"
                required
            >
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
            >
        </div>

        <button type="submit">Sign in</button>
    </form>

    <p class="footer">
        Don't have an account?
        <a href="{{ route('register') }}">Create an account</a>
    </p>
</main>

</body>
</html>


