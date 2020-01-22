<script src="{{asset('assets/plugin/iziToast/dist/js/iziToast.min.js')}}"></script>
<script>

    @if(Session::has('success'))
    iziToast.success({
        title: 'OK',
        message: '{{ session()->get('success') }}',
        position: 'topRight'
    });

    @endif

</script>