<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout-mode="detached">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} @yield('title', 'Default Title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Default description')">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords', 'default, keywords')">
    <meta name="author" content="@yield('author', 'default, author')">
    <meta name="publisher" content="OBM TECH">
    <meta name="language" content="{{ app()->getLocale() }}">
    <meta name="copyright" content="OBM TECH">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta property="og:image:alt" content="@yield('title')">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
       <!-- bootstrap Assets -->
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">


    @stack('styles')
  @livewireStyles
    @vite(['resources/js/app.js'])
</head>

<body class="bg-light">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            @include('components.nav')

            <!-- Page Content -->
            <main class="py-4 text-capitalize">
                @yield('main')
            </main>

            @include('components.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- Scripts -->

   @stack('scripts')
    @livewireScripts
    <!-- JavaScript Libraries -->
   <script src="{{ asset('assets/js/navbar.js') }}"></script>

</body>
</html>
