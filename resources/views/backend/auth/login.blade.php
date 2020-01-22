



        <!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{general_setting()->title}} | Login</title>

    <link rel="shortcut icon" href="{{asset('assets/favicon.png')}}">

    <!-- fa pls -->

    <link href="https://daneden.github.io/animate.css/animate.min.css" rel="stylesheet">



    <!-- animate.css -->


    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="{{asset('assets/plugin/iziToast/dist/css/iziToast.min.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/backend/css/login_page.css')}}">

</head>

<body>
    <section class="login_wrap">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-4">
                        <div class="login-html text-center">
                        <div class="logo"  style="margin-bottom: 40px;">
                            <img src="{{asset('assets/logo.png')}}" alt="logo" style="max-width: 100%;">
                        </div>
                        <input id="tab-1" type="radio" name="tab" class="sign-in"  checked><label for="tab-1" class="tab">Admin Login</label>
                        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
                        <div class="login-form" style="margin-top: 40px;">
                            <div class="sign-in-html">
                                <form  action="{{route('admin.login.post')}}" method="post">@csrf
                                    <div class="group">
                                        <input type="text" class="input form-control rounded-0" id="username"  name="username" placeholder="Username" >
                                    </div>
                                    <div class="group">
                                        <input type="password" class="input form-control rounded-0" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="group">
                                        <input type="submit" class="button btn" value="Log In">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('backend.partials.script')
@include('backend.partials.izi_msg')
</body>

</html>



