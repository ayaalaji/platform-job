<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Platform Admin Reset Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif; 
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        } 

        .container {
            display: flex;
            width: 100%;
            height: 100%;
            border-radius: 0;
            overflow: hidden;
            position: relative;
        }

        .container::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: linear-gradient(135deg, #ff7e5f 50%, transparent 50%);
            z-index: 1;
            transform: rotate(-45deg);
            transform-origin: top left;
        }

        .left {
            flex: 1;
           background-image: url("{{ asset('images/photo_2024-06-15_15-36-51.jpg') }}");
            background-size: cover;
            z-index: 2;
        }

        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
            background: #fff;
        }

        .reset-container {
            padding: 30px 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            z-index: 3;
        }

        .reset-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .reset-container input[type="email"], 
        .reset-container input[type="password"], 
        .reset-container input[type="hidden"], 
        .reset-container input[type="password-confirm"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .reset-container button {
            width: 100%;
            padding: 12px;
            background-color: #89CFF0;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .reset-container button:hover {
            background-color: lightblue;
        }

        .reset-container .form-footer {
            margin-top: 20px;
        }

        .reset-container .form-footer a {
            color: #ff7e5f;
            text-decoration: none;
        } 
    </style>
</head>
<body>
    <div class="container">
        <div class="left"></div>
        <div class="right">
            <div class="reset-container">
                <h2>Job Platform Reset Password For Admin Login</h2>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <input id="email" type="email" name="email" placeholder="{{ __('Email Address') }}" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus class="@error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password" type="password" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password" class="@error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password" class="form-control">

                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
