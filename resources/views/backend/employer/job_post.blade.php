

@extends('backend.employer.master')
@section('title','Job Post')
@section('content')
    <form action="{{route('employer.job_post.store')}}" method="post">@csrf
<div class="card ">
    <div class="card-body border-bottom">
        <h4>Job Details

        </h4>
    </div>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md">
                <label><small>Title</small></label>
                <div class="input-group">
                    <input type="text" name="title" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="JOB TITLE" placeholder="JOB TITLE">


                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Description" >
                <label><small>Description</small></label>
                <textarea class="form-control"  rows="10"  id="description" name="description"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Responsibility" >
                <label><small>Responsibility</small></label>
                <textarea class="form-control"  rows="10"  id="responsibility" name="responsibility"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Education Requirement" >
                <label><small>Education Requirement</small></label>
                <textarea class="form-control"  rows="10"  id="edu_requirement" name="edu_requirement"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Additional Requirement" >
                <label><small>Additional Requirement</small></label>
                <textarea class="form-control"  rows="10"  id="additional_requirement" name="additional_requirement"></textarea>
            </div>
        </div>
        <h4 class="text-muted">Location</h4>
        <hr/>
        <div class="form-row">
            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select Country">
                <select type="text" class="form-control form-control-lg location " id="country" name="country_id">
                    <option value="">Select Country</option>
                    @foreach($locations['country']['option'] as $country)
                        <option value="{{$country->id}}" {{$country->id === optional($locations['country']['selected'])->id?'selected':''}}>{{$country->full_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select State">
                <select type="text" class="form-control form-control-lg  location" id="state" name="state_id">
                    <option value="">Select State</option>
                    @foreach($locations['state']['option'] as $state)
                        <option value="{{$state->id}}" {{$state->id === optional($locations['state']['selected'])->id?'selected':''}}>{{$state->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select City" >
                <select type="text" class="form-control form-control-lg location" id="city" name="city_id">
                    <option value="">Select City</option>
                    @foreach($locations['city']['option'] as $city)
                        <option value="{{$city->id}}" {{$city->id === optional($locations['city']['selected'])->id?'selected':''}}>{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <h4 class="text-muted">Salary Info</h4>
        <hr/>
        <div class="form-row">
            <div class="form-group col-md-4">
                <div class="input-group">
                    <input type="text" name="salary_from" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Salary From" placeholder="Salary From">

                    <input type="text" name="salary_to" class="form-control form-control-lg input-group-append" data-toggle="tooltip" data-placement="top" title="Salary To" placeholder="Salary To">

                </div>
            </div>
            <div class="form-group col-md-3">
                <select type="text" name="" class="form-control form-control-lg select2" data-toggle="tooltip" data-placement="top" title="Currency">
                    <option value="currency_id">Select Currency</option>
                    @foreach($attributes->getAttr('currency') as $currency)
                        <option value="{{$currency->id}}" >{{$currency->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3" data-toggle="tooltip" data-placement="top" title="Select Salary Period">
                <select name="salary_period_id" type="text" class="form-control form-control-lg select2">
                    <option value="">Select Salary Period</option>
                    @foreach($attributes->getAttr('salary_periods') as $salary_periods)
                        <option value="{{$salary_periods->id}}" >{{$salary_periods->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 text-right">
                <input  data-toggle="toggle" data-height="40" data-width="100%" checked data-on="<i class='fa fa-eye-slash'></i> Salary Hide" data-off="<i class='fa fa-eye'></i> Salary Visible " data-onstyle="success" data-offstyle="info"  type="checkbox" name="salary_hide">

            </div>


        </div>
        <h4 class="text-muted">Other Info</h4>
        <hr/>
        <div class="form-row">
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Career Level">
                <select name="career_level_id" type="text" class="form-control form-control-lg select2" >
                    <option value="">Select Career Level</option>
                    @foreach($attributes->getAttr('career_level') as $career_level)
                        <option value="{{$career_level->id}}" >{{$career_level->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Foundation Area">
                <select name="functional_area_id" type="text" class="form-control form-control-lg select2" >
                    <option value="">Select Foundation Area</option>
                    @foreach($attributes->getAttr('functional_area') as $functional_area)
                        <option value="{{$functional_area->id}}" >{{$functional_area->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Job Type">
                <select name="job_type_id" type="text" class="form-control form-control-lg select2" >
                    <option value="">Select Job Type</option>
                    @foreach($attributes->getAttr('type') as $type)
                        <option value="{{$type->id}}" >{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Job Shift">
                <select name="job_shift_id" type="text" class="form-control form-control-lg select2" >
                    <option value="">Job Shift</option>
                    @foreach($attributes->getAttr('shift') as $shift)
                        <option value="{{$shift->id}}" >{{$shift->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Preference">
                <select name="preference" type="text" class="form-control form-control-lg select2" >
                    <option value="">Select Preference</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>


        </div>
        <div class="form-row">
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Number Of Position">
                <select name="number_of_position" type="text" class="form-control form-control-lg select2" >
                    <option value="">Number Of Position</option>
                    @foreach(range(1,30) as $position)
                        <option value="{{$position}}" >{{$position}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Job Expired Date">
                <input name="expired_date" type="text" class="form-control form-control-lg" id="expired_date" placeholder="Job Expired Date" autocomplete="off">
            </div>
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Degree Level">
                <select name="degree_level_id" type="text" class="form-control form-control-lg select2" >
                    <option value="">Select Required Degree Level</option>
                    @foreach($attributes->getAttr('degree_level') as $degree_level)
                        <option value="{{$degree_level->id}}" >{{$degree_level->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Job Experience">
                <select name="experience_id" type="text" class="form-control form-control-lg select2" >
                    <option value="">Select Required Job Experience</option>
                    @foreach($attributes->getAttr('experience') as $experience)
                        <option value="{{$experience->id}}" >{{$experience->name}}</option>
                    @endforeach
                </select>
            </div>


        </div>
        <h4 class="text-muted">Skill</h4>
        <hr/>
        <div class="form-row">
            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title="Required Skills">
                <select name="skill[]" type="text" class="form-control form-control-lg select2" multiple="">
                    <option value="">Select Required Skills</option>
                    @foreach($attributes->getAttr('skills') as $skills)
                        <option value="{{$skills->id}}" >{{$skills->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md">
                <hr/>
                <button type="submit" class="btn btn-tsk btn-square btn-block">Submit Job <i class="fa fa-arrow-right"></i> </button>
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
        });
        
    </script>
@endsection
