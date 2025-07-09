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
