<!-- Scripts -->
<script src="{{ asset('bar/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('bar/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bar/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('bar/js/sb-admin-2.min.js') }}"></script>
@stack('js')

<!-- resources/views/layout/bar/scripts.blade.php -->
<script src="{{ asset('bar/js/app.js') }}"></script>
<!-- Pastikan jQuery sudah diimpor sebelum Bootstrap -->
<script src="{{ asset('bar/js/bootstrap.js') }}"></script>