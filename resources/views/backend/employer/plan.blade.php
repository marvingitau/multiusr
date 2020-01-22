

@extends('backend.employer.master')
@section('title','Plan')
@section('style')
    <style>
        .plan-chart .plan-item .plan-body{
            /*height: 300px;*/
        }
        .plan-chart .plan-item .plan-body .amount{
            font-size: 50px;
            font-weight: bold;
        }
        .plan-chart .plan-item .plan-body .amount small{
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    @endsection
@section('content')
    <h4>Plan</h4>
    <hr/>
    <div class="row justify-content-center plan-chart">
        @foreach($packages as $package)
        <div class="col-md-3">
            <div class="card border-tsk plan-item">
                <div class="card-header bg-tsk text-white text-center border-radius-0">
              <i class="fa fa-send fa-3x"></i>
                    <h1 class="font-weight-bold mt-3">{{ucfirst($package->title)}}</h1>
                </div>
                <div class="card-body text-center plan-body">
                    <h1 class="amount"><small>{{general_setting()->cur_sym}}</small>{{number_format($package->price,2)}}</h1>
                    <p class="font-weight-bold text-muted">Can post jobs : {{$package->num_of_listing}}</p>
                    <p class="font-weight-bold text-muted">Package Duration : {{$package->days}} Days</p>
                </div>
                <div class="card-body p-1">
                    <a class="btn  btn-square btn-tsk btn-block font-weight-bold buy_now" data-id="{{$package->id}}" data-toggle="modal" data-target=".gateway">Buy Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <!-- Modal -->
    <div class="modal fade gateway" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Choose Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach($gateway as $key=>$gateway_v)
                        <div class="col-md-3 mb-3">
                            <div class="card border-tsk">
                                <div class="card-body  text-tsk p-0 pt-2">
                                    <h6 class="text-center font-weight-bold">{{$gateway_v->name}}</h6>
                                </div>
                                <div class="card-body p-0">
                                    <img src="{{asset('assets/backend/image/gateway/'.$gateway_v->id.'.jpg')}}" class="img-fluid">
                                </div>
                                <div class="card-body p-1">
                                    <a class="btn btn-tsk btn-square btn-block font-weight-bold" onclick="paymentNow('{{$gateway_v->id}}')">Payment Now</a>
                                </div>
                            </div>
                        </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="payment_now_form" method="post" action="{{route('employer.payment.data-insert')}}">@csrf
        <input type="hidden" name="plan" value="1" id="plan_id">
        <input type="hidden" name="gateway" value="" id="gateway_id">
    </form>
@endsection
@section('script')
    <script>
        function paymentNow(gateway_id){
            $('#gateway_id').val(gateway_id);
            $('#payment_now_form').submit();
        }
        $(document).ready(function () {
            $(document).on('click','.buy_now',function () {
                $('#plan_id').val($(this).data('id'));
            })
        })
    </script>
    @endsection
