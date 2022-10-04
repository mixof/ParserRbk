<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>
<div class="container max-w-2xl mx-auto px-3">
    <header>
        <div class="pt-16 pb-2 my-3">
            <a href="/"><h1 class="text-4xl font-bold">RBC Scrapper</h1></a>
        </div>
    </header>
    <main>
        @yield('content')
    </main>

</div>
<footer class="w-full border-t border-red-500 p-6 text-center pin-b">
    <p>by Aleksey Ilyuchenko</p>
</footer>

</body>
</html>
