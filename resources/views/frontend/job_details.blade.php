@extends('frontend.master')

@section('title','Jobs')

@section('content')

    @include('frontend.partials.breadcrumb',['title'=>'Jobs-'.$job->title,'item'=>['Job Listing'=>route('job'),$job->title=>null]])

    <div class="text-center mb-2">

        {{--  echo show_ad(4) ?> --}}

    </div>

    <!-- job-details-section start  -->
    <div class="job-details-section pt-4 padd-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <h2 class="text-capitalize">{{ $job->title }}</h2>
                            <p class="d-block"><i class="fa fa-calendar"></i>&nbsp;Application Deadline &nbsp; <span class="badge badge-danger rounded-0">{{ $job->expired_date }}</span></p>
                            &nbsp; 
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">Description</td>
                                <td>{{ $job->description }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Required Skills</td>
                                <td>{{ $job->skills }}

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="aside">
                        <h4>Job Summary</h4>
                        <ul class="list-unstyled p-0 m-0">
                            <li><span><i class="fa fa-map-marker"></i> Location:</span>Nairobi</li>
                            <li><span><i class="fa fa-bar-chart-o"></i> Positions:</span>{{ $job->number_of_position  }}</li>
                            <li><span><i class="fa fa-calendar"></i> Deadline:</span>{{ $job->expired_date  }}</li>
                        </ul>
                        &nbsp; 
                        {{-- @if(is_null($newUserAlpha))
                        <a class="btn rounded-0 font-weight-bold text-white w-100 p-2" href="{{route('user.profile')}}">APPLY NOW </a>
                        @else --}}
<!-- 
                        <script>
                           alert('update cv & coverletter')
                        </script> -->
                        {{-- <a class="btn rounded-0 font-weight-bold text-white w-100 p-2" href="/user/apply-job/{{ $job->id }}">CONTINUE TO APPLY </a> --}}
                        <a class="btn rounded-0 font-weight-bold text-white w-100 p-2" href="{{ route('application.form',[$job->id]) }}"> APPLY </a>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job-details-section end  -->
@endsection