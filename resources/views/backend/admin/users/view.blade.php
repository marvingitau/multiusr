@extends('backend.master')

@section('title',$user->username)

@section('style')

    <link href="http://rowjat.thesoftking.com/highlow/assets/admin/css/bootstrap-fileinput.css" rel="stylesheet">



@endsection

@section('content')

    <div class="card mb-4 p-3">

        <h2>User information</h2>

        <h3>{{ $user->name }}</h3>

        <h5>Username: <b>{{ $user->username }}</b></h5>

    </div>

    <div class="card">

        <div class="card-header bg-white">

            <h3> <i class="fa fa-cogs"></i>Operations</h3>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col">

                    <a href="{{route('admin.email',$user->id)}}" class="btn btn-lg btn-block btn-primary"

                       style="margin-bottom:10px;">Send Email</a>

                </div>

                <div class="col">

                    <button type="button" class="btn btn-danger btn-lg btn-block"

                            data-toggle="modal" data-target="#changepass">Change Password

                    </button>

                </div>

            </div>

        </div>

    </div>



  <div class="row">



  </div>

    <div class="card mt-3">

        <div class="card-header bg-white">

            <h3>  <i class="fa fa-user"></i>Update Profile</h3>

        </div>

        <div class="card-body">







            <form id="form" method="POST" action="{{route('admin.user.details_update', $user->id)}}" enctype="multipart/form-data">@csrf

                <div class="form-row justify-content-center">

                    <div class="form-group col-md-4">

                        <label style="padding-bottom: 4px;" for="">Image

                            (Support jpg/jpeg/png only)</label>

                        <div class="fileinput @if(is_file('assets/backend/image/user/pic/'.$user->picture)) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">

                            <div class="fileinput-preview thumbnail img-thumb mb-2" data-trigger="fileinput"

                                 style="width: 300px; height: 150px;">

                                <img src="{{$user->picture_path()}}" >

                            </div>

                            <div>

                                                            <span class="btn btn btn-sm btn-tsk btn-file">

                                                                <span class="fileinput-new"><i class="fa fa-folder-open"></i> Select image </span>

                                                                <span class="fileinput-exists"> Change </span>

                                                                <input type="file" name="user_image"> </span>

                                <a href="javascript:;" class="btn btn-sm btn-outline-danger fileinput-exists" data-dismiss="fileinput">

                                    Remove </a>

                            </div>

                        </div>

                    </div>



                </div>

                <div class="form-row">

                    <div class="form-group col-md-3">

                        <label>First Name</label>

                        <input type="text" name="first_name" class="form-control form-control-lg"

                               value="{{$user->first_name}}">

                    </div>

                    <div class="form-group col-md-3">

                        <label>Last Name</label>

                        <input type="text" name="last_name" class="form-control form-control-lg"

                               value="{{$user->last_name}}">

                    </div>

                    <div class="form-group col-md-3">

                        <label>Phone</label>

                        <input type="text" name="phone" class="form-control form-control-lg"

                               value="{{$user->phone}}">

                    </div>

                    <div class="form-group col-md-3">

                        <label>Email</label>

                        <input type="email" name="email" class="form-control form-control-lg"

                               value="{{$user->email}}">

                    </div>

                    <div class="form-group col-md-4">

                        <label>User Status</label>

                        <input class="form-control" data-toggle="toggle" data-onstyle="success"

                               data-offstyle="danger" data-width="100%" data-on="Active"

                               data-off="Deactive" type="checkbox" value="1"

                               name="status" {{ $user->status == "1" ? 'checked' : '' }}>

                    </div>

                    <div class="form-group col-md-4">

                        <label>Email Verification</label>

                        <input class="form-control" data-toggle="toggle" data-onstyle="success"

                               data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No"

                               type="checkbox" value="1"

                               name="emailv" {{ $user->email_verified == "1" ? 'checked' : '' }}>

                    </div>

                    <div class="form-group col-md-4">

                        <label>SMS Verification</label>

                        <input class="form-control" data-toggle="toggle" data-onstyle="success"

                               data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No"

                               type="checkbox" value="1"

                               name="smsv" {{ $user->sms_verified == "1" ? 'checked' : '' }}>

                    </div>

                    <!--<div class="form-group">-->

                    <!--    <select name="userRole" type="text" class="form-control form-control-lg select2" >-->

                            
                    <!--        <option value="1" {{ ($user->role == 1) ? 'selected':'' }}>Normal user</option>-->
                    <!--        <option value="2" {{ ($user->role == 2) ? 'selected':'' }} >KMRC</option>-->
                    <!--        <option value="3" {{ ($user->role == 3) ? 'selected':'' }} >HR/Third party</option>-->



                           
                    <!--        {{-- <option value="1">Accouting/Finance</option>-->
                    <!--        <option value="2">Production/Operation</option>-->
                    <!--        <option value="3">Human Resource</option> --}}-->

                    <!--    </select>-->

                    <!--</div>-->


                </div>



                <hr/>

                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-check-circle"></i> Save</button>



            </form>

            <div class="row">



            </div>

        </div>

    </div>

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

                    <form role="form" method="POST" action="{{route('admin.user.passchange', $user->id)}}" >

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



                            <button type="submit" class="btn btn-primary btn-block">

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



