@extends('frontend.master')

@section('title','Login')

@section('content')

    @include('frontend.partials.breadcrumb',['title'=>'Login','item'=>['Login'=>null]])

    <!-- login-section start -->



    <section class="login-section--style2 padd-top-120 padd-bottom-120 gradient-bg-light">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <div class="col-lg-7">

                    <img src="{{asset('assets/frontend/img/global/global_section/login_image.png')}}" alt="image">

                </div>

                <div class="col-lg-5">

                    <div class="login-area">



                        <h2 class="title">{{web_setting()->global_global_section_login_title}}</h2>

                        <p>{{web_setting()->global_global_section_login_sub_title}}</p>

                        <div class="login-type-block">

                            <div class="btn-group btn-block mb-0 user-btn-group ">

                                <a class="btn active login-type-btn" id="candidate"

                                   data-fb_social_url="{{route('social.login', ['candidate','facebook'])}}"

                                   data-google_social_url="{{route('social.login', ['candidate','google'])}}"

                                   data-login_type="candidate">Candidate</a>

                                <a class="btn login-type-btn d-none" id="employer"

                                   data-fb_social_url="{{route('social.login', ['employer','facebook'])}}"

                                   data-google_social_url="{{route('social.login', ['employer','google'])}}"

                                   data-login_type="employer">Employer</a>

                            </div>

                        </div>



                        <form class="login-form" method="POST" action="{{ route('auth.login.post') }}">@csrf

                            <input type="hidden" name="login_type" value="candidate" id="login_type">

                            <div class="login-inner-block">

                                <div class="frm-grp">

                                    <i class="fa fa-user"></i>

                                    <input type="text" name="username" id="login-email" required>

                                    <label for="#0">UserName</label>

                                    @if ($errors->has('username'))

                                        <small class="text-danger">{{ $errors->first('username') }}</small>

                                    @endif

                                </div>

                                <div class="frm-grp">

                                    <i class="fa fa-lock"></i>

                                    <input type="password" name="password" id="login-pass" required>

                                    <label for="#0">Password</label>

                                    @if ($errors->has('password'))

                                        <small class="text-danger">{{ $errors->first('password') }}</small>

                                    @endif

                                </div>

                            </div>

                            <div class="d-flex mt-3 justify-content-between">

                                <div class="frm-group-o">

                                    <input type="checkbox" name="remember" id="checkbox" value="yes">

                                    <label for="checkbox">Remember Me</label>

                                </div>

                                <a href="{{route('auth.password.request')}}" class="forget-pass">Forget password?</a>

                            </div>

                            <div class="btn-area">

                                <button type="submit" class="submit-btn">Login now</button>

                                <a href="{{route('auth.register')}}" class="acc-btn">Create Account</a>

                            </div>

                        </form>

                        @if(general_setting()->fb_login || general_setting()->google_login)



                            <div class="frm-group text-center py-4">

                                <span class="or">or</span>

                            </div>

                            <div class="frm-group text-center">

                                @if(general_setting()->fb_login)

                                    <a href="{{route('social.login', ['candidate','facebook'])}}" id="fb_social_url" class="btn btn-sm btn-primary facebook">facebook</a>

                                @endif

                                @if(general_setting()->google_login)

                                    <a href="{{route('social.login', ['candidate','google'])}}" id="google_social_url" class="btn btn-sm btn-primary google">google plus</a>

                                @endif

                            </div>



                        @endif



                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- login-section end -->

@endsection

@section('script')

    <script>

        function activeBtn(){

            if($('#login_type').val() === 'candidate'){

                $('#candidate').addClass('active');

                $('#employer').removeClass('active');

            }

            if($('#login_type').val() === 'employer'){

                $('#candidate').removeClass('active');

                $('#employer').addClass('active');

            }

        }

       $(document).ready(function () {

           $(document).on('click','.login-type-btn',function () {

               $('#login_type').val($(this).data('login_type'));

               $('#fb_social_url').attr('href',$(this).data('fb_social_url'));

               $('#google_social_url').attr('href',$(this).data('google_social_url'));



               activeBtn();

           });

           activeBtn();

       })

    </script>

    @endsection