@extends('layout.style')
@section('title', 'Log In')

<body>
<div class="container login-container">
    <div class="col-lg-6 col-md-6 col-12 login-left">
        <img src="../assets/image/logo.png" class="login-logo mb-3" alt="Logo">
        <div class="login-title">Starbuck Coffee</div>
    </div>
    <div class="col-lg-6 col-md-6 col-12 login-right">
        <h2>Log in</h2>
        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <!-- Username -->
            <div class="mb-3 text-start">
                <label class="form-label" for="username">Name</label>
                <input type="text" class="form-control" id="username" name="user_name" placeholder="Username" value="{{ old('user_name') }}" autocomplete="username">
                @error('user_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3 text-start">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="*********" autocomplete="current-password">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="login-btn">Log in</button>

        </form>
    </div>
</div>
</body>
</html>
