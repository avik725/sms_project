<!doctype html>
<html lang="en">

<head>
    @include('Admin/common/header-link')

</head>

<body>
    <section id="sales-page">
        <!-- Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">

            @include('Admin/common/sidebar')

            <!-- Main wrapper -->
            <div class="body-wrapper">
                <!-- Header Start -->
                @include('Admin/common/header')
                <!-- Header End -->

                <div class="container-fluid">
                    <div class="card mt-4">
                        <div class="card-body">

                            <!-- Button to trigger Fancybox -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-title fw-semibold mb-4">Batches</h5>
                                </div>
                            </div>

                            <!-- Data Table for Suppliers -->
                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-striped table-bordered yajra-datatables text-center align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th>Batch Id</th>
                                            <th>Item</th>
                                            <th>Supplier</th>
                                            <th>Quantity</th>
                                            <th>Expiry Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('Admin/common/footer-link')

    <!-- DataTable Initialization -->
    <script>
        $(function () {
            var table = $('.yajra-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('admin/batch')}}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'batch_id',
                    name: 'batch_id',
                },
                {
                    data: 'item',
                    name: 'item',
                },
                {
                    data: 'supplier',
                    name: 'supplier',
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                },
                {
                    data: 'expiry_date',
                    name: 'expiry_date',
                },
                {
                    data: 'status',
                    name: 'status',
                }
                ]
            })
        });
    </script>

</body>

</html>