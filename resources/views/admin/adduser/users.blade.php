<!doctype html>
<html lang="en">

<head>
    @include('admin/common/header-link')

</head>

<body>
    <section id="users-page">

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

            @include('admin/common/sidebar')

            <!-- Main wrapper -->
            <div class="body-wrapper">
                <!-- Header Start -->
                @include('admin/common/header')
                <!-- Header End -->

                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Add New User</h5>
                            <form action="{{route('admin/add-users')}}" method="POST"
                                class="p-4" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="name" class="form-label">Full Name</label><span>*</span>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Full Name"></input>
                                        @error('name')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="email" class="form-label">Email</label><span>*</span>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter Your Email"></input>
                                        @error('email')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="dob" class="form-label">Date Of Birth</label><span>*</span>
                                        <input type="date" class="form-control" name="dob" id="dob"
                                            placeholder="Enter Your Email"></input>
                                        @error('dob')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="password" class="form-label">Password</label><span>*</span>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Enter password"></input>
                                        @error('password')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="role" class="form-label">User Role</label><span>*</span>
                                        <select class="form-control" name="role" id="role" disabled>
                                            <option value="staff" selected>Staff</option>
                                        </select>
                                        <input type="hidden" name="role" value="staff">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">

                            <!-- Button to trigger Fancybox -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-title fw-semibold mb-4">Active Users</h5>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Registered Date</th>
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
    </section>

    @include('admin/common/footer-link')

    <!-- DataTable Initialization -->
    <script>
        $(function () {
            var table = $('.yajra-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('admin/users')}}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'date',
                    name: 'date'
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