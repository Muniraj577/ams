<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets/admin/js/datatables.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admin/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('scripts')
