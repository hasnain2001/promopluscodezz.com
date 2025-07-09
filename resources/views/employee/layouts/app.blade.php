
<!DOCTYPE html>
<html lang="en" data-layout-mode="detached">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- App favicon -->
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

   <!-- Plugins css -->
   <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css')  }}" rel="stylesheet" type="text/css" />

   <!-- Theme Config Js -->
   <script src="{{ asset('assets/js/head.js') }}"></script>

   <!-- Bootstrap css -->
   <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

   <!-- App css -->
   <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

   <!-- Icons css -->
   <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css -->
    <link rel="stylesheet" href="{{ asset('css/employee.css') }}">

       <!-- livewireStyles -->
       @livewireStyles


   @yield('styles')

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

        @include('employee.layouts.left-menu')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

             @include('employee.layouts.navigation')

            <!-- Page Content -->
            <main>
               @yield('content')
            </main>
        <!-- END wrapper -->
            @include('employee.layouts.footer')
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>


        @livewireScripts
        @yield('scripts')

        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
        <script src="{{ asset('assets/js/ck-editor.js') }}"></script>
        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        <!-- Plugins js-->
        <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Dashboar 1 init js-->
        <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>

    </body>
</html>
