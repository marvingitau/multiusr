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


                        <form class="login-form mt-4" method="POST" action="{{ route('user.password.update',request()->user_type) }}">@csrf
                            <input type="hidden" name="token" value="{{ $reset->token }}">
                            @if ($errors->has('token'))
                                <small class="text-danger">{{ $errors->first('token') }}</small>
                            @endif
                            <div class="login-inner-block">
                                <div class="frm-grp">
                                    <i class="fa fa-envelope"></i>
                                    <input  type="email" name="email"   value="{{ old('email') }}" placeholder="Email.. ">
                                    @if ($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                                <div class="frm-grp">
                                    <i class="fa fa-lock"></i>
                                    <input  type="password" name="password"   placeholder="Password.. ">
                                    @if ($errors->has('password'))
                                        <small class="text-danger">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                                <div class="frm-grp">
                                    <i class="fa fa-lock"></i>
                                    <input  type="password" name="password_confirmation"    placeholder="Confirm Password.. ">
                                    @if ($errors->has('password_confirmation'))
                                        <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="btn-area text-center">
                                <button type="submit" class="submit-btn">Submit</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
