<!--  header-section start  -->

<header class="header-section">

    <div class="header-top">

        <div class="container">

            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-4">

                    <ul class="header-social-icon d-none">

                        @forelse(web_setting_item('social') as $key=>$social)

                            <li><a href="{{$social->val_3}}" target="_blank"><i class="fa fa-{{$social->val_2}}"></i></a></li>

                            @endforeach

                    </ul>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-8">

                    <div class="header-top-right d-flex justify-content-md-end">

                        @if(auth()->guard(get_auth_guard())->check())

                            <form action="{{route('auth.logout')}}" method="post" id="logout_form">@csrf</form>

                            <div class="account-area">

                                <a href="{{route(get_auth_guard()==='web'?'user.dashboard':'employer.dashboard')}}"><i class="fa fa-user"></i> Dashboard </a>
                                <a href="#"><i class="fa fa-user"></i> {{auth()->guard(get_auth_guard())->user()->username}}</a>

                                <span class="border-right"></span>



                                <a href="#" onclick="$('#logout_form').submit()"><i class="fa fa-sign-out"></i> Logout</a>

                            </div>

                            @else

                            <div class="account-area">
                                <a href="{{route('auth.login')}}">Sign in</a>
                                <span>or</span>
                                <a href="{{route('auth.register')}}">Create Account</a>
                            </div>



                            @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="header-bottom">

        <div class="container">

            <nav class="navbar navbar-expand-xl p-0">

                <a class="site-logo site-title" href="{{route('home')}}"><img src="{{asset('assets/logo.png')}}" alt="site-logo"><span class="logo-icon"><i class="flaticon-fire"></i></span></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="menu-toggle"></span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav main-menu ml-auto">

                        <li class="{{active_menu([route('home')],'active')}}"><a href="{{route('home')}}" >Home</a>
                            {{--    MARVIN COMMENTED THIS SINCE JOB CONTENTS ARE THE ONE NEEDED  --}}

                        {{-- <li  class="{{active_menu([route('job')],'active')}}"><a href="{{route('job')}}">Jobs</a>

                        <li  class="{{active_menu([route('blog')],'active')}}"><a href="{{route('blog')}}">Blog</a>

                        <li class="{{active_menu([route('faq')],'active')}}"><a href="{{route('faq')}}">FAQ</a></li>

                        <li class="{{active_menu([route('contact')],'active')}}"><a href="{{route('contact')}}">Contact us</a></li> --}}

                    </ul>

                </div>

            </nav>

        </div>

    </div><!-- header-bottom end -->

</header>

<!--  header-section end  -->