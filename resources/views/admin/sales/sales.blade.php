<!doctype html>
<html lang="en">

<head>
    @include('Admin/common/header-link')

</head>

<body>
    <section id="sales-page">

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

                            <!-- Form to add supplier -->
                            <div id="add-form" style="display:none; max-width:840px; overflow:hidden;">
                                <form action="{{ route('store-sales') }}" method="POST" class="p-4">
                                    @csrf
                                    <h4 class="card-title fw-semibold mb-4">Create New Order</h4>

                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="item_id" class="form-label">Item Name</label><span>*</span>
                                            <select name="item_id" id="item_id" class="form-control">
                                                <option value="">Select Item</option>
                                                @foreach ($items as $item)
                                                    <option value="{{$item->items_id}}">{{$item->item}}</option>
                                                @endforeach
                                            </select>
                                            @error('item_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="quantity" class="form-label">Quantity</label><span>*</span>
                                            <input type="number" name="quantity" id="quantity" class="form-control">
                                            @error('quantity')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="sale_price" class="form-label d-inline">Sale
                                                        Price</label><span>
                                                        (Optional : Fetched Automatically)</span>
                                                </div>
                                                <div class="col-lg-6 mt-2">
                                                    <input type="text" name="sale_price" id="sale_price"
                                                        class="form-control">
                                                </div>
                                                <div class="col-lg-6 d-flex align-items-center">
                                                    <i class="ti ti-arrow-left text-danger"></i>
                                                    <i class="ti ti-line-dashed text-danger"></i>
                                                    <p class="text-danger ms-1 mt-2">Selling Price can be Edited or can
                                                        used as
                                                        Predefined here</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="available_stock" class="form-label d-block">Available
                                                Stock</label>
                                            <span id="available_stock" class="ms-3"><-- Select Item --></span>
                                            <span id="unit" class="ms-2"></span>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create Order</button>
                                </form>
                            </div>

                            <!-- Form to update supplier -->
                            <div id="edit-form" style="max-width:900px; display: none;">
                                <form method="POST" class="p-4">
                                    @csrf
                                    <h4 class="card-title fw-semibold mb-4">Create New Order</h4>

                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="item_id" class="form-label">Item Name</label><span>*</span>
                                            <select name="item_id" id="item_id" class="form-control">
                                                <option value="">Select Item</option>
                                                @foreach ($items as $item)
                                                    <option value="{{$item->items_id}}">{{$item->item}}</option>
                                                @endforeach
                                            </select>
                                            @error('item_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="quantity" class="form-label">Quantity</label><span>*</span>
                                            <input type="number" name="quantity" id="quantity" class="form-control">
                                            @error('quantity')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="sale_price" class="form-label d-inline">Sale
                                                        Price</label><span>
                                                        (Optional : Fetched Automatically)</span>
                                                </div>
                                                <div class="col-lg-6 mt-2">
                                                    <input type="text" name="sale_price" id="sale_price"
                                                        class="form-control">
                                                </div>
                                                <div class="col-lg-6 d-flex align-items-center">
                                                    <i class="ti ti-arrow-left text-danger"></i>
                                                    <i class="ti ti-line-dashed text-danger"></i>
                                                    <p class="text-danger ms-1 mt-2">Selling Price can be Edited or can
                                                        used as
                                                        Predefined here</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="available_stock" class="form-label d-block">Available
                                                Stock</label>
                                            <span id="available_stock" class="ms-3"><-- Select Item --></span>
                                            <span id="unit" class="ms-2"></span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>

                            <!-- Button to trigger Fancybox -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-title fw-semibold mb-4">Sales Orders</h5>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <button class="btn btn-primary" data-fancybox data-src="#add-form">
                                        <i class="ti ti-plus"></i>
                                        Create Order
                                    </button>
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
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Sale Price</th>
                                            <th>Status</th>
                                            <th>Change Status</th>
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

    @include('Admin/common/footer-link')

    <!-- DataTable Initialization -->
    <script>
        $(function () {
            var table = $('.yajra-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('sales')}}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'batch_ids',
                    name: 'batch_ids',
                },
                {
                    data: 'item',
                    name: 'item',
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                },
                {
                    data: 'sale_price',
                    name: 'sale_price',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'change_status',
                    name: 'change_status',
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
            // Common event listener for item selection
            $('form').on('change', '#item_id', function () {
                let itemId = $(this).val();
                let form = $(this).closest('form');  // Get the closest form

                if (itemId) {
                    // AJAX request to fetch item details
                    $.ajax({
                        url: "{{ route('getItemDetails') }}",
                        method: "GET",
                        data: { item_id: itemId },
                        success: function (response) {
                            if (response.status === 'success') {
                                // Set selling price
                                form.find('#sale_price').val(response.selling_price);

                                // Set available stock
                                form.find('#available_stock').text(Math.floor(response.available_stock));
                                form.find('#unit').text(response.unit);
                            } else {
                                form.find('#sale_price').val('0');
                                form.find('#available_stock').text('0');
                                form.find('#unit').text('');
                            }
                        },
                        error: function () {
                            form.find('#sale_price').val('0');
                            form.find('#unit').text('');
                            form.find('#available_stock').text('Item Not In Stock');
                        }
                    });
                } else {
                    // Clear fields if no item selected
                    form.find('#sale_price').val('');
                    form.find('#available_stock').text('N/A');
                    form.find('#unit').text('');
                }
            });
        });
    </script>

    <script>
        var getSaleDataUrl = "{{ route('get-sale-details', ['sale_id' => ':saleId']) }}";
        var editSaleUrl = "{{ route('update-sales', ['sale_id' => ':saleId']) }}";

        $(document).ready(function () {
            $('#edit-form > form').attr('action', editSaleUrl.replace(':saleId', ''));
            $(document).on('click', '.edit', function (e) {
                e.preventDefault();

                var saleId = $(this).data('sale_id');
                $('#edit-form > form').attr('action', editSaleUrl.replace(':saleId', saleId));
                $.ajax({
                    url: getSaleDataUrl.replace(':saleId', saleId),
                    method: 'GET',
                    success: function (response) {
                        if (response.error) {
                            alert('Error: ' + response.error);
                        } else {
                            var sale = response;

                            var itemSelectize = $('#edit-form #item_id')[0].selectize;
                            itemSelectize.setValue(sale.item_id);

                            $('#edit-form #quantity').val(sale.quantity);
                            $('#edit-form #sale_price').val(sale.sale_price);

                            var batchInfo = '';
                            $.each(sale.batch_ids, function (index, batch) {
                                batchInfo += 'Batch ID: ' + batch.batch_id + ', Quantity: ' + batch.quantity + '<br>';
                            });
                            $('#edit-form #batch_ids').html(batchInfo);

                            $.fancybox.open($('#edit-form'));
                        }
                    },
                    error: function () {
                        alert('Failed to fetch sale data');
                    }
                });
            });
        });
    </script>



</body>

</html>