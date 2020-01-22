



@extends('backend.master')

@section('title','Dashboard')

@section('style')

    <link rel="stylesheet" href="{{asset('assets/plugin/morris/morris.css')}}">

@endsection

@section('content')

    <div class="card mb-3">

        <div class="card-header bg-white">

            <h3>DASHBOARD <small>STATISTICS</small></h3>

        </div>

        <div class="card-body">

            <div class="row mb-4">


                <div class="col-md" onclick="window.location.replace('{{route('admin.users')}}')">

                    <div class="d-flex border">

                        <div class="bg-primary text-light p-4">

                            <a href="" class="text-white">

                                <div class="d-flex align-items-center h-100">

                                    <i class="fa fa-3x fa-fw fa-user"></i>

                                </div>

                            </a>

                        </div>

                        <div class="flex-grow-1 bg-white p-4 w-100">

                            <p class="text-uppercase text-secondary mb-0 ">TOTAL SEEKER</p>

                            <h3 class="font-weight-bold mb-0">{{\App\Model\User::count()}}</h3>

                        </div>

                    </div>

                </div>

                <div class="col-md" onclick="window.location.replace('{{route('admin.job')}}')">

                    <div class="d-flex border">

                        <div class="bg-info text-light p-4">

                            <a href="" class="text-white">

                                <div class="d-flex align-items-center h-100">

                                    <i class="fa fa-3x fa-fw fa-briefcase"></i>

                                </div>

                            </a>

                        </div>

                        <div class="flex-grow-1 bg-white p-4 w-100">

                            <p class="text-uppercase text-secondary mb-0 ">TOTAL JOB POST</p>

                            <h3 class="font-weight-bold mb-0">{{\App\Model\PostJob::count()}}</h3>

                        </div>

                    </div>

                </div>
                <div class="col-md" onclick="window.location.replace('{{route('admin.job')}}')">

                    <div class="d-flex border">

                        <div class="bg-info text-light p-4">

                            <a href="" class="text-white">

                                <div class="d-flex align-items-center h-100">

                                    <i class="fa fa-3x fa-fw fa-black-tie"></i>

                                </div>

                            </a>

                        </div>

                        <div class="flex-grow-1 bg-white p-4 w-100">

                            <p class="text-uppercase text-secondary mb-0 ">TOTAL JOB APPLICANTS</p>

                            <h3 class="font-weight-bold mb-0">{{\App\Model\ApplyJob::count()}}</h3>

                        </div>

                    </div>

                </div>





            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card mb-4">

                <div class="card-header font-weight-bold bg-white">

                    <i class="fa fa-line-chart"></i>

                    MONTHLY STATISTICS

                </div>

                <div class="card-body p-0" id="appointment" style="height: 350px;">



                </div>

            </div>

        </div>

    </div>





@endsection

@section('script')

    <script src="{{asset('assets/plugin/morris/raphael-min.js')}}"></script>

    <script src="{{asset('assets/plugin/morris/morris.min.js')}}"></script>





    <script type="text/javascript">

        $(document).ready(function () {



            var months = <?php echo json_encode(array_values(month_arr()))?>;



            new Morris.Line({

                element: 'appointment',

                data: <?php echo $total_chart?>,

                xkey: 'month',

                ykeys: ['job_post','employer','seeker'],

                labels: ['JOB POST','EMPLOYER','JOB SEEKER'],

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