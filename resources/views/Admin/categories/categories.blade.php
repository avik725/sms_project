<!doctype html>
<html lang="en">

<head>
    @include('Admin/common/header-link')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('Admin/common/sidebar')

        <div class="body-wrapper">
            <!-- Header Start -->
            @include('Admin/common/header')
            <!-- Header End -->

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        <div id="category-form" style="display:none; width:540px;">
                            <form action="{{route('admin/store-categories')}}" method="POST" class="p-4"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <h4 class="card-title fw-semibold mb-4">Add New Category</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="category" class="form-label">Category</label><span>*</span>
                                        <input type="text" class="form-control" name="category" id="category"
                                            placeholder="Enter Category">
                                        @error('category')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">ADD</button>
                            </form>
                        </div>
                        <div id="subcategory-form" style="display:none; width:700px;">
                            <form action="{{route('admin/store-subcategories')}}" method="POST" class="p-4"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <h4 class="card-title fw-semibold mb-4">Add New Subcategory</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="category" class="form-label">Category</label><span>*</span>
                                        <select class="form-control" name="category_id" id="category">
                                            <option value="" disabled selected>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->category }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="subcategory" class="form-label">Subcategory</label><span>*</span>
                                        <input type="text" class="form-control" name="subcategory" id="subcategory"
                                            placeholder="Enter Subcategory">
                                        @error('subcategory')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">ADD</button>
                            </form>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title fw-semibold mb-4">Categories List</h5>
                            </div>
                            <div class="col-lg-6 text-end">
                                <button class="btn btn-primary {{$countOfCategories > 0 ? 'me-4' : ''}}" data-fancybox
                                    data-src="#category-form">
                                    <i class="ti ti-plus"></i>
                                    Create New Category
                                </button>
                                <button class="btn btn-primary {{$countOfCategories > 0 ? '' : 'd-none'}}" data-fancybox
                                    data-src="#subcategory-form">
                                    <i class="ti ti-plus"></i>
                                    Create New Sub-Category
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="category-table" class="table table-striped yajra-datatables" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Category</th>
                                        <th>Sub-Categories</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
            var table = $('#category-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin/categories') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'category',
                        name: 'category',
                    },
                    {
                        data: 'subcategories',
                        name: 'subcategories',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });
        });
    </script>

</body>

</html>