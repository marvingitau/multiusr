@extends('backend.master')

@section('title','Job Post')

@section('content')

    <form action="{{route('admin.job.update',$job->id)}}" method="post">@csrf

        <div class="card ">

            <div class="card-body border-bottom">

                <h4>Job Details

                    <a href="{{route('admin.job',$job->id)}}" class="btn btn-square btn-tsk float-right font-weight-bold"><i class=" fa fa-edit"></i> Job List</a>



                </h4>

            </div>

            <div class="card-body">

                <div class="form-row">

                    <div class="form-group col-md">

                        <div class="input-group">

                            <input type="text" name="title" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="JOB TITLE" placeholder="JOB TITLE" value="{{$job->title}}">





                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Description" >

                        <textarea class="form-control"  rows="10"  id="description" name="description">{{$job->description}}</textarea>

                    </div>

                </div>

                <h4 class="text-muted">Location</h4>

                <hr/>

                <div class="form-row">

                    {{-- <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select Country">

                        <select type="text" class="form-control form-control-lg location " id="country" name="country_id" >

                            <option value="">Select Country</option>

                            @foreach($locations['country']['option'] as $country)

                                <option value="{{$country->id}}" {{$country->id === optional($locations['country']['selected'])->id?'selected':''}}>{{$country->full_name}}</option>

                            @endforeach

                        </select>

                    </div> --}}

                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select State">

                        <select type="text" class="form-control form-control-lg  location" id="state" name="state_id">

                            <option value="1">Kenya</option>

                          {{-- @foreach($locations['state']['option'] as $state)

                                <option value="{{$state->id}}" {{$state->id === optional($locations['state']['selected'])->id?'selected':''}}>{{$state->name}}</option>

                            @endforeach --}}


                        </select>

                    </div>

                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select City" >

                        <select type="text" class="form-control form-control-lg location" id="city" name="city_id">

                            <option value="1">Nairobi</option>
                            {{-- <option value="2">Thika</option> --}}

                            {{-- @foreach($locations['city']['option'] as $city)

                                <option value="{{$city->id}}" {{$city->id === optional($locations['city']['selected'])->id?'selected':''}}>{{$city->name}}</option>

                            @endforeach  --}}

                        </select>

                    </div>

                </div>

                <h4 class="text-muted">Salary Info</h4>

                <hr/>

                <div class="form-row">

                    <div class="form-group col-md-4">

                        <div class="input-group">

                            <input type="text" name="salary_from" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Salary From" placeholder="Salary From" value="{{$job->salary_from}}">



                            <input type="text" name="salary_to" class="form-control form-control-lg input-group-append" data-toggle="tooltip" data-placement="top" title="Salary To" placeholder="Salary To" value="{{$job->salary_to}}">



                        </div>

                    </div>

                    <div class="form-group col-md-3">

                        <select type="text" name="currency_id" class="form-control form-control-lg select2" data-toggle="tooltip" data-placement="top" title="Currency">

                            <option value="1">KSH</option>

                                {{-- <!-- @foreach($attributes->getAttr('currency') as $currency)

                                    <option value="{{$currency->id}}" {{$job->currency_id === $currency->id?'selected':''}}>{{$currency->name}}</option>

                                @endforeach --> --}}

                        </select>

                    </div>

                  {{-- <div class="form-group col-md-3" data-toggle="tooltip" data-placement="top" title="Select Salary Period">

                        <select name="salary_period_id" type="text" class="form-control form-control-lg select2">

                          <option value="">Select Salary Period</option>
                            <option value=""></option> 

                           @foreach($attributes->getAttr('salary_periods') as $salary_periods)

                                <option value="{{$salary_periods->id}}" {{$job->salary_period_id === $salary_periods->id?'selected':''}}>{{$salary_periods->name}}</option>

                            @endforeach

                        </select>

                    </div>  --}}

                    <div class="form-group col-md-2 text-right">

                        <input  data-toggle="toggle" data-height="40" data-width="100%" {{$job->salary_hide?'checked':''}} data-on="<i class='fa fa-eye-slash'></i> Salary Hide" data-off="<i class='fa fa-eye'></i> Salary Visible " data-onstyle="success" data-offstyle="info"  type="checkbox" name="salary_hide">



                    </div>





                </div>

                <h4 class="text-muted">Other Info</h4>

                <hr/>

                <div class="form-row">

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Career Level">

                        <select name="career_level_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Career Level</option>

                            @foreach($attributes->getAttr('career_level') as $career_level)

                                <option value="{{$career_level->id}}" {{$job->career_level_id == $career_level->id?'selected':''}}>{{$career_level->name}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Foundation Area">

                        <select name="functional_area_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Functional  Area</option>

                            @foreach($attributes->getAttr('functional_area') as $functional_area)

                                <option value="{{$functional_area->id}}" {{$job->functional_area_id == $functional_area->id?'selected':''}}>{{$functional_area->name}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Job Type">

                        <select name="job_type_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Job Type</option>

                            @foreach($attributes->getAttr('type') as $type)

                                <option value="{{$type->id}}" {{$job->job_type_id == $type->id?'selected':''}}>{{$type->name}}</option>

                            @endforeach

                        </select>

                    </div>

                    {{-- <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Job Shift">

                        <select name="job_shift_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Job Shift</option>

                            @foreach($attributes->getAttr('shift') as $shift)

                                <option value="{{$shift->id}}" {{$job->job_shift_id == $shift->id?'selected':''}}>{{$shift->name}}</option>

                            @endforeach

                        </select>

                    </div> --}}

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Preference">

                        <select name="preference" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Preference</option>

                            <option value="M" {{$job->preference === 'M'?'selected':''}}>Male</option>

                            <option value="F" {{$job->preference === 'F'?'selected':''}}>Female</option>

                        </select>

                    </div>





                </div>

                <div class="form-row">

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Number Of Position">

                        <select name="number_of_position" type="text" class="form-control form-control-lg select2" >

                            <option value="">Number Of Position</option>

                            @foreach(range(1,30) as $position)

                                <option value="{{$position}}" {{$job->number_of_position == $position?'selected':''}}>{{$position}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Job Expired Date">

                        <input name="expired_date" type="text" class="form-control form-control-lg" id="expired_date" placeholder="Job Expired Date" autocomplete="off" value="{{$job->expired_date}}">

                    </div>

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Degree Level">

                        <select name="degree_level_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Required Degree Level</option>

                            @foreach($attributes->getAttr('degree_level') as $degree_level)

                                <option value="{{$degree_level->id}}" {{$job->degree_level_id == $degree_level->id?'selected':''}}>{{$degree_level->name}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Job Experience">

                        <select name="experience_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Required Job Experience</option>

                            @foreach($attributes->getAttr('experience') as $experience)

                                <option value="{{$experience->id}}" {{$job->experience_id == $experience->id?'selected':''}}>{{$experience->name}}</option>

                            @endforeach

                        </select>

                    </div>





                </div>

                <!-- <h4 class="text-muted">Skill</h4>

                <hr/>

                <div class="form-row">

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Skills">

                        <select name="skill[]" type="text" class="form-control form-control-lg" multiple="" id="skill">

                            <option value="">Select Required Skills</option>

                            @foreach($attributes->getAttr('skills') as $skills)

                                <option value="{{$skills->id}}" >{{$skills->name}}</option>

                            @endforeach

                        </select>

                    </div>

                </div> -->
                <h4 class="text-muted">Skill</h4>

                    <hr/>

                    <div class="form-row">

                        <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Skills">

                            <!-- <select name="required_skill" type="text" class="form-control form-control-lg" multiple="" id="skill">

                                <option value="">Select Required Skills</option>

                                {{-- @foreach($attributes->getAttr('skills') as $skills)

                                    <option value="{{$skills->id}}" >{{$skills->name}}</option>

                                @endforeach --}}
                                

                            </select> -->
                            <textarea class="form-control" name="skills" id="" rows="3"></textarea>
                            <!-- <input type="text" id="" class="form-control" name="skills" placeholder="Enter Required Skills"> -->

                        </div>

                    </div>


                <div class="form-row">

                    <div class="form-group col-md">

                        <hr/>

                        <button type="submit" class="btn btn-tsk btn-square btn-block">Update Job <i class="fa fa-arrow-right"></i> </button>

                    </div>

                </div>

            </div>

        </div>



    </form>

@endsection

@section('script')

    <script type="text/javascript">

        $('#country').select2({

            width:'100%',

        });

        $('#state').select2({

            width:'100%',

        });

        $('#city').select2({

            width:'100%',

        });

        $('#skill').select2({

            width:'100%',

        });

        $('#skill').select2({

            width:'100%',

        }).val(<?php $job->skill->pluck('id') ?>).trigger('change');

        $(document).ready(function () {

            $('#expired_date').datepicker({

                dateFormat:'yy-mm-dd',

                changeMonth: true,

                changeYear: true

            });

            $(document).on('change','.location',function () {

                $.ajax({

                    url:'{{route('employer.location_change')}}',

                    data:{

                        'country_id':$('#country').val(),

                        'state_id':$('#state').val(),

                        'city_id':$('#city').val()

                    },

                    success:function (res) {

                        $('#country').empty().select2({

                            width:'100%',

                            data: res.country

                        });

                        $('#state').empty().select2({

                            width:'100%',

                            data: res.state

                        });

                        $('#city').empty().select2({

                            width:'100%',

                            data: res.city

                        });

                    }

                });

            })

        })

     

    </script>

@endsection

