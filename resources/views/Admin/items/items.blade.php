<!doctype html>
<html lang="en">

<head>
    @include('Admin/common/header-link')

</head>

<body>
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

                        <!-- Form to add supplier -->
                        <div id="add-form" style="display:none; max-width:840px;">
                            <form action="{{ route('admin/store-items') }}" method="POST" class="p-4">
                                @csrf
                                <h4 class="card-title fw-semibold mb-4">Add New Item</h4>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="item" class="form-label">Item Name</label><span>*</span>
                                        <input type="text" class="form-control" name="item" id="item"
                                            placeholder="Enter Item Name">
                                        @error('item')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="category_id" class="form-label">Category</label><span>*</span>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->category }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="subcategory_id" class="form-label">Subcategory</label><span>*</span>
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                            <option value="">Select Subcategory</option>
                                        </select>
                                        @error('subcategory_id')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="measurement_category" class="form-label">Measurement
                                            Category</label><span>*</span>
                                        <select name="measurement_category" id="measurement_category"
                                            class="form-control">
                                            <option value="">Select Measure Category</option>
                                            <option value="Weight">Weight</option>
                                            <option value="Volume">Volume</option>
                                            <option value="Count">Count</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="units_id" class="form-label">Unit</label><span>*</span>
                                        <select name="units_id" id="units_id" class="form-control">
                                            <option value="">Select Unit</option>
                                        </select>
                                        @error('units_id')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="measurement_value" class="form-label">Measurement
                                            Value</label><span>*</span>
                                        <input type="text" class="form-control" name="measurement_value"  id="measurement_value"
                                            placeholder="Enter Measurement Value">
                                        @error('measurement_value')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="buying_price" class="form-label">Buying Price</label><span>*</span>
                                        <input type="text" class="form-control" name="buying_price" placeholder="Enter Buying Price" id="buying_price">
                                        @error('buying_price')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="selling_price" class="form-label">Selling Price</label><span>*</span>
                                        <input type="text" class="form-control" name="selling_price" placeholder="Enter Price" id="selling_price">
                                        @error('selling_price')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Add Item</button>
                            </form>
                        </div>

                        <!-- Form to update supplier -->
                        <div id="edit-form" style="max-width:900px; display: none;">
                            <form method="POST" class="p-4">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="item" class="form-label">Item Name</label><span>*</span>
                                        <input type="text" class="form-control" name="item" id="item"
                                            placeholder="Enter Item Name">
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="category_id" class="form-label">Category</label><span>*</span>
                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="subcategory_id" class="form-label">Subcategory</label><span>*</span>
                                        <select name="subcategory_id" id="subcategory_id" class="form-control"></select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="measurement_category" class="form-label">Measurement
                                            Category</label><span>*</span>
                                        <select name="measurement_category" id="measurement_category"
                                            class="form-control">
                                            <option value="Weight">Weight</option>
                                            <option value="Volume">Volume</option>
                                            <option value="Count">Count</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="units_id" class="form-label">Unit</label><span>*</span>
                                        <select name="units_id" id="units_id" class="form-control">
                                            <option value="">Select Unit</option>
                                        </select>
                                        @error('units_id')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="measurement_value" class="form-label">Measurement
                                            Value</label><span>*</span>
                                        <input type="text" class="form-control" name="measurement_value"
                                            id="measurement_value" placeholder="Enter Measurement Value">
                                        @error('measurement_value')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="buying_price" class="form-label">Buying Price</label><span>*</span>
                                        <input type="text" class="form-control" name="buying_price" id="buying_price"
                                            placeholder="Enter Buying Price">
                                        @error('buying_price')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="selling_price" class="form-label">Selling Price</label><span>*</span>
                                        <input type="text" class="form-control" name="selling_price" id="selling_price"
                                            placeholder="Enter Selling Price">
                                        @error('selling_price')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>


                        <!-- Button to trigger Fancybox -->
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title fw-semibold mb-4">Items List</h5>
                            </div>
                            <div class="col-lg-6 text-end">
                                <button class="btn btn-primary" data-fancybox data-src="#add-form">
                                    <i class="ti ti-plus"></i>
                                    Create New Item
                                </button>
                            </div>
                        </div>

                        <!-- Data Table for Suppliers -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped yajra-datatables" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>Sr.no</th>
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Measure</th>
                                        <th>Value On Base Unit</th>
                                        <th>Unit</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
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
                ajax: "{{route('admin/items')}}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'item',
                    name: 'item',
                },
                {
                    data: 'category',
                    name: 'category',
                },
                {
                    data: 'subcategory',
                    name: 'subcategory',
                },
                {
                    data: 'measurement_category',
                    name: 'measurement_category',
                },
                {
                    data: 'measurement_value',
                    name: 'measurement_value',
                },
                {
                    data: 'unit',
                    name: 'unit',
                },
                {
                    data: 'buying_price',
                    name: 'buying_price',
                },
                {
                    data: 'selling_price',
                    name: 'selling_price',
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
        $(document).ready(function () {
            // Handle category change for both add and edit forms
            $('#add-form #category_id, #edit-form #category_id').change(function () {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: '{{ route("admin/getsubcategories-items") }}',
                        type: 'GET',
                        data: { category_id: category_id },
                        success: function (data) {
                            $('#add-form #subcategory_id, #edit-form #subcategory_id').empty();
                            $('#add-form #subcategory_id, #edit-form #subcategory_id').append('<option value="">Select Subcategory</option>');
                            $.each(data, function (key, value) {
                                $('#add-form #subcategory_id, #edit-form #subcategory_id').append('<option value="' + value.subcategory_id + '">' + value.subcategory + '</option>');
                            });
                        }
                    });
                } else {
                    $('#add-form #subcategory_id, #edit-form #subcategory_id').empty();
                    $('#add-form #subcategory_id, #edit-form #subcategory_id').append('<option value="">Select Subcategory</option>');
                }
            });

            // Handle measurement category change for both add and edit forms
            $('#add-form #measurement_category, #edit-form #measurement_category').change(function () {
                var measurement_category = $(this).val();
                if (measurement_category) {
                    $.ajax({
                        url: '{{ route("admin/get-units") }}',
                        type: 'GET',
                        data: { measurement_category: measurement_category },
                        success: function (data) {
                            $('#add-form #units_id, #edit-form #units_id').empty();
                            $('#add-form #units_id, #edit-form #units_id').append('<option value="">Select Unit</option>');
                            $.each(data, function (key, value) {
                                $('#add-form #units_id, #edit-form #units_id').append('<option value="' + value.units_id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#add-form #units_id, #edit-form #units_id').empty();
                    $('#add-form #units_id, #edit-form #units_id').append('<option value="">Select Unit</option>');
                }
            });
        });
    </script>

    <script>
        var getItemDataUrl = "{{ route('admin/get-items', ['items_id' => ':itemId']) }}";
        var editItemUrl = "{{ route('admin/update-items', ['items_id' => ':itemId']) }}";

        $(document).ready(function () {
            // Set the initial form action for the edit form
            $('#edit-form > form').attr('action', editItemUrl.replace(':itemId', ''));

            // Use event delegation to handle dynamically generated edit buttons
            $(document).on('click', '.edit', function (e) {
                e.preventDefault();  // Prevent the default behavior of the anchor tag (page reload)

                var itemId = $(this).data('items_id');  // Get the item ID from the data attribute

                // Set the form action dynamically
                $('#edit-form > form').attr('action', editItemUrl.replace(':itemId', itemId));

                // Make AJAX request to fetch item data
                $.ajax({
                    url: getItemDataUrl.replace(':itemId', itemId),  // Ensure dynamic URL
                    method: 'GET',
                    success: function (response) {
                        if (response.error) {
                            alert('Error: ' + response.error);
                        } else {
                            var item = response;

                            // Populate the form fields with item data
                            $('#edit-form #item').val(item.item);
                            $('#edit-form #category_id').val(item.category_id);

                            // Fetch subcategories dynamically based on the selected category
                            $.ajax({
                                url: '{{ route('admin/getsubcategories-items') }}',
                                type: 'GET',
                                data: { category_id: item.category_id },
                                success: function (subcategories) {
                                    $('#edit-form #subcategory_id').empty(); // Clear the existing options
                                    $('#edit-form #subcategory_id').append('<option value="">Select Subcategory</option>'); // Default option

                                    // Loop through the data and append each subcategory option
                                    $.each(subcategories, function (key, value) {
                                        $('#edit-form #subcategory_id').append('<option value="' + value.subcategory_id + '">' + value.subcategory + '</option>');
                                    });

                                    // Select the correct subcategory after appending options
                                    $('#edit-form #subcategory_id').val(item.subcategory_id);
                                },
                                error: function () {
                                    alert('Failed to fetch subcategories');
                                }
                            });

                            // Fetch units dynamically based on the selected measurement category
                            $.ajax({
                                url: '{{ route('admin/get-edit-units') }}',
                                type: 'GET',
                                data: { units_id: item.units_id },  // Fetch units based on measurement category
                                success: function (units) {
                                    $('#edit-form #units_id').empty(); // Clear the existing options
                                    $('#edit-form #units_id').append('<option value="">Select Unit</option>'); // Default option

                                    // Loop through the data and append each unit option
                                    $.each(units, function (key, value) {
                                        $('#edit-form #units_id').append('<option value="' + value.units_id + '">' + value.name + '</option>');
                                    });

                                    // Select the correct unit after appending options
                                    $('#edit-form #units_id').val(item.units_id);
                                },
                                error: function () {
                                    alert('Failed to fetch units');
                                }
                            });

                            // Populate the remaining fields
                            $('#edit-form #measurement_value').val(item.measurement_value);
                            $('#edit-form #buying_price').val(item.buying_price);
                            $('#edit-form #selling_price').val(item.selling_price);

                            // Open the Fancybox modal for editing
                            $.fancybox.open($('#edit-form'));
                        }
                    },
                    error: function () {
                        alert('Failed to fetch item data');
                    }
                });
            });
        });
    </script>




</body>

</html>