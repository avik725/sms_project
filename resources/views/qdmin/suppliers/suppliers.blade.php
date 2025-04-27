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
                <div class="card">
                    <div class="card-body">

                        <!-- Form to add supplier -->
                        <div id="add-form" style="display:none; max-width:900px;">
                            <form action="{{route('admin/store-suppliers')}}" method="POST" class="p-4"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <h4 class="card-title fw-semibold mb-4">Add New Supplier</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="name" class="form-label">Supplier Name</label><span>*</span>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Supplier Name">
                                        @error('name')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="contact_person" class="form-label">Contact
                                            Person</label><span>*</span>
                                        <input type="text" class="form-control" name="contact_person"
                                            id="contact_person" placeholder="Enter Contact Person">
                                        @error('contact_person')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="phone" class="form-label">Mobile No.</label><span>*</span>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            placeholder="Enter Mobile No.">
                                        @error('phone')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="email" class="form-label">Email</label><span>*</span>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="category" class="form-label">Category</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="category" id="category"
                                            placeholder="Enter Category">
                                        @error('category')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="gst_number" class="form-label">GST
                                            Number</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="gst_number" id="gst_number"
                                            placeholder="Enter GST Number">
                                        @error('gst_number')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="address" class="form-label">Address</label><span>*</span>
                                        <textarea class="form-control" name="address" id="address"
                                            placeholder="Enter Address"></textarea>
                                        @error('address')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="account_no" class="form-label">Account
                                            No.</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="account_no" id="account_no"
                                            placeholder="Enter Account No.">
                                        @error('account_no')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="bank_name" class="form-label">Bank
                                            Name</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name"
                                            placeholder="Enter Bank Name">
                                        @error('bank_name')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="ifsc_code" class="form-label">IFSC
                                            Code</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                            placeholder="Enter IFSC Code">
                                        @error('ifsc_code')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">ADD</button>
                            </form>
                        </div>

                        <!-- Form to update supplier -->
                        <div id="edit-form" style="display:none;  max-width:900px;">
                            <form method="POST" class="p-4" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <h4 class="card-title fw-semibold mb-4">Add New Supplier</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="name" class="form-label">Supplier Name</label><span>*</span>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Supplier Name">
                                        @error('name')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="contact_person" class="form-label">Contact
                                            Person</label><span>*</span>
                                        <input type="text" class="form-control" name="contact_person"
                                            id="contact_person" placeholder="Enter Contact Person">
                                        @error('contact_person')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="phone" class="form-label">Mobile No.</label><span>*</span>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            placeholder="Enter Mobile No.">
                                        @error('phone')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="email" class="form-label">Email</label><span>*</span>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="category" class="form-label">Category</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="category" id="category"
                                            placeholder="Enter Category">
                                        @error('category')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="gst_number" class="form-label">GST
                                            Number</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="gst_number" id="gst_number"
                                            placeholder="Enter GST Number">
                                        @error('gst_number')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="address" class="form-label">Address</label><span>*</span>
                                        <textarea class="form-control" name="address" id="address"
                                            placeholder="Enter Address"></textarea>
                                        @error('address')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="account_no" class="form-label">Account
                                            No.</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="account_no" id="account_no"
                                            placeholder="Enter Account No.">
                                        @error('account_no')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="bank_name" class="form-label">Bank
                                            Name</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name"
                                            placeholder="Enter Bank Name">
                                        @error('bank_name')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="ifsc_code" class="form-label">IFSC
                                            Code</label><span>(optional)</span>
                                        <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                            placeholder="Enter IFSC Code">
                                        @error('ifsc_code')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2 add-button">Update</button>

                                </div>
                            </form>
                        </div>

                        <!-- Button to trigger Fancybox -->
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title fw-semibold mb-4">Suppliers List</h5>
                            </div>
                            <div class="col-lg-6 text-end">
                                <button class="btn btn-primary" data-fancybox data-src="#add-form">
                                    <i class="ti ti-plus"></i>
                                    Create New
                                </button>
                            </div>
                        </div>

                        <!-- Data Table for Suppliers -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped yajra-datatables text-center"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Name</th>
                                        <th>Contact Person</th>
                                        <th>Phone</th>
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
                ajax: "{{route('admin/suppliers')}}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'contact_person',
                    name: 'contact_person',
                },
                {
                    data: 'phone',
                    name: 'phone',
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


    <script>
        var getSupplierUrl = "{{ route('admin/supplier-data', ['suppliers_id' => ':supplierId']) }}";
        var editSupplierUrl = "{{ route('admin/edit-suppliers', ['suppliers_id' => ':supplierId']) }}";

        $(document).ready(function () {
            $('#edit-form > form').attr('action', editSupplierUrl.replace(':supplierId', ''));
            // Use event delegation to handle dynamically generated edit buttons
            $(document).on('click', '.edit', function (e) {
                e.preventDefault();  // Prevent the default behavior of the anchor tag (page reload)

                var supplierId = $(this).data('suppliers_id');  // Get the supplier ID from the data attribute

                // Set the form action dynamically
                $('#edit-form > form').attr('action', editSupplierUrl.replace(':supplierId', supplierId));

                // Make AJAX request to fetch supplier data
                $.ajax({
                    url: getSupplierUrl.replace(':supplierId', supplierId),  // Ensure dynamic URL
                    method: 'GET',
                    success: function (response) {
                        if (response.error) {
                            alert('Error: ' + response.error);
                        } else {
                            var supplier = response;

                            // Populate the form fields with supplier data
                            $('#edit-form #name').val(supplier.name);
                            $('#edit-form #contact_person').val(supplier.contact_person);
                            $('#edit-form #phone').val(supplier.phone);
                            $('#edit-form #email').val(supplier.email);
                            $('#edit-form #category').val(supplier.category);
                            $('#edit-form #gst_number').val(supplier.gst_number);
                            $('#edit-form #address').val(supplier.address);
                            $('#edit-form #account_no').val(supplier.account_no);
                            $('#edit-form #bank_name').val(supplier.bank_name);
                            $('#edit-form #ifsc_code').val(supplier.ifsc_code);

                            // Open the Fancybox modal
                            console.log("")
                            $('#edit-form [data-fancybox]').fancybox();
                        }
                    },
                    error: function () {
                        alert('Failed to fetch supplier data');
                    }
                });
            });
        });
    </script>



</body>

</html>