<script src="{{asset('assets/backend/js/jquery-3.2.1.min.js')}}"></script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script src="{{asset('assets/plugin/bootstrap-4.0.0/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/backend/js/bootadmin.min.js')}}"></script>

<script src="{{asset('assets/plugin/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>

<script src="{{asset('assets/plugin/niceditor/nicEdit.js')}}"></script>

<script src="{{asset('assets/plugin/select2/dist/js/select2.min.js')}}"></script>

<script src="{{asset('assets/plugin/moment/moment.min.js')}}"></script>

<script src="{{asset('assets/plugin/print_this.js')}}"></script>

<script src="{{asset('assets/plugin/vue/vue.js')}}"></script>

<script src="{{asset('assets/plugin/axios/axios.js')}}"></script>

<script src="{{asset('assets/backend/js/custom.js')}}"></script>





<script>

    $('.select2').select2({

        width:'100%',

    });

    window.Laravel = <?php echo json_encode([

        'csrfToken' => csrf_token(),

    ])?>;



    function printContent(el){

        var restorepage  = $('body').html();

        var printcontent = $('#' + el).clone();

        $('body').empty().html(printcontent);

        window.print();

        $('body').html(restorepage);

        location.reload();

    }


    $(document).ready( function () {
        $('#jquery-datatable').DataTable();
} );

</script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

@yield('script')