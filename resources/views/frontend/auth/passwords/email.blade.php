@extends('frontend.master')
@section('title','Reset Password')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'Reset Password','item'=>['Reset Password'=>null]])
    <section class="login-section--style2 padd-top-120 padd-bottom-120 gradient-bg-light">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-7">
                    <img src="{{asset('assets/frontend/img/global/global_section/password_image.png')}}" alt="image">
                </div>
                <div class="col-lg-4">
                    <div class="login-area">

                        <h2 class="title">{{web_setting()->global_global_section_password_title}}</h2>
                        <p>{{web_setting()->global_global_section_password_sub_title}}</p>

                        <form class="login-form mt-4" method="POST" action="{{ route('user.password.email') }}">@csrf
                            <input type="hidden" name="login_type" value="candidate" id="login_type">
                            <div class="login-inner-block">

                                <div class="frm-grp">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" name="email"   value="{{ old('email') }}" >
                                    @if ($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                    <label for="#0">email</label>
                                </div>
                                <div class="frm-grp">
                                    <i class="fa fa-user"></i>
                                    <select  name="user_type"   >
                                        <option value="candidate">Candidate</option>
                                        <option value="employee">Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="btn-area text-center">
                                <button type="submit" class="submit-btn"><i class="fa fa-send"></i>  Send Password Reset Link</button>
                            </div>
                        </form>
                        <div class="frm-group text-center py-4">

                            @if ($errors->has('resend'))
                                <small class="text-danger">{{ $errors->first('resend') }}</small>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
