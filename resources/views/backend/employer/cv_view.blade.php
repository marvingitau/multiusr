

@extends('backend.employer.master')
@section('title','View CV')
@section('content')
    <div class="card ">
        <div class="card-body border-bottom">
            <h3>View Resume</h3>
        </div>
      <div class="card-body cv">
            <div class="row">
                <div class="col-md-5 bg-light">
                    <div class="row">
                        <div class="col">
                            <div class="image">
                                <img src="{{$user->picture_path()}}" alt="...">
                            </div>
                            <h6>{{ucwords($user->full_name)}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <ul class="address">
                                <li><i class="icon fa fa-phone"></i> {{$user->phone}}</li>
                                <li><i class="icon fa fa-envelope"></i> {{$user->email}}</li>
                                <li><i class="icon fa fa-home"></i> {{$user->address}} ,</li>
                                <li class="space-left">{{implode(' , ',$user->address())}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col">
                            <h6 class="mb-3"><i class="fa fa-user"></i> Personal Information</h6>

                            <dl>
                                <dd>Father's Name</dd>
                                <dt>{{$user->father_name}}</dt>
                            </dl>
                            <dl>
                                <dd>Mother's Name</dd>
                                <dt>{{$user->mother_name}}</dt>
                            </dl>
                            <dl>
                                <dd>Gender</dd>
                                <dt>{{$user->sex()}}</dt>
                            </dl>
                            <dl>
                                <dd>Date of Birth</dd>
                                <dt>{{date('d/m/Y',strtotime($user->dob))}}</dt>
                            </dl>
                            <dl>
                                <dd>Nationality</dd>
                                <dt>{{$user->nationality}}</dt>
                            </dl>
                            <dl>
                                <dd>National Id No</dd>
                                <dt>{{$user->nid_no}}</dt>
                            </dl>
                            <dl>
                                <dd>Permanent Address</dd>
                                <dt>{{$user->permanent_address}}</dt>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 p-4 bg-white">
                    <div class="row exp opt">
                        <div class="col">
                            <h4 class="opt-title"><i class="fa fa-briefcase"></i> Experience </h4>
                            @forelse($user->cvExperience as $cvExperience)
                                <div class="exp_item">
                                    <p class="exp_title">{{$cvExperience->title}}</p>
                                    <p class="list">Experience : <strong>

                                            @php
                                                $diff = \Carbon\Carbon::parse($cvExperience->start_date)->diff($cvExperience->end_date?\Carbon\Carbon::parse($cvExperience->end_date):\Carbon\Carbon::now());
                                                $y = [];
                                               if($diff->y){
                                               $y[]=$diff->y;
                                               $y[]='Years';
                                               }
                                              $y[]=$diff->m;
                                               $y[]='Month';
                                            @endphp
                                            {{implode(' ',$y)}}

                                        </strong></p>
                                    <p class="list">Company : <strong> {{$cvExperience->company}}</strong></p>
                                </div>
                            @empty
                                <div class="exp_item">
                                    <p class="list">No Experience</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="row exp opt">
                        <div class="col">
                            <h4 class="opt-title"><i class="fa fa-bar-chart"></i> Skills </h4>
                            <ul class="mt-3">
                                @forelse($user->cvSkill as $cvSkill)
                                    <li>{{$cvSkill->skill->name}}</li> @empty
                                    <li>No Skill</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="row exp opt">
                        <div class="col">
                            <h4 class="opt-title"><i class="fa fa-graduation-cap"></i> Educational Qualification </h4>
                            @forelse($user->cvEducation as $cvEducation)
                                <div class="exp_item">
                                    <p class="exp_title">{{optional($cvEducation->degreeLevel)->name}} <small>( {{$cvEducation->degree_title}} )</small></p>
                                    <p class="list">Institute : <strong> {{$cvEducation->institute}}</strong></p>
                                    <p class="list">Pass Year : <strong>{{$cvEducation->passing_year?$cvEducation->passing_year:'Running'}}</strong></p>
                                    <p class="list">Concentration/Major : <strong>{{optional($cvEducation->major)->name}}</strong></p>
                                    <p class="list">Result : <strong>{{optional($cvEducation->resultType)->name}} :{{$cvEducation->result}} </strong></p>
                                </div>
                            @empty
                                <div class="exp_item">
                                    <p class="list">N/A</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="row exp opt">
                        <div class="col">
                            <h4 class="opt-title"><i class="fa fa-language"></i> Language </h4>
                            <div class="exp_item">
                                @forelse($user->cvLanguage as $cvLanguage)
                                    <p class="list">{{$cvLanguage->language->name}}  : <strong> {{$cvLanguage->languageLevel->name}} </strong></p>
                                @empty
                                    <p class="list">N/A</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
    </div>
@endsection
