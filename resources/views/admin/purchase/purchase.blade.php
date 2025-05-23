<!doctype html>
<html lang="en">

<head>
    @include('admin/common/header-link')

</head>

<body>
    <section id="purchase-page">

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
                    <div class="card mt-4">
                        <div class="card-body">

                            <!-- Form to add supplier -->
                            <div id="add-form" style="display:none; max-width:840px; overflow:hidden;">
                                <form action="{{ route('store-purchases') }}" method="POST" class="p-4">
                                    @csrf
                                    <h4 class="card-title fw-semibold mb-4">Place New Order</h4>

                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="item_id" class="form-label">Item Name</label><span>*</span>
                                            <select name="item_id" id="item_id" class="form-control">
                                                <option value="">Select Item</option>
                                                @foreach ($items as $items_data)
                                                    <option value="{{ $items_data->items_id }}">{{ $items_data->item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('item_id')
                                            <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label for="supplier_id" class="form-label">Supplier</label><span>*</span>
                                            <select name="supplier_id" id="supplier_id" class="form-control">
                                                <option value="">Select Suppliers</option>
                                                @foreach ($suppliers as $suppliers_data)
                                                    <option value="{{ $suppliers_data->suppliers_id }}">
                                                        {{ $suppliers_data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('supplier_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="quantity" class="form-label">Quantity</label><span>*</span>
                                            <input type="number" name="quantity" id="quantity" class="form-control">
                                            @error('quantity')
                                            <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label for="expiry_date" class="form-label">Expiry Date</label><span>
                                                (optional)</span>
                                            <input type="date" name="expiry_date" id="expiry_date" class="form-control">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                </form>
                            </div>

                            <div id="edit-form" style="display:none; max-width:840px; overflow:hidden;">
                                <form method="POST" class="p-4">
                                    @csrf
                                    <h4 class="card-title fw-semibold mb-4">Update Existing Order</h4>

                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="item_id" class="form-label">Item Name</label><span>*</span>
                                            <select name="item_id" id="item_id" class="form-control">
                                                <option value="">Select Item</option>
                                                @foreach ($items as $items_data)
                                                    <option value="{{ $items_data->items_id }}">{{ $items_data->item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('item_id')
                                            <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label for="supplier_id" class="form-label">Supplier</label><span>*</span>
                                            <select name="supplier_id" id="supplier_id" class="form-control">
                                                <option value="">Select Suppliers</option>
                                                @foreach ($suppliers as $suppliers_data)
                                                    <option value="{{ $suppliers_data->suppliers_id }}">
                                                        {{ $suppliers_data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('supplier_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="quantity" class="form-label">Quantity</label><span>*</span>
                                            <input type="number" name="quantity" id="quantity" class="form-control">
                                            @error('quantity')
                                            <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label for="expiry_date" class="form-label">Expiry Date</label><span>
                                                (optional)</span>
                                            <input type="date" name="expiry_date" id="expiry_date" class="form-control">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                </form>
                            </div>

                            <!-- Button to trigger Fancybox -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-title fw-semibold mb-4">Purchase Orders</h5>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <button class="btn btn-primary" data-fancybox data-src="#add-form">
                                        <i class="ti ti-plus"></i>
                                        Place Order
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
                                            <th>Supplier</th>
                                            <th>Quantity</th>
                                            <th>Expiry Date</th>
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

    @include('admin/common/footer-link')

    <!-- DataTable Initialization -->
    <script>
        $(function () {
            var table = $('.yajra-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('purchases')}}",
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
        var getPurchaseDataUrl = "{{ route('get-purchase-details', ['purchase_id' => ':purchaseId']) }}";
        var editPurchaseUrl = "{{ route('update-purchases', ['purchase_id' => ':purchaseId']) }}";

        $(document).ready(function () {
            $('#edit-form > form').attr('action', editPurchaseUrl.replace(':purchaseId', ''));
            $(document).on('click', '#editBtn', function (e) {
                e.preventDefault();

                var purchaseId = $(this).data('purchase_id');
                $('#edit-form > form').attr('action', editPurchaseUrl.replace(':purchaseId', purchaseId));
                $.ajax({
                    url: getPurchaseDataUrl.replace(':purchaseId', purchaseId),
                    method: 'GET',
                    success: function (response) {
                        if (response.error) {
                            alert('Error: ' + response.error);
                        } else {
                            var itemSelectize = $('#edit-form #item_id')[0].selectize;
                            itemSelectize.setValue(response.item_id);

                            var supplierSelectize = $('#edit-form #supplier_id')[0].selectize;
                            supplierSelectize.setValue(response.supplier_id);

                            $('#edit-form #quantity').val(response.quantity);
                            $('#edit-form #expiry_date').val(response.expiry_date);

                            $.fancybox.open($('#edit-form'));
                        }
                    },
                    error: function () {
                        alert('Failed to fetch purchase data');
                    }
                });
            });
        });
    </script>

</body>

</html>