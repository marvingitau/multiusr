@extends('frontend.master')

@section('title','Register')

@section('content')

    @include('frontend.partials.breadcrumb',['title'=>'Register','item'=>['Register'=>null]])

    <!-- login-section start -->



    <!-- login-section end -->

    <section class="login-section--style2 padd-top-120 padd-bottom-120 gradient-bg-light">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <div class="col-lg-7">

                    <img src="{{asset('assets/frontend/img/global/global_section/register_image.png')}}" alt="image">

                </div>

                <div class="col-lg-5">

                    <div class="login-area">



                        <h2 class="title">{{web_setting()->global_global_section_register_title}}</h2>

                        <p>{{web_setting()->global_global_section_register_sub_title}}</p>

                        <div class="login-type-block">

                            <div class="btn-group btn-block mb-0 user-btn-group ">

                                <a class="btn active login-type-btn" id="candidate"

                                   data-fb_social_url="{{route('social.login', ['candidate','facebook'])}}"

                                   data-google_social_url="{{route('social.login', ['candidate','google'])}}"

                                   data-register_type="candidate">Candidate</a>

                                <a class="btn login-type-btn d-none" id="employer"

                                   data-fb_social_url="{{route('social.login', ['employer','facebook'])}}"

                                   data-google_social_url="{{route('social.login', ['employer','google'])}}"

                                   data-register_type="employer">Employer</a>

                            </div>

                        </div>



                        <form class="login-form" method="POST" action="{{ route('auth.register.post') }}">@csrf

                            <input type="hidden" name="register_type" value="candidate" id="register_type">

                            <div class="login-inner-block">

                                <div class="frm-grp">

                                    <i class="fa fa-user"></i>

                                    <input type="text" name="first_name" id="login-email" required>

                                    <label for="#0">First Name</label>

                                    @if ($errors->has('first_name'))

                                        <small class="text-danger">{{ $errors->first('first_name') }}</small>

                                    @endif

                                </div>

                                <div class="frm-grp">

                                    <i class="fa fa-user"></i>

                                    <input type="text" name="last_name" >

                                    <label for="#0">Last Name</label>

                                    @if ($errors->has('last_name'))

                                        <small class="text-danger">{{ $errors->first('last_name') }}</small>

                                    @endif

                                </div>

                                <div class="frm-grp">

                                    <i class="fa fa-envelope"></i>

                                    <input type="email" name="email" required>

                                    <label for="#0">E-mail</label>

                                    @if ($errors->has('email'))

                                        <small class="text-danger">{{ $errors->first('email') }}</small>

                                    @endif

                                </div>

                                <div class="frm-grp">

                                    <i class="fa fa-phone"></i>

                                    <input type="text" name="phone" >

                                    <label for="#0">Phone</label>

                                    @if ($errors->has('phone'))

                                        <small class="text-danger">{{ $errors->first('phone') }}</small>

                                    @endif

                                </div>

                                <div class="frm-grp">

                                    <i class="fa fa-user"></i>

                                    <input type="text" name="username"  required>

                                    <label for="#0">User Name</label>

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

                                <div class="frm-grp">

                                    <i class="fa fa-lock"></i>

                                    <input type="password" name="password_confirmation"  required>

                                    <label for="#0">Confirm Password</label>

                                    @if ($errors->has('password_confirmation'))

                                        <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>

                                    @endif

                                </div>

                            </div>



                            <div class="btn-area">

                                <button type="submit" class="submit-btn">Create Account</button>

                                <a href="{{route('auth.login')}}" class="acc-btn">Login now</a>

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

@endsection

@section('script')

    <script>

        function activeBtn(){

            if($('#register_type').val() === 'candidate'){

                $('#candidate').addClass('active');

                $('#employer').removeClass('active');

            }

            if($('#register_type').val() === 'employer'){

                $('#candidate').removeClass('active');

                $('#employer').addClass('active');

            }

        }

       $(document).ready(function () {



           $(document).on('click','.login-type-btn',function () {

               $('#register_type').val($(this).data('register_type'));

               $('#fb_social_url').attr('href',$(this).data('fb_social_url'));

               $('#google_social_url').attr('href',$(this).data('google_social_url'));

               activeBtn();



           });

           activeBtn();

       })

    </script>

    @endsection