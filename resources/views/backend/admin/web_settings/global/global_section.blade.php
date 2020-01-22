
@extends('backend.master')
@section('title',ucfirst(str_replace('-',' ',$section)))
@section('content')
    <div class="card  mb-4">
        <div class="card-header bg-white">
            <h2><i class="fa fa-hand-o-right "></i> {{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small></h2>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form action="{{route('admin.web_setting.section.store',['global','global_section'])}}" method="post" enctype="multipart/form-data">@csrf
                      <div class="lead">Contact Page</div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="contact_title" value="{{web_setting()->global_global_section_contact_title}}">
                        </div>
                        <div class="form-group">
                            <label for="contact_image">Image</label>
                            <div class="img-responsive">
                                <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/contact_image.png')}}" style="height: 100px">
                            </div>
                            <label for="contact_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(png)</small></label>
                            <input type="file"  id="contact_image" name="contact_image[png]" class="d-none">
                        </div>

                        <div class="lead">Login Page</div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="login_title" value="{{web_setting()->global_global_section_login_title}}">
                        </div>
                        <div class="form-group">
                            <label for="title">Sub Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="login_sub_title" value="{{web_setting()->global_global_section_login_sub_title}}">
                        </div>
                        <div class="form-group">
                            <label for="login_image">Image</label>
                            <div class="img-responsive">
                                <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/login_image.png')}}" style="height: 100px">
                            </div>
                            <label for="login_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(png)</small></label>
                            <input type="file"  id="login_image" name="login_image[png]" class="d-none">
                        </div>

                        <div class="lead">Register Page</div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="register_title" value="{{web_setting()->global_global_section_register_title}}">
                        </div>
                        <div class="form-group">
                            <label for="title">Sub Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="register_sub_title" value="{{web_setting()->global_global_section_register_sub_title}}">
                        </div>
                        <div class="form-group">
                            <label for="register_image">Image</label>
                            <div class="img-responsive">
                                <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/register_image.png')}}" style="height: 100px">
                            </div>
                            <label for="register_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(png)</small></label>
                            <input type="file"  id="register_image" name="register_image[png]" class="d-none">
                        </div>

                        <div class="lead">Password Reset Page</div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="password_title" value="{{web_setting()->global_global_section_password_title}}">
                        </div>
                        <div class="form-group">
                            <label for="title">Sub Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="password_sub_title" value="{{web_setting()->global_global_section_password_sub_title}}">
                        </div>
                        <div class="form-group">
                            <label for="password_image">Image</label>
                            <div class="img-responsive">
                                <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/password_image.png')}}" style="height: 100px">
                            </div>
                            <label for="password_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(png)</small></label>
                            <input type="file"  id="password_image" name="password_image[png]" class="d-none">
                        </div>

                        <div class="lead">Email Verification Page</div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="email_v_title" value="{{web_setting()->global_global_section_email_v_title}}">
                        </div>
                        <div class="form-group">
                            <label for="title">Sub Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="email_v_sub_title" value="{{web_setting()->global_global_section_email_v_sub_title}}">
                        </div>
                        <div class="form-group">
                            <label for="email_v_image">Image</label>
                            <div class="img-responsive">
                                <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/email_v_image.png')}}" style="height: 100px">
                            </div>
                            <label for="email_v_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(png)</small></label>
                            <input type="file"  id="email_v_image" name="email_v_image[png]" class="d-none">
                        </div>
                        <div class="lead">SMS Verification Page</div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="sms_v_title" value="{{web_setting()->home_about_section_title}}">
                        </div>
                        <div class="form-group">
                            <label for="title">Sub Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="sms_v_sub_title" value="{{web_setting()->home_about_section_title}}">
                        </div>
                        <div class="form-group">
                            <label for="sms_v_image">Image</label>
                            <div class="img-responsive">
                                <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/sms_v_image.png')}}" style="height: 100px">
                            </div>
                            <label for="sms_v_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(png)</small></label>
                            <input type="file"  id="sms_v_image" name="sms_v_image[png]" class="d-none">
                        </div>
                        <div class="form-group">
                            <hr/>
                            <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                            <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
 
@endsection