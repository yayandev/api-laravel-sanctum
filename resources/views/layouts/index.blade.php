<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50">
    <nav class="w-full p-3 bg-white shadow flex items-center justify-around flex-wrap">
        <h1 class="text-3xl font-bold">API LARAVEL</h1>
        <div class="flex items-center gap-3">
            <a href="/" class="text-lg font-semibold">Home</a>
        </div>
    </nav>
    @yield('content')
</body>
</html>
