<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Student Authentication')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 40px 15px;
            color: #333;
        }

        .container {
            max-width: 440px;
            margin: 0 auto;
            background-color: #fff;
            padding: 28px;
            border-radius: 8px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 27px;
        }

        p {
            line-height: 1.6;
        }

        label {
            display: block;
            margin-top: 16px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #1769aa;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #1769aa;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #12548a;
        }

        a {
            color: #1769aa;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .success {
            padding: 12px;
            background-color: #e7f6e9;
            color: #216b32;
            border-radius: 5px;
        }

        .errors {
            padding: 12px 12px 12px 30px;
            background-color: #fdeaea;
            color: #a12626;
            border-radius: 5px;
        }

        .footer-text {
            margin-top: 20px;
            text-align: center;
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 12px;
            }

            .container {
                padding: 22px;
            }
        }
    </style>
</head>

<body>
    <main class="container">

        @if (session('success'))
            <p class="success">
                {{ session('success') }}
            </p>
        @endif

        @if ($errors->any())
            <ul class="errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @yield('content')

    </main>
</body>
</html>

