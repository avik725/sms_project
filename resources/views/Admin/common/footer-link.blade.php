<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('admin-assets/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/sidebarmenu.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/app.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/libs/simplebar/dist/simplebar.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/dashboard.js')}}"></script>
<script src="{{asset('admins-assets/assets/js/fancybox.js')}}"></script>


<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(Session::has('success'))
  <script type="text/javascript">
    $(document).ready(function () {
    Swal.fire({
      title: 'Success!',
      text: '{{ session("success") }}',
      icon: 'success',
      confirmButtonText: 'Close'
    });
    });
  </script>
  @php
  Session::forget('success');
@endphp
@endif
@if(Session::has('error'))
  <script type="text/javascript">
    $(document).ready(function () {
    Swal.fire({
      title: 'Error!',
      text: '{{ session("error") }}',
      icon: 'error',
      confirmButtonText: 'Close'
    });
    });
  </script>
  @php
  Session::forget('error');
@endphp
@endif