<!doctype html>
<html lang="en">

<head>
    @include('Admin/common/header-link')

</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="bar-container">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <h1>Hang On !</h1>
        <h1>It's Loading...</h1>
    </div>

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
                                <h5 class="card-title fw-semibold mb-4">Stock Transactions</h5>
                            </div>
                        </div>

                        <!-- Data Table for Suppliers -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped yajra-datatables text-center"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Batch Id</th>
                                        <th>Item Name</th>
                                        <th>Transaction</th>
                                        <th>Quantity</th>
                                        <th>Remaining Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Admin/common/footer-link')

    <!-- DataTable Initialization -->
    <script>
        $(function () {
            var table = $('.yajra-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('transactions')}}",
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
                    data: 'change_type',
                    name: 'change_type',
                },
                {
                    data: 'change_quantity',
                    name: 'change_quantity',
                },
                {
                    data: 'remaining_stock',
                    name: 'remaining_stock',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                }
                ]
            })
        });
    </script>

</body>

</html>