<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    @include('Admin/common/header-link')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('Admin/common/sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h5 class="fw-bold py-3 mb-4"><a href="{{route('admin/dashboard')}}"
                                class="text-muted fw-light"><b>Dashboard</b> /</a>Quote Form
                        </h5>


                        <div class="card">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-header">Quote Form</h5>
                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped yajra-datatables" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Footer -->
                @include('Admin/common/footer-link')
                <!-- / Footer -->


                <script>
                    $(function () {
                        var table = $('.yajra-datatables').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{route('')}}",
                            columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'name',
                                name: 'name',
                            },
                            {
                                data: 'email',
                                name: 'email',
                            },
                            {
                                data: 'phone',
                                name: 'phone',
                            },
                            {
                                data: 'message',
                                name: 'message',
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