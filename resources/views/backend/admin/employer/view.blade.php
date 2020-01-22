@extends('backend.master')
@section('title',$employer->company_name)
@section('style')
    <link href="http://rowjat.thesoftking.com/highlow/assets/admin/css/bootstrap-fileinput.css" rel="stylesheet">

@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Employer information</h2>
            <h5>Company Name: {{ $employer->company_name }}</h5>
            <h5>Username: <b>{{ $employer->username }}</b></h5>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body border-bottom">
            <h3> <i class="fa fa-cogs"></i>Operations</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{route('admin.employer.email',$employer->id)}}" class="btn btn-lg btn-square btn-block btn-primary"
                       style="margin-bottom:10px;">Send Email</a>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger btn-square btn-lg btn-block"
                            data-toggle="modal" data-target="#changepass">Change Password
                    </button>
                </div>
            </div>
        </div>
    </div>



    <form action="{{route('admin.employer.details_update',$employer->id)}}" method="post" enctype="multipart/form-data">@csrf
        <div class="card mt-3">
            <div class="card-body border-bottom">
                <h4>Company Information
                </h4>
            </div>
            <div class="card-body">
                <div class="form-row ">
                    <div class="form-group col-md"  data-toggle="tooltip" data-placement="top" title="Status">
                        <input class="form-control" data-toggle="toggle" data-onstyle="success"
                               data-offstyle="danger" data-width="100%" data-on="Active"
                               data-off="Deactive" type="checkbox" value="1"
                               name="status" {{ $employer->status == "1" ? 'checked' : '' }}>
                    </div>
                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Featured">
                        <input class="form-control" data-on="Featured" data-off="Not Featured" data-toggle="toggle" data-onstyle="success"
                               data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No"
                               type="checkbox" value="1"
                               name="is_featured" {{ $employer->is_featured == "1" ? 'checked' : '' }}>
                    </div>

                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Subscribe">
                        <input class="form-control" data-on="Subscribe On" data-off="Subscribe Off" data-toggle="toggle" data-onstyle="success"
                               data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No"
                               type="checkbox" value="1"
                               name="subscribe" {{ $employer->subscribe == "1" ? 'checked' : '' }}>
                    </div>
                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Email Verification">
                        <input class="form-control" data-toggle="toggle" data-onstyle="success"
                               data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No"
                               type="checkbox" value="1"
                               name="email_verified" {{ $employer->email_verified == "1" ? 'checked' : '' }}>
                    </div>
                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="SMS Verification">
                        <input class="form-control" data-toggle="toggle" data-onstyle="success"
                               data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No"
                               type="checkbox" value="1"
                               name="sms_verified" {{ $employer->sms_verified == "1" ? 'checked' : '' }}>
                    </div>
                </div>
                <hr/>
                <div class="form-row">
                    <div class="form-group col-md-4  text-center bg-light p-3" style="height: 145px" data-toggle="tooltip" data-placement="top" title="Company Logo">
                        <div class="w-100" style="height: 90px">
                            <img src="{{$employer->company_logo()}}" class="img-thumbnail" style="height: 80px">
                        </div>
                        <input type="file" class="d-none" id="logo" name="company_logo">
                        <label for="logo" class="btn btn-sm btn-outline-tsk btn-block btn-square">Change Logo</label>
                    </div>
                    <div class="form-group col-md">
                        <div class="form-row">
                            <div class="form-group col-md">
                                <input type="text" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Company Name" placeholder="Company Name" name="company_name" value="{{$employer->company_name}}">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg bg-white" readonly data-toggle="tooltip" data-placement="top" title="Username" placeholder="Username" value="{{$employer->username}}">

                                </div>
                            </div>
                            <div class="form-group col-md">
                                <input type="text" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Company Email" placeholder="Company Email" name="email" value="{{$employer->email}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select Manufacture">
                                <select type="text" class="form-control form-control-lg select2" name="industry_id">
                                    <option value="">Select Manufacture</option>
                                    @foreach($attributes->getAttr('industry') as $industry)
                                        <option value="{{$industry->id}}" {{$employer->industry_id===$industry->id?'selected':''}}>{{$industry->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md"  data-toggle="tooltip" data-placement="top" title="Select Ownership">
                                <select type="text" class="form-control form-control-lg select2" name="ownership_type_id">
                                    <option value="">Select Ownership</option>
                                    @foreach($attributes->getAttr('ownership_types') as $ownership_types)
                                        <option value="{{$ownership_types->id}}" {{$employer->ownership_type_id===$ownership_types->id?'selected':''}}>{{$ownership_types->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Description">
                        <textarea class="form-control" name="description"  placeholder="Description" id="description"  rows="10">{{$employer->description}}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <textarea class="form-control form-control-lg" name="address" style="min-height: 90px" data-toggle="tooltip" data-placement="top" title="Address" placeholder="Address">{{$employer->address}}</textarea>


                                </div>
                            </div>
                        </div>
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
                    </div>
                    <div class="form-group col-md">
                        <div class="form-row">
                            <div class="form-group col-md">
                                <div class="input-group">
                                    <input type="number" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Number of office" placeholder="Number of office" name="number_of_office" value="{{$employer->number_of_office}}">

                                </div>
                            </div>
                            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select Num. of Employee">
                                <select type="text" class="form-control form-control-lg select2" name="number_of_employee_id">
                                    <option value="">Select Num. of Employee</option>
                                    @foreach($attributes->getAttr('number_of_employee') as $number_of_employee)
                                        <option value="{{$number_of_employee->id}}" {{$employer->number_of_employee_id===$number_of_employee->id?'selected':''}}>{{$number_of_employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Established in">
                                <select type="text" class="form-control form-control-lg select2" name="establish_year">
                                    <option value="">Established in</option>
                                    @foreach(range(date("Y"), 1910) as $year)
                                        <option value="{{$year}}" {{$employer->establish_year===$year?'selected':''}}>{{$year}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-fax"></i> </div>
                                    </div>
                                    <input type="text" name="fax" value="{{$employer->fax}}" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Fax" placeholder="Fax">

                                </div>
                            </div>
                            <div class="form-group col-md">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-phone"></i> </div>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="phone" value="{{$employer->phone}}" data-toggle="tooltip" data-placement="top" title="Phone" placeholder="Phone">

                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-globe"></i> </div>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="web" value="{{$employer->web}}" data-toggle="tooltip" data-placement="top" title="Website" placeholder="Website">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <div class="form-row">
                            <div class="form-group col-md">
                                <textarea class="form-control" data-toggle="tooltip" name="map_script" style="min-height: 208px" data-placement="top" title="Google Map Script" placeholder="Google Map Script">{{$employer->map_script}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md">
                        <hr/>
                        <button type="submit" class="btn btn-tsk btn-square btn-block">Update Profile <i class="fa fa-arrow-right"></i> </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!--Change Pass Modal -->
    <div id="changepass" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="text-indent: 0px;">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('admin.employer.passchange', $employer->id)}}" >
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>


                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-tsk btn-square btn-block">
                                <i class="fa fa-key"></i> Change Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="http://rowjat.thesoftking.com/highlow/assets/admin/js/bootstrap-fileinput.js"></script>
    <script type="text/javascript">

        $('#country').select2({width:'100%'});
        $('#state').select2({width:'100%'});
        $('#city').select2({width:'100%'});
        $(document).ready(function () {
            $(document).on('change','.location',function () {
                $.ajax({
                    url:'{{route('admin.location_change')}}',
                    data:{
                        'country_id':$('#country').val(),
                        'state_id':$('#state').val(),
                        'city_id':$('#city').val()
                    },
                    success:function (res) {
                        $('#country').empty().select2({
                            data: res.country,
                            width:'100%'
                        });
                        $('#state').empty().select2({
                            data: res.state,
                            width:'100%'
                        });
                        $('#city').empty().select2({
                            data: res.city,
                            width:'100%'
                        });
                    }
                });
            })
        })

       
    </script>
@endsection

