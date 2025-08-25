<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ $title ?? 'E-Commerce Website' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

<script src="https://unpkg.com/preline/dist/preline.js"></script>

<!-- In your layout's <head> section, after Tailwind CSS -->
<script src="https://cdn.jsdelivr.net/npm/preline@2.0.3/dist/preline.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/preline/1.9.0/preline.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
      <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
   
</head>
<body >
    @livewire('partials.navbar')
    <main>
        {{ $slot }}
    
    </main>

    @livewire('partials.footer')
    @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/preline/dist/preline.js"></script>
</body>
</html>
