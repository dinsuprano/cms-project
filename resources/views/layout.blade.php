<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>{{'Jobes - Find Your Dream Job' }}</title>
  </head>

  <body class="bg-gray-100">
    <!-- TailwindCSS Test: This should be blue with white text -->
    <x-header />
  @if(request()->is('/'))
    <x-hero />
    <x-top-banner />
  @endif
    <main class="container mx-auto p-4 mt-4">{{ $slot }}</main>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>