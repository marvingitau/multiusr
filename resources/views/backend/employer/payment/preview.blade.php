@extends('backend.employer.master')
@section('title',$pt)
@section('content')
    <div class="card ">
        <div class="card-body border-bottom">
            <h4>{{$pt}}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employer.payment.confirm') }}">
                @csrf
                <div class="card-body row">
                    <div class="col-md-6 ">
                        <img src="{{asset('assets/backend/image/gateway')}}/{{$data->gateway_id}}.jpg" style="max-width:200px; margin:0 auto;"/>
                    </div>
                    <div class="col-md-6">

                        <input type="hidden" name="gateway" value="{{$data->gateway_id}}"/>
                        <ul class="list-group border-radius-0 mt-3">
                            <li class="list-group-item border-radius-0">Package Name <span class="float-right">{{ucfirst($package->title)}}</span></li>
                            <li class="list-group-item border-radius-0">Can post jobs <span class="float-right">{{$package->num_of_listing}}</span></li>
                            <li class="list-group-item border-radius-0">Package Duration <span class="float-right">{{$package->days}} Days</span></li>
                            <li class="list-group-item border-radius-0">Amount: <span class="float-right">{{general_setting()->cur_sym}} {{$data->amount}} </span></li>
                            <li class="list-group-item border-radius-0">In USD: <span class="float-right">$ {{$data->usd_amo}}</span></li>
                        </ul>
                    </div>
                </div>

                <div class="card-body text-right  bg-th-o-1">
                    <button type="submit" class="btn btn-tsk btn-square font-weight-bold" id="btn-confirm">
                        Pay Now > > >
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
@if($data->gateway_id == 107)
<form action="{{ route('ipn.paystack') }}" method="POST">
    @csrf
    <script
    src="//js.paystack.co/v1/inline.js"
    data-key="{{ $data->gateway->val1 }}"
    data-email="{{ $data->user->email }}"
    data-amount="{{ round($data->usd_amo/$data->gateway->val7, 2)*100 }}"
    data-currency="NGN"
    data-ref="{{ $data->trx }}"
    data-custom-button="btn-confirm"
    >
    </script>
</form>
@elseif($data->gateway_id == 108)
<script src="//voguepay.com/js/voguepay.js"></script>
<script>
    closedFunction = function() {
        
    }
    successFunction = function(transaction_id) {
        window.location.href = '{{ url('home/vogue') }}/' + transaction_id + '/success';
    }
    failedFunction=function(transaction_id) {
        window.location.href = '{{ url('home/vogue') }}/' + transaction_id + '/error';
    }

    function pay(item, price) {
        //Initiate voguepay inline payment
        Voguepay.init({
            v_merchant_id: "{{ $data->gateway->val1 }}",
            total: price,
            notify_url: "{{ route('ipn.voguepay') }}",
            cur: 'USD',
            merchant_ref: "{{ $data->trx }}",
            memo:'Deposit',
            recurrent: true,
            frequency: 10,
            developer_code: '5af93ca2913fd',
            store_id:"{{ $data->user_id }}",
            custom: "{{ $data->trx }}",
            
            closed:closedFunction,
            success:successFunction,
            failed:failedFunction
        });
    }
    
    $(document).ready(function () {
        $(document).on('click', '#btn-confirm', function (e) {
            e.preventDefault();
            pay('Deposit', {{ $data->usd_amo }});
        });
    })
</script>

@endif
@endsection
