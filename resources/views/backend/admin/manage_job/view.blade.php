@extends('backend.master')

@section('title','Job View -'.$job->title)

@section('content')

    <div class="card ">

        <div class="card-body border-bottom">

            <h4 class="font-weight-bold m-0 text-tsk">

                {{$job->title}}

                <a href="{{route('admin.job.edit',$job->id)}}" class="btn btn-square btn-tsk float-right font-weight-bold"><i class=" fa fa-edit"></i> Edit</a>

            </h4>

            <p class="text-muted m-0">

                Date Posted:  {{$job->created_at->format('M d, Y')}}

            </p>

            <p class="text-muted font-weight-bold m-0">Monthly Salary: {{$job->salary_from}} {{optional($job->currency)->name}} - {{$job->salary_to}} {{optional($job->currency)->name}} <span class="border-left pl-2 text-tsk">

                      @if($job->salary_hide)

                        <i class="fa fa-eye-slash"></i> Salary Hide

                    @else

                        <i class="fa fa-eye"></i> Salary Visible

                    @endif

                </span></p>

        </div>

      <div class="card-body">

            <div class="row">

                <div class="col-md-8 ">
                    {{-- <button class="btn btn-link" href="#" >Create JOB</button> // el  --}}

                    <h3>Job Description</h3>

                    <hr/>

                    <p class="">{{$job->description}}</p>

                    <h3 class="mt-5">Skills Required</h3>

                    <hr/>

                    <p class="text-tsk font-weight-bold mb-5">

                        @foreach($job->skill as $skill_v)

                            <span class="{{$loop->last?'':'border-right'}} pr-2 ">{{$skill_v->name}}</span>

                        @endforeach

                    </p>

                    <h3>Candidate Details</h3>

                    <hr/>

                    <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">

                        <li class="nav-item pr-1">

                            <a class="btn btn-square btn-outline-tsk active font-weight-bold" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ALL</a>

                        </li>

                        <li class="nav-item pr-1">

                            <a class="btn btn-square btn-outline-tsk font-weight-bold" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">SHORT LIST</a>

                        </li>

                        <li class="nav-item pr-1" >

                            <a class="btn btn-square btn-outline-tsk font-weight-bold" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">SELECTED</a>

                        </li>

                    </ul>

                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <table class="table table-sm table-striped">

                                <thead class="bg-tsk text-white">

                                <tr>

                                    <th>SL.</th>

                                    <th>Name</th>

                                    <th>Email</th>

                                    <th>Phone</th>

                                    <th class="text-right">Action</th>

                                </tr>

                                </thead>

                                <tbody>

                                @forelse($job->applyJob()->latest()->get() as $key=>$applyJob)

                                    <tr>

                                        <td>1</td>

                                        <td>{{$applyJob->candidate->full_name}}</td>

                                        <td>{{$applyJob->candidate->email}}</td>

                                        <td>{{$applyJob->candidate->phone}}</td>

                                        <td class="text-right">

                                            <a class="btn btn-tsk btn-sm" href="{{route('admin.view-cv',[$applyJob->candidate->id])}}">

                                                <i class="fa fa-address-card"></i> VIEW CV

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5">No Candidate</td>

                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                            <table class="table table-sm table-striped">

                                <thead class="bg-tsk text-white">

                                <tr>

                                    <th>SL.</th>

                                    <th>Name</th>

                                    <th>Email</th>

                                    <th>Phone</th>

                                    <th class="text-right">Action</th>

                                </tr>

                                </thead>

                                <tbody>

                                @forelse($job->applyJob()->where('short_list',1)->latest()->get() as $key=>$applyJob)

                                    <tr>

                                        <td>1</td>

                                        <td>{{$applyJob->candidate->full_name}}</td>

                                        <td>{{$applyJob->candidate->email}}</td>

                                        <td>{{$applyJob->candidate->phone}}</td>

                                        <td class="text-right">

                                            <a class="btn btn-tsk btn-sm" href="{{route('admin.view-cv',[$applyJob->candidate->id])}}">

                                                <i class="fa fa-address-card"></i> VIEW CV

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5">No Short list Candidate</td>

                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>

                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                            <table class="table table-sm table-striped">

                                <thead class="bg-tsk text-white">

                                <tr>

                                    <th>SL.</th>

                                    <th>Name</th>

                                    <th>Email</th>

                                    <th>Phone</th>

                                    <th class="text-right">Action</th>

                                </tr>

                                </thead>

                                <tbody>

                                @forelse($job->applyJob()->latest()->where('selected',1)->get() as $key=>$applyJob)

                                    <tr>

                                        <td>1</td>

                                        <td>{{$applyJob->candidate->full_name}}</td>

                                        <td>{{$applyJob->candidate->email}}</td>

                                        <td>{{$applyJob->candidate->phone}}</td>

                                        <td class="text-right">

                                            <a class="btn btn-tsk btn-sm" href="{{route('admin.view-cv',[$applyJob->candidate->id])}}">

                                                <i class="fa fa-address-card"></i> VIEW CV

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5">No Selected Candidate</td>

                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 bg-light">

                    <h3>Job Details</h3>

                    <hr/>

                    <table class="font-weight-bold text-muted w-100">

                        {{-- <tr><td class="align-top " width="150"><i class="fa fa-map-marker"></i> Location</td><td class="text-right pb-3 align-top">{{$job->employer->address}}</td></tr> --}}

                        <tr><td class="align-top"><?php echo \App\Model\JobAttributs::types()['type']['icon'] ?> Type</td><td class="text-right pb-3 align-top">{{optional($job->type)->name}}</td></tr>

                        {{-- <tr><td class="align-top">< echo \App\Model\JobAttributs::types()['shift']['icon'] ?> Shift</td><td class="text-right pb-3 align-top">{{optional($job->shift)->name}}</td></tr> --}}

                        <tr><td class="align-top"><?php echo \App\Model\JobAttributs::types()['career_level']['icon'] ?> Career Level</td><td class="text-right pb-3 align-top">{{optional($job->career_level)->name}}</td></tr>

                        <tr><td class="align-top"><i class="fa fa-line-chart"></i> Positions</td><td class="text-right pb-3 align-top">{{$job->number_of_position}}</td></tr>

                        <tr><td class="align-top"><?php echo \App\Model\JobAttributs::types()['experience']['icon'] ?> Experience</td><td class="text-right pb-3 align-top">{{optional($job->experience)->name}}</td></tr>

                        <tr><td class="align-top"><i class="fa fa-mars-double"></i> Gender</td><td class="text-right pb-3 align-top">{{$job->preferences()}}</td></tr>

                        <tr><td class="align-top"><?php echo \App\Model\JobAttributs::types()['degree_level']['icon'] ?> Degree</td><td class="text-right pb-3 align-top">{{optional($job->degree_level)->name}}</td></tr>

                        <tr><td class="align-top"><i class="fa fa-calendar"></i> Apply Before</td><td class="text-right pb-3 align-top">{{\Carbon\Carbon::parse($job->expired_date)->format('M d, Y')}}</td></tr>

                        <tr><td class="align-top" colspan="2">



                            </td></tr>

                    </table>

                    <h3>Google Map</h3>

                    <hr/>

                    {{-- <div class="text-center"> --}}
                    
                    {{-- echo $job->employer->map_script --}}
                  
                    {{-- </div> --}}

                </div>

            </div>

      </div>

    </div>

@endsection

