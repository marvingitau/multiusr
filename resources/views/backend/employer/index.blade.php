

@extends('backend.employer.master')
@section('title','Dashboard')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/plugin/morris/morris.css')}}">
@endsection
@section('content')

    <h3 class="mb-4">DASHBOARD   <small>STATISTICS</small></h3>

    <div class="row mb-4">
        <div class="col-md" onclick="Javascript:window.location.replace('{{route('employer.job_list')}}')">
            <div class="d-flex border">
                <div class="bg-info text-light p-4">
                    <a href="" class="text-white">
                        <div class="d-flex align-items-center h-100">
                            <i class="fa fa-3x fa-fw fa-briefcase"></i>
                        </div>
                    </a>
                </div>
                <div class="flex-grow-1 bg-white p-4 w-100">
                    <p class="text-uppercase text-secondary mb-0 ">POST JOB</p>
                    <h3 class="font-weight-bold mb-0">{{$statistics['job_post']}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-info text-light p-4">
                    <a href="" class="text-white">
                        <div class="d-flex align-items-center h-100">
                            <i class="fa fa-3x fa-fw fa-send"></i>
                        </div>
                    </a>
                </div>
                <div class="flex-grow-1 bg-white p-4 w-100">
                    <p class="text-uppercase text-secondary mb-0 ">APPLY</p>
                    <h3 class="font-weight-bold mb-0">{{$statistics['apply']}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-info text-light p-4">
                    <a href="" class="text-white">
                        <div class="d-flex align-items-center h-100">
                            <i class="fa fa-3x fa-fw fa-user"></i>
                        </div>
                    </a>
                </div>
                <div class="flex-grow-1 bg-white p-4 w-100">
                    <p class="text-uppercase text-secondary mb-0 ">CANDIDATE</p>
                    <h3 class="font-weight-bold mb-0">{{$statistics['candidate']}}</h3>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-3">

        <div class="col-md-8">
            <div class="card  mb-4">
                <div class="card-header font-weight-bold bg-white  border-radius-0">
                    <i class="fa fa-line-chart"></i>
                    MONTHLY POST JOB
                </div>
                <div class="card-body p-0" id="bid" style="height: 350px;">

                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card bg-tsk text-light text-uppercase">
                <div class="card-body py-5">
                    <h5 class="mt-2 mb-0"><strong class="text-{{$employee->isSupExpired()?'danger':'muted'}}">{{$employee->isSupExpired()?'Expired':$employee->membership_expired}}</strong></h5>
                    <p class="mb-4">Subscribe Expire</p>

                    <h5 class="mt-2 mb-0 text-muted">{{$employee->remaining_job}}</h5>
                    <p class="mb-4">Remaining Job</p>

                    <h5 class="mt-2 mb-0 text-muted">{{$employee->currentPackage()?$employee->currentPackage()->package->title:'No Package yet'}}</h5>
                    <p class="mb-0">Current Package</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-white font-weight-bold">
                    <i class="fa fa-line-chart"></i>
                    UPGRADE
                </div>
                <div class="card-body">
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
                </div>
            </div>

        </div>
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
    <script src="{{asset('assets/plugin/morris/raphael-min.js')}}"></script>
    <script src="{{asset('assets/plugin/morris/morris.min.js')}}"></script>


    <script type="text/javascript">
        function paymentNow(gateway_id){
            $('#gateway_id').val(gateway_id);
            $('#payment_now_form').submit();
        }
        $(document).ready(function () {
            $(document).on('click','.buy_now',function () {
                $('#plan_id').val($(this).data('id'));
            });
            var months = <?php echo json_encode(array_values(month_arr()))?>;

            new Morris.Line({
                element: 'bid',
                data: <?php echo $total_chart?>,
                xkey: 'month',
                ykeys: ['post'],
                labels: ['POST'],
                xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
                    var month = months[x.getMonth()];
                    return month;
                },
                dateFormat: function(x) {
                    var month = months[new Date(x).getMonth()];
                    return month;
                },
            });
        });
    </script>
@endsection