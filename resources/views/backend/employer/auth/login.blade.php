<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{general_setting()->title}} | Login</title>
    <link rel="shortcut icon" href="{{general_setting()->favicon}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-4.0.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootadmin.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/toastr/build/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/login_page.css')}}">
    <link href="{{url('/')}}/assets/backend/css/color.php?color={{general_setting()->color}}" rel="stylesheet">
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1 class="text-center mb-4"><a href="{{route('home')}}"><img src="{{general_setting()->logo}}"></a></h1>

    </div>
    <div class="login-box">
        <form class="login-form" action="{{route('employer.login')}}" method="post">@csrf
            <h3 class="login-head text-tsk" style="border-bottom: 1px solid #{{general_setting()->color}}"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            <div class="form-group">
                <label class="control-label">USERNAME</label>
                <input type="text" class="form-control" id="username"  name="username"  placeholder="Username" >
            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-tsk btn-block"  type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>

        </form>
    </div>
</section>
<section class="login-section--style2 padd-top-120 padd-bottom-120 gradient-bg-light">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-7">
                <img src="http://bashir.thesoftking.com/easy-earn/assets/user/images/frontEnd/login-svg.svg" alt="image">
            </div>
            <div class="col-lg-4">
                <div class="login-area">

                    <h2 class="title">Welcome Back :)</h2>
                    <p>To keep connected with us please login with your personal information by email and password</p>
                    <form class="login-form" method="POST" action="{{route('employer.login')}}">
                        @csrf
                        <div class="login-inner-block">
                            <div class="frm-grp">
                                <i class="fa fa-user"></i>
                                <input type="text" name="user_name" id="login-email" required>
                                <label for="#0">UserName</label>
                            </div>
                            <div class="frm-grp">
                                <i class="fa fa-lock"></i>
                                <input type="password" name="password" id="login-pass" required>
                                <label for="#0">Password</label>
                            </div>
                        </div>
                        <div class="d-flex mt-3 justify-content-between">
                            <div class="frm-group-o">
                                <input type="checkbox" name="remember" id="checkbox" value="yes">
                                <label for="checkbox">Remember Me</label>
                            </div>
                            <a href="http://bashir.thesoftking.com/easy-earn/password/reset" class="forget-pass">Forget password?</a>
                        </div>
                        <div class="btn-area">
                            <button type="submit" class="submit-btn">Login now</button>
                            <a href="http://bashir.thesoftking.com/easy-earn/register" class="acc-btn">Create Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@include('backend.partials.script')
@include('backend.partials.msg')
</body>
</html>
