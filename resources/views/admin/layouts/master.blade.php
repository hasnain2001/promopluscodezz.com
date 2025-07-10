<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href=" {{ asset('assets/images/favicon.png') }}" />

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
    <!-- Required Styles -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      @yield('styles')
  </head>
  <body>
    <!-- Begin page -->
    <div id="wrapper">

        @include('admin.layouts.left-menu')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

            @include('employee.layouts.navigation')

            <!-- Page Content -->
            <main class=" text-capitalize">
            @yield('content')
            </main>

            </div>

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
        @yield('scripts')

        <!-- Scripts & Styles -->

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        $(document).ready(function () {
            const table = $('#basic-datatable').DataTable({
                responsive: true,
                ordering: false,
                paging: false, // disable paging for full drag functionality
                lengthChange: false,
                searching: true,
                info: false
            });

            // Make table body sortable
            $('#tablecontents').sortable({
                items: 'tr.row1',
                cursor: 'move',
                opacity: 0.8,
                handle: '.handle',
                helper: function(e, tr) {
                    var $originals = tr.children();
                    var $helper = tr.clone();
                    $helper.children().each(function(index) {
                        $(this).width($originals.eq(index).width());
                    });
                    return $helper;
                },
                start: function(e, ui){
                    ui.placeholder.height(ui.item.height());
                },
                update: function () {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {
                var order = [];
                var token = '{{ csrf_token() }}';

                $('#tablecontents tr').each(function (index, element) {
                    order.push({
                        id: $(this).data("id"),
                        position: index + 1
                    });
                });

                $.ajax({
                    url: "{{ route('admin.coupon.update-order') }}",
                    method: "POST",
                    data: {
                        order: order,
                        _token: token
                    },
                    success: function (response) {
                        if (response.status === "success") {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        toastr.error("Error while updating order.");
                        console.error(xhr.responseText);
                    }
                });
            }
        });

    </script>
        <script>
            $(document).ready(function() {
                $('#searchInput').autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '{{ route("admin.search") }}',
                            dataType: 'json',
                            data: { query: request.term
                            },
                            success: function(data) {
                                response(data.stores); // Ensure `data.stores` is an array of strings or objects
                            }
                        });
                    },
                    minLength: 1 // Minimum characters to trigger autocomplete
                });
            });
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
