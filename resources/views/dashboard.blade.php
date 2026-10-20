<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | IT Student Portal</title><style>
    * { box-sizing: border-box; }

    body {
        margin: 0;
        min-height: 100vh;
        font-family: Arial, Helvetica, sans-serif;
        background: #f3f5f9;
        color: #202938;
    }

    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 18px 7%;
        background: #fff;
        border-bottom: 1px solid #e5e9f0;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 17px;
        font-weight: 700;
    }

    .brand-icon {
        display: grid;
        place-items: center;
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: #e9efff;
        color: #3159c9;
        font-weight: bold;
    }

    .logout-button {
        padding: 10px 16px;
        border: 1px solid #d8dee8;
        border-radius: 8px;
        background: #fff;
        color: #344054;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
    }

    .logout-button:hover { background: #f3f5f9; }

    .container {
        width: min(100% - 40px, 900px);
        margin: 48px auto;
    }

    .welcome {
        margin-bottom: 30px;
    }

    .welcome-label {
        margin: 0 0 10px;
        color: #3159c9;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    h1 {
        margin: 0 0 12px;
        font-size: clamp(27px, 4vw, 36px);
        letter-spacing: -1px;
    }

    .welcome p:last-child {
        margin: 0;
        color: #697386;
        line-height: 1.7;
    }

    .section-title {
        margin: 0 0 16px;
        font-size: 18px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .info-card {
        padding: 25px;
        background: #fff;
        border: 1px solid #e5e9f0;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(31, 41, 55, .035);
    }

    .info-label {
        margin: 0 0 12px;
        color: #697386;
        font-size: 13px;
        font-weight: 600;
    }

    .info-value {
        margin: 0;
        font-size: 17px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .status {
        display: inline-block;
        margin-top: 14px;
        padding: 6px 10px;
        border-radius: 20px;
        background: #eaf8ef;
        color: #207443;
        font-size: 12px;
        font-weight: 600;
    }

    .footer {
        margin-top: 36px;
        padding-top: 20px;
        border-top: 1px solid #e0e5ed;
        color: #818a99;
        font-size: 13px;
        text-align: center;
    }

    @media (max-width: 600px) {
        .navbar { padding: 15px 20px; }
        .brand { font-size: 14px; }
        .brand-icon { width: 36px; height: 36px; }
        .container { margin: 32px auto; }
        .grid { grid-template-columns: 1fr; gap: 14px; }
        .info-card { padding: 21px; }
        .logout-button { padding: 9px 12px; }
    }
</style>

</head>
<body>
    <header class="navbar">
        <div class="brand">
            <span class="brand-icon">IT</span>
            <span>IT Student Portal</span>
        </div> <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-button" type="submit">Sign out</button>
    </form>
</header>

<main class="container">
    <section class="welcome">
        <p class="welcome-label">Student Dashboard</p>
        <h1>Welcome, {{ auth()->user()->name }}!</h1>
        <p>
            You are signed in. Here is your account information.
        </p>
    </section>

    <h2 class="section-title">Your account</h2>

    <section class="grid">
        <article class="info-card">
            <p class="info-label">Full name</p>
            <p class="info-value">{{ auth()->user()->name }}</p>
            <span class="status">Account active</span>
        </article>

        <article class="info-card">
            <p class="info-label">Email address</p>
            <p class="info-value">{{ auth()->user()->email }}</p>
            <span class="status">Signed in</span>
        </article>
    </section>

    <footer class="footer">
        IT Student Portal &mdash; Student Authentication Lab
    </footer>
</main>

</body>
</html>
