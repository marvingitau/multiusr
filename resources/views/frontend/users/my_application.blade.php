@extends('frontend.master')

@section('title','My Application')

@section('content')

    @include('frontend.partials.breadcrumb',['title'=>'My Application','item'=>['Dashboard'=>route('user.dashboard'),'My Application'=>null]])

    <!-- job-details-section start  -->

    <div class="job-details-section pt-4 padd-bottom-120">

        <div class="container">

<div class="text-center mb-2 mt-2">

        <?php echo show_ad(4) ?>

    </div>

            <div class="row">

                <aside class="col-lg-4">

                  @include('frontend.users.sidebar')

                    <div class="text-center">

                         <?php echo show_ad(1) ?>

                    </div>



                </aside>

                <main class="col-lg-8">

                    <div class="inner-main-content">

                        <div class="row">

                            <div class="col">

                                <h3>

                                    <i class="fa fa-desktop"></i> My Application

                                    <div class="btn-group btn-group-sm float-md-right">

                                        {{-- <a href="{{route('user.application','monthly')}}" class="btn btn-outline-secondary {{active_menu([route('user.application','monthly')],'active')}}">Last One Month</a> --}}

                                        <a href="{{route('user.application')}}" class="btn btn-outline-secondary {{active_menu([route('user.application')],'active')}}">All Time</a>

                                    </div>

                                </h3>



                            </div>

                        </div>

                        <div class="row mt-4">



                            <div class="col">

                                <div class="table-responsive">

                                    <table class="table table-bordered">

                                        <thead>

                                        <tr>

                                            <th>SL</th>

                                            <th>Apply Date</th>

                                            <th>Job Title</th>

                                            {{-- <th class="text-center">Company View</th> --}}

                                        </tr>

                                        </thead>

                                        <tbody>

                                        @forelse($apps as $key=>$value)

                                            <tr>

                                                <td>{{$key+$apps->firstItem()}}</td> 

                                                <td>{{$value->created_at->format('F d, Y')}}</td>

                                                {{-- <td>{{ (($value->job)?$value->job->first():'')->id)?$value->job->first()->id:'' }}</td> --}}
                                                
                                                {{-- <td>{{$value->job()->first()->id }}</td> --}}
                                               
                                                
                                                @if($value->job != null)
                                                <td><a href="{{route('job.view',[$value->job()->first()->id ,str_slug($value->job()->first()->title )])}}">{{$value->job()->first()->title}}</a></td>
                                                @endif
                                                {{-- <td><a href="{{route('job.view',[($value->job)->id,str_slug(($value->job)->title)])}}">{{($value->job)->title}}</a></td> --}}


                                                {{-- <td class="text-center">{{$value->view?'YES':'NO'}}</td> --}}

                                            </tr>

                                        @empty

                                            <tr >

                                                <td colspan="4">

                                                    No Apply Job

                                                </td>

                                            </tr>

                                        @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col">

                                @include('frontend.partials.pagination',['pagination'=>$apps])

                            </div>

                        </div>

                    </div>

<div class="text-center mb-2 mt-2">

        <?php echo show_ad(2) ?>

    </div>



                </main>



            </div>

        </div>

    </div>

    <!-- job-details-section end  -->





@endsection