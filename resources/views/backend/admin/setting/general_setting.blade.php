@extends('backend.master')
@section('title',"General Setting")
@section('content')
    <div class="card  mb-4">
        <div class="card-header bg-white">
            <h5>General Setting</h5>
        </div>
        <div class="card-body">
            <form role="form" method="post" action="{{route('backend.admin.general_setting.update')}}" enctype="multipart/form-data">
                @csrf


                <div class="form-group row pt-5">
                    <div class="col-md">
                        <label class=""><small>TITLE</small></label>
                        <input type="text" class="form-control form-control-lg" value="{{general_setting()->title}}"  name="title">

                    </div>
                    <div class="col-md">
                        <label class=""><small> COLOR CODE</small></label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-tsk">#</div>
                            </div>
                            <input type="text" class="form-control form-control-lg"  value="{{general_setting()->color}}"  name="color">
                        </div>

                    </div>
                    <div class="col-md">
                        <label class=""><small>CURRENCY</small></label>
                        <input type="text" class="form-control form-control-lg "  value="{{general_setting()->cur}}"  name="cur">

                    </div>
                    <div class="col-md">
                        <label class=""><small>CURRENCY SYMBOL</small></label>
                        <input type="text" class="form-control form-control-lg "  value="{{general_setting()->cur_sym}}"  name="cur_sym">

                    </div>
                </div>
                <hr/>
                <h6 class="pt-5">Social Login</h6>
                <div class="form-group row ">
                    <div class="col-md">
                        <label class=""><small>Facebook Login</small></label>
                        <input data-toggle="toggle" {{!general_setting()->fb_login?:'checked'}} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="fb_login">
                    </div>
                    <div class="col-md">
                        <label class=""><small>Facebook Client Id</small></label>
                        <input type="text" class="form-control form-control-lg" value="{{general_setting()->fb_client_id}}"  name="fb_client_id">

                    </div>
                    <div class="col-md">
                        <label class=""><small> Facebook Client Secret</small></label>
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control form-control-lg"  value="{{general_setting()->fb_client_secret}}"  name="fb_client_secret">
                        </div>

                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-md">
                        <label class=""><small>Google Login</small></label>
                        <input data-toggle="toggle" {{!general_setting()->google_login?:'checked'}} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="google_login">
                    </div>
                    <div class="col-md">
                        <label class=""><small>Google Client Id</small></label>
                        <input type="text" class="form-control form-control-lg" value="{{general_setting()->google_client_id}}"  name="google_client_id">

                    </div>
                    <div class="col-md">
                        <label class=""><small> Google Client Secret</small></label>
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control form-control-lg"  value="{{general_setting()->google_client_secret}}"  name="google_client_secret">
                        </div>

                    </div>
                </div>
                <hr/>
                <div class="form-group row pt-5 mb-5">
                    <div class="col-md">
                        <label class=""><small>EMAIL NOTIFICATION</small></label>
                        <input data-toggle="toggle" {{!general_setting()->en?:'checked'}} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="en">

                    </div>
                    <div class="col-md">
                        <label class=""><small>EMAIL VERIFICATION</small></label>
                        <input data-toggle="toggle" {{!general_setting()->ev?:'checked'}} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="ev">

                    </div>
                    <div class="col-md">
                        <label class=""><small>SMS NOTIFICATION</small></label>
                        <input data-toggle="toggle" {{!general_setting()->mn?:'checked'}} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="mn">

                    </div>
                    <div class="col-md">
                        <label class=""><small>SMS VERIFICATION</small></label>
                        <input data-toggle="toggle" {{!general_setting()->mv?:'checked'}} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="mv">

                    </div>
                    <div class="col-md">
                        <label class=""><small>REGISTRATION</small></label>
                        <input data-toggle="toggle" {{!general_setting()->reg?:'checked'}} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="reg">

                    </div>
                </div>
                <hr/>
                <div class="row mt-5">
                    <div class="col-md-12 ">
                        <button class="btn btn-lg btn-tsk btn-block" >Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    @endsection