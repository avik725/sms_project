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
                        <h5 class="card-header">
                            <a href="{{route('admin/dashboard')}}" class="text-muted fw-light"><b>Dashboard</b></a>
                            / <a href="{{route('admin/slider')}}" class="text-muted fw-light"><b>Slider</b> /</a>
                            Add Slider
                        </h5>


                        <div class="card">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-header">Add Slider</h5>
                                </div>
                            </div>
                            <form action="{{route('admin/add-store-slider')}}" method="POST" class="p-4" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="title" class="form-label">Title</label><span
                                            class="required">*</span>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter title"></input>
                                        @error('title')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="description" class="form-label">Description</label><span
                                            class="required">*</span>
                                        <input type="text" class="form-control" name="description" id="description"
                                            placeholder="Enter description"></input>
                                        @error('description')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="bg_image" class="form-label">Background Image</label><span
                                            class="required">*</span>
                                        <input type="file" class="form-control" name="bg_image" id="bg_image"
                                           ></input>
                                        @error('bg_image')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2 add-button">Add</button>

                                </div>
                            </form>
                        </div>
                        <!-- Footer -->
                        @include('Admin/common/footer-link')
                        <!-- / Footer -->

</body>

</html>