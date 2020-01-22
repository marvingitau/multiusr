@extends('frontend.master')

@section('title','View Resume')

@section('content')

    @include('frontend.partials.breadcrumb',['title'=>'View Resume','item'=>['Dashboard'=>route('user.dashboard'),'View Resume'=>null]])

    <!-- job-details-section start  -->

    <div class="job-details-section pt-4 padd-bottom-120">

        <div class="container">

            <div class="row">

                <aside class="col-lg-4">

                  @include('frontend.users.sidebar')

                    <div class="text-center">

                        <?php echo show_ad(3) ?>



                    </div>



                </aside>

                <main class="col-lg-8">

                    <div class="inner-main-content">

                        <div class="row">

                            <div class="col ">

                                <h3 class="">

                                    <i class="fa fa-eye"></i> VIEW RESUME

                                </h3>

                            </div>

                        </div>

                        <div class="row cv mt-4">

                            

                            <div class="col-md-12 p-4 bg-white">

                                    <div class="row exp opt">

                                        <div class="col">

                                            <h6 class="opt-title"><i class="fa fa-briefcase"></i> Experience </h6>

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

                                            <h6 class="opt-title"><i class="fa fa-bar-chart"></i> Skills </h6>

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

                                        <h6 class="opt-title"><i class="fa fa-graduation-cap"></i> Educational Qualification </h6>

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

                                        <h6 class="opt-title"><i class="fa fa-language"></i> Language </h6>

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



                </main>



            </div>

        </div>

    </div>

    <!-- job-details-section end  -->





@endsection