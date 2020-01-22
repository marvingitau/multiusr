<script src="{{asset('assets/plugin/iziToast/dist/js/iziToast.min.js')}}"></script>
<script>

    @if(Session::has('success'))
    iziToast.success({
        title: 'OK',
        message: '{{ session()->get('success') }}',
        position: 'bottomRight'
    });

    @endif
    @if(Session::has('error'))
    iziToast.error({
        title: 'Whoops!',
        message: '{{ session()->get('error') }}',
        position: 'bottomRight'
    });

    @endif
            @if ($errors->any())
    var html ='<ul>';
    @foreach ($errors->all() as $error)
        html +='<li>{{ $error }}</li>';
    @endforeach
        html +=' </ul>';
    iziToast.error({
        title: 'Whoops!'+html,
            message: '{{ session()->get('error') }}',
            position: 'bottomRight'
    });
    @endif
</script>