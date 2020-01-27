@extends('backend.master')

@section('title','Job Post')

@section('content')

<form action="{{ route('admin.job.store') }}" method="post">
    @csrf

        <div class="card ">

            <div class="card-body border-bottom">

                <h4>Job Details

                    <a href="" class="btn btn-square btn-tsk float-right font-weight-bold"><i class=" fa fa-edit"></i> Job List</a>



                </h4>

            </div>

            <div class="card-body">

                <div class="form-row">

                    <div class="form-group col-md">

                        <div class="input-group">

                            <input type="text" name="title" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="JOB TITLE" placeholder="JOB TITLE" value="">





                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Description" >

                        <textarea class="form-control"  rows="10"  id="description" name="description"></textarea>

                    </div>

                </div>

                <h4 class="text-muted">Location</h4>

                <hr/>

                <div class="form-row">

                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select Country">

                        <select type="text" class="form-control form-control-lg location " id="country" name="country_id" >

                            <option value="">Select Country</option>
                            <option value="1">Kenya</option>
                            

                           

                        </select>

                    </div>

                 

                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select City" >

                        <select type="text" class="form-control form-control-lg location" id="city" name="city_id">

                            <option value="">Select City</option>
                            <option value="1">Nairobi</option>

                          

                        </select>

                    </div>

                </div>

                {{-- <h4 class="text-muted">Salary Info</h4> --}}

                <hr/>

                {{-- <div class="form-row">

                    <div class="form-group col-md-4">

                        <div class="input-group">

                            <input type="text" name="salary_from" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Salary From" placeholder="Salary From" value="">



                            <input type="text" name="salary_to" class="form-control form-control-lg input-group-append" data-toggle="tooltip" data-placement="top" title="Salary To" placeholder="Salary To" value="">



                        </div>

                    </div>

                    <div class="form-group col-md-3">

                        <select type="text" name="currency_id" class="form-control form-control-lg select2" data-toggle="tooltip" data-placement="top" title="Currency">

                            <option value="">Select Currency</option>

                          

                        </select>

                    </div>

                    <div class="form-group col-md-3" data-toggle="tooltip" data-placement="top" title="Select Salary Period">

                        <select name="salary_period_id" type="text" class="form-control form-control-lg select2">

                            <option value="">Select Salary Period</option>

                         

                        </select>

                    </div>

                    <div class="form-group col-md-2 text-right">

                        <input  data-toggle="toggle" data-height="40" data-width="100%"  data-on="<i class='fa fa-eye-slash'></i> Salary Hide" data-off="<i class='fa fa-eye'></i> Salary Visible " data-onstyle="success" data-offstyle="info"  type="checkbox" name="salary_hide">



                    </div>





                </div> --}}

                <h4 class="text-muted">Other Info</h4>

                <hr/>

                <div class="form-row">

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Career Level">

                        <select name="career_level_id" type="text" class="form-control form-control-lg select2" >

                            {{-- <option value="">Select Career Level</option>
                            <option value="2">Entry Level</option>
                            <option value="3">Intern/Student</option>
                            <option value="1">Department Head</option>
                            <option value="4">Manager</option>
                            <option value="5">Officer</option> --}}

                            @foreach($attributes->getAttr('career_level') as $career_level)

                            <option value="{{$career_level->id}}" >{{$career_level->name}}</option>

                            @endforeach
                         

                          

                        </select>
                        {{-- <input class="form-control" name='career_level_' placeholder="enter the name" value="{{ old('title')}}"/> --}}

                    </div>

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Foundation Area">

                        <select name="functional_area_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Functional  Area</option>

                            @foreach($attributes->getAttr('functional_area') as $functional_area)

                                <option value="{{$functional_area->id}}" >{{$functional_area->name}}</option>

                            @endforeach
                            {{-- <option value="1">Accouting/Finance</option>
                            <option value="2">Production/Operation</option>
                            <option value="3">Human Resource</option> --}}

                        </select>

                    </div>

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Job Type">

                        <select name="job_type_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Job Type</option>

                            @foreach($attributes->getAttr('type') as $type)

                                <option value="{{$type->id}}" >{{ $type->name}}</option>

                            @endforeach
                            {{-- <option value="1">Contract </option>
                            <option value="2">Permanent Job </option>
                            <option value="3">Freelance </option> --}}

                        </select>

                    </div>

                    <!-- <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Job Shift">

                        <select name="job_shift_id" type="text" class="form-control form-control-lg select2" >

                         <option value="">Job Shift</option>

                            {{-- @foreach($attributes->getAttr('shift') as $shift)

                                <option value="" >{{$shift->name}}</option>

                            @endforeach --}}
                            <option value="1">Job Shift</option>
                            <option value="2">First Shift(Day)</option>

                        </select>

                    </div> -->

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Preference">

                        <select name="preference" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Gender Preference </option>

                            <option value="M">Male</option>

                            <option value="F" >Female</option>

                        </select>

                    </div>





                </div>

                <div class="form-row">

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Number Of Position">

                        <select name="number_of_position" type="text" class="form-control form-control-lg select2" >

                            <option value="">Number Of Position</option>

                            @foreach(range(1,30) as $position)

                                <option value="{{$position}}" {{$job->number_of_position === $position?'selected':''}}>{{$position}}</option>

                            @endforeach
                            {{-- <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="3">4</option>
                            <option value="3">5</option> --}}


                        </select>

                    </div>

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Job Expired Date">

                        <input name="expired_date" type="date" class="form-control form-control-lg" id="expired_date" placeholder="Job Expired Date (Year-Month-Day)" autocomplete="off" value="">

                    </div>
                    

                  <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Degree Level">

                        <select name="degree_level_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Required Degree Level</option>

                            @foreach($attributes->getAttr('degree_level') as $degree_level)

                                <option value="{{$degree_level->id}}" {{$job->degree_level_id === $degree_level->id?'selected':''}}>{{$degree_level->name}}</option>

                            @endforeach
                            {{-- <option value="1">Masters</option>
                            <option value="2">Undergraduate</option>
                            <option value="1">Certificate</option>
                            <option value="2">PhD</option> --}}

                        </select>

                    </div> 

                    


                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Job Experience">

                        <select name="experience_id" type="text" class="form-control form-control-lg select2" >

                            <option value="">Select Required Job Experience</option>

                            @foreach($attributes->getAttr('experience') as $experience)

                                <option value="{{$experience->id}}" {{$job->experience_id === $experience->id?'selected':''}}>{{$experience->name}}</option>

                            @endforeach 
                            {{-- <option value="1">Less than 1 year </option>
                            <option value="2">1 Year</option>
                            <option value="3">2 Years</option>
                            <option value="4">3 Years</option>
                            <option value="5">4 Years</option>
                            <option value="6">5 Years</option>
                            <option value="7">7 Years</option>
                            <option value="8">8 Years</option>
                            <option value="9">9 Years</option>

                            <option value="8">Above 10 years</option> --}}
                        </select>
                    </div>
                </div>

                <h4 class="text-muted">Skill</h4>

                <hr/>

                <div class="form-row">

                    <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Skills">

                         {{-- <select name="required_skill" type="text" class="form-control form-control-lg select2" multiple="" id="skill">

                            <option value="">Select Required Skills</option>

                            @foreach($attributes->getAttr('skills') as $skills)

                                <option value="{{$skills->id}}" >{{$skills->name}}</option>

                            @endforeach
                            

                        </select>  --}}
                        <textarea class="form-control" name="skills" id="" rows="3"></textarea>
                        <!-- <input type="text" id="" class="form-control" name="skills" placeholder="Enter Required Skills"> -->

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md">

                        <hr/>

                        <button type="submit" class="btn btn-tsk btn-square btn-block">Create Job <i class="fa fa-arrow-right"></i> </button>

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

        }).val(<php $job->skill->pluck('id') ?>).trigger('change');

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

