<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
       <!-- App favicon -->
   <link rel="shortcut icon" href=" {{ asset('assets/images/favicon.png') }}" />
    <!-- Theme Config Js -->
		<script src="{{ asset('assets/js/head.js') }}"></script>

		<!-- Bootstrap css -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

		<!-- App css -->
		<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

		<!-- Icons css -->
		<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
       <!-- third party css -->
       <link href="{{ asset("assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css") }}" rel="stylesheet" type="text/css" />
       <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
       <link href="{{ asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
       <link href="{{ asset('assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
@yield('styles')
          <!-- livewireStyles -->
       @livewireStyles
</head>
<body>
 <main>
  <!-- Begin page -->
  <div id="wrapper">

    @include('admin.layouts.left-menu')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">

         @include('admin.layouts.navigation')

        <!-- Page Content -->
        <main class=" text-capitalize">
           @yield('content')
        </main>

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->
 </main>
   <!-- livewirescript -->
   @livewireScripts
   @yield('scripts')
  <!-- Vendor js -->
  <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

  <!-- App js -->
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- third party js ends -->
       <!-- Loading buttons js -->
       <script src="{{ asset('assets/libs/dragula/dragula.min.js') }}"></script>

       <!-- Buttons init js-->
       <script src="{{ asset('assets/js/pages/dragula.init.js') }}"></script>
    <!-- Datatables init -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
</body>
</html>
