<script>
    window.deleteButtonTrans = '{{ trans("quickadmin.qa_delete_selected") }}';
    window.copyButtonTrans = '{{ trans("quickadmin.qa_copy") }}';
    window.csvButtonTrans = '{{ trans("quickadmin.qa_csv") }}';
    window.excelButtonTrans = '{{ trans("quickadmin.qa_excel") }}';
    window.pdfButtonTrans = '{{ trans("quickadmin.qa_pdf") }}';
    window.printButtonTrans = '{{ trans("quickadmin.qa_print") }}';
    window.colvisButtonTrans = '{{ trans("quickadmin.qa_colvis") }}';
</script>
<!-- //code.jquery.com/jquery-1.11.3.min.js -->
<script src="{{ url('public/adminlte/js/jquery-1.11.3.min.js') }}"></script>
<!-- //cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js -->
<script src="{{ url('public/adminlte/js/jquery.dataTables.min.js') }}"></script>
<!-- //cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js -->
<script src="{{ url('public/adminlte/js/dataTables.buttons.min.js') }}"></script>
<!-- //cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js -->
<script src="{{ url('public/adminlte/js/buttons.flash.min.js') }}"></script>
<!-- //cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js -->
<script src="{{ url('public/adminlte/js/jszip.min.js') }}"></script>
<!-- https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js -->
<script src="{{ url('public/adminlte/js/pdfmake.min.js ') }}"></script>
<!-- https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js -->
<script src="{{ url('public/adminlte/js/vfs_fonts.js ') }}"></script>
<!-- https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js -->
<script src="{{ url('public/adminlte/js/buttons.html5.min.js ') }}"></script>
<!-- https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js -->
<script src="{{ url('public/adminlte/js/buttons.print.min.js ') }}"></script>
<!-- https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js -->
<script src="{{ url('public/adminlte/js/buttons.colVis.min.js ') }}"></script>
<!-- https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js -->
<script src="{{ url('public/adminlte/js/dataTables.select.min.js ') }}"></script>
<!-- https://code.jquery.com/ui/1.11.3/jquery-ui.min.js -->
<script src="{{ url('public/adminlte/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('public/adminlte/js') }}/bootstrap.min.js"></script>
<script src="{{ url('public/adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('public/adminlte/js') }}/main.js"></script>

<script src="{{ url('public/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('public/adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('public/quickadmin/plugins/cosyAlert/jquery.cosyAlert.min.js') }}"></script>
<script src="{{ url('public/adminlte/js/app.min.js') }}"></script>
<script src="{{ url('public/js/instascan.min.js') }}"></script>
<script src="{{ url('public/js/webcam.min.js') }}"></script>
<script>
    window._token = '{{ csrf_token() }}';
</script>

@if(\Session::has('error'))
<script>
cosyAlert("{{ Session::get('error') }}", { vPos : 'top', hPos : 'right' });
</script>
@endif

@if(\Session::has('message'))
<script>
cosyAlert("{{ Session::get('message') }}", { vPos : 'top', hPos : 'right' });
</script>
@endif


<script>
    // http://cdn.datatables.net/plug-ins/1.10.16/i18n/English.json
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "url": "/public/adminlte/js/English.json"
        }
    });



</script>





@yield('javascript')
