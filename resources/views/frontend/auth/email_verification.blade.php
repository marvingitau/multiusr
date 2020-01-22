
@extends('frontend.master')
@section('title','Email verification form')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'Email verification form','item'=>['Email verification form'=>null]])

    <section class="login-section--style2 padd-top-120 padd-bottom-120 gradient-bg-light">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-7">
                    <img src="{{asset('assets/frontend/img/global/global_section/email_v_image.png')}}" alt="image">
                </div>
                <div class="col-lg-4">
                    <div class="login-area">

                        <h2 class="title">{{web_setting()->global_global_section_email_v_title}}</h2>
                        <p>{{web_setting()->global_global_section_email_v_sub_title}}</p>

                        <form class="login-form mt-4" method="POST" action="{{ route('user.email-verify') }}">@csrf
                            <input type="hidden" name="login_type" value="candidate" id="login_type">
                            <div class="login-inner-block">
                                <div class="frm-grp">
                                    <i class="fa fa-envelope"></i>
                                    <input type="hidden" name="email"   value="{{auth()->guard(get_auth_guard())->user()->email}}" >
                                    <input type="email"  readonly >

                                    <label for="#0">{{auth()->guard(get_auth_guard())->user()->email}}</label>
                                </div>
                                <div class="frm-grp">
                                    <i class="fa fa-lock"></i>
                                    <input type="text" name="email_verified_code"  required>
                                    <label for="#0">Code</label>
                                    @if ($errors->has('email_verified_code'))
                                        <small class="text-danger">{{ $errors->first('email_verified_code') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="btn-area text-center">
                                <button type="submit" class="submit-btn">Submit</button>
                            </div>
                        </form>
                        <div class="frm-group text-center py-4">
                            <small class="or">When don't sent any code your mail  <a class="btn-link" href="{{route('user.sendVcode')}}?email={{auth()->guard(get_auth_guard())->user()->email}}"> Resend code</a></small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection