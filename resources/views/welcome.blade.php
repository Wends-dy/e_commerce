<!DOCTYPE html>
<html lang="en">
<head>
   
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">   
        
        <div class="container">
            
                <!-- Left Side Of Navbar -->
            <a class="navbar-brand" href="{{ url('/') }}">
                logo
            </a>
                <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            </ul>
            
        </div>
    </nav>
</body>
</html>