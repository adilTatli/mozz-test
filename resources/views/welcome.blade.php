<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mozz Test</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="hold-transition login-page">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<a class="nav-link" href="{{ route('logout') }}" role="button">
    <button type="button" class="btn btn-block bg-gradient-info">Logout</button>
</a>
</body>
</html>

