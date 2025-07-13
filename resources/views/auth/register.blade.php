<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTQ Al Yusra | Register</title>
    <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('img/image/rtq_bg.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: rgba(128, 128, 128, 0.4);
            backdrop-filter: blur(3px);
        }

        input::placeholder,
        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #999;
            opacity: 1;
        }

        .show-password {
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>

<body>
    <div class="lr-container">
        <div class="lr-box">
            <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ Al Yusra" class="logo">

            <form method="POST" action="{{ route('register') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert-box">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="text" name="name" placeholder="Enter your name" required>
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Confirm your password" required>

                <label class="show-password">
                    <input type="checkbox" onclick="togglePassword()"> Show Password
                </label>

                <button type="submit" class="lr-button">Register</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pass = document.getElementById("password");
            const confirm = document.getElementById("password_confirmation");

            const type = pass.type === "password" ? "text" : "password";
            pass.type = type;
            confirm.type = type;
        }
    </script>
</body>

</html>