<ul class="list-unstyled"> 
    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
    <li class="{{active_menu([route('admin.dashboard')],'active')}}"><a href="{{route('admin.dashboard')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
    @endif

    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
    <li class="{{active_menu([route('admin.job')],'active',['admin.job.edit','admin.job.view'])}}"><a href="{{route('admin.job')}}"><i class="fa fa-fw fa-briefcase"></i> Manage Job </a></li>

    {{-- <li class="{{active_menu([route('admin.package')],'active')}}"><a href="{{route('admin.package')}}"><i class="fa fa-fw fa-cubes"></i> Package </a></li> --}}

    {{-- <li>

        <a href="#Employer" data-toggle="collapse">

            <i class="fa fa-fw fa-black-tie"></i> Employer Management

        </a>

        <ul id="Employer" class="list-unstyled collapse {{active_menu([

            route('admin.employer'),

            route('admin.employer.broadcast'),

            route('admin.employer.ban'),

            ],'show',['admin.email','admin.employer.view'])}}">

            <li class="{{active_menu([route('admin.employer')],'active',['admin.email','admin.employer.view'])}}"> <a href="{{route('admin.employer')}}"> <i class="fa fa-list"></i> Employers</a></li>

            <li class="{{active_menu([route('admin.employer.broadcast')],'active')}}"> <a href="{{route('admin.employer.broadcast')}}"> <i class="fa fa-envelope"></i> Broadcast Email</a></li>

            <li class="{{active_menu([route('admin.employer.ban')],'active')}}"> <a href="{{route('admin.employer.ban')}}"> <i class="fa fa-user-times"></i> Band Employers</a></li>

        </ul>

    </li> --}}
    @endif

    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
    <li>

        <a href="#user" data-toggle="collapse">
            <i class="fa fa-fw fa-user"></i> Job Seeker Management
        </a>

        <ul id="user" class="list-unstyled collapse {{active_menu([

            route('admin.users'),

            route('admin.broadcast'),

            route('admin.user.ban'),

            ],'show',['admin.email','admin.user.view','admin.view-cv'])}}">

            <li class="{{active_menu([route('admin.users')],'active',['admin.email','admin.user.view','admin.view-cv'])}}"> <a href="{{route('admin.users')}}"> <i class="fa fa-list"></i> All Users</a></li>

            <li class="{{active_menu([route('admin.broadcast')],'active')}}"> <a href="{{route('admin.broadcast')}}"> <i class="fa fa-envelope"></i> Broadcast Email</a></li>

            <li class="{{active_menu([route('admin.user.ban')],'active')}}"> <a href="{{route('admin.user.ban')}}"> <i class="fa fa-user-times"></i>Job Applicants</a></li>

        </ul>

    </li>
    @endif

    @if(auth()->user()->role_id == 1)
    <li>

        <a href="#m_job_attr" data-toggle="collapse">

            <i class="fa fa-fw fa-th-large"></i> Manage Job Attribute

        </a>

        @php($j_attr = \App\Model\JobAttributs::types())

        <ul id="m_job_attr" class="list-unstyled collapse {{active_menu($j_attr->map(function ($item,$key){

        return route('admin.job_attribute',[$key]);

        })->toArray(),'show')}}">

            @foreach($j_attr as $key=>$j_type)

            <li class="{{active_menu([route('admin.job_attribute',[$key])],'active')}}"> <a href="{{route('admin.job_attribute',[$key])}}"> <?php echo $j_type['icon']?> {{$j_type['label']}}</a></li>

            @endforeach

        </ul>

    </li>



    {{-- <li>

        <a href="#payment" data-toggle="collapse">

            <i class="fa fa-fw fa-credit-card"></i> Payment

        </a>

        <ul id="payment" class="list-unstyled collapse {{active_menu([

            route('admin.gateway'),

            route('admin.payment_log'),

            ],'show')}}">

            <li class="{{active_menu([route('admin.gateway')],'active')}}"> <a href="{{route('admin.gateway')}}"> <i class="fa fa-credit-card"></i> Getaway</a></li>

            <li class="{{active_menu([route('admin.payment_log')],'active')}}"> <a href="{{route('admin.payment_log')}}"> <i class="fa fa-file-text"></i> Payment Log</a></li>

        </ul>

    </li> --}}



    {{-- <li class="{{active_menu([route('admin.advertisement'),route('admin.advertisement.create')],'active',['admin.advertisement.edit'])}}"><a href="{{route('admin.advertisement')}}"><i class="fa fa-bullhorn"></i> Advertisement</a></li>
--}}
    <li>

        <a href="#Setting" data-toggle="collapse">

            <i class="fa fa-fw fa-cogs"></i>General Setting

        </a>

        <ul id="Setting" class="list-unstyled collapse {{active_menu([

            route('backend.admin.general_setting'),

            route('backend.admin.logo_and_fav_setting'),

            route('backend.admin.email_setting'),

            route('backend.admin.sms_setting'),

            ],'show')}}">

            <li class="{{active_menu([route('backend.admin.general_setting')],'active')}}"> <a href="{{route('backend.admin.general_setting')}}"> <i class="fa fa-wrench"></i> General Setting</a></li>

            {{-- <li class="{{active_menu([route('backend.admin.logo_and_fav_setting')],'active')}}"><a href="{{route('backend.admin.logo_and_fav_setting')}}"><i class="fa fa-adn"></i> Logo & Favicon</a></li> --}}

            <li class="{{active_menu([route('backend.admin.email_setting')],'active')}}"><a href="{{route('backend.admin.email_setting')}}"><i class="fa fa-envelope"></i> Email Setting</a></li>

            {{-- <li class="{{active_menu([route('backend.admin.sms_setting')],'active')}}"><a href="{{route('backend.admin.sms_setting')}}"><i class="fa fa-mobile-phone"></i> SMS Setting</a></li> --}}
            <li class="{{active_menu([route('backend.admin.createUser')],'active')}}"><a href="{{route('backend.admin.createUser')}}"><i class="fa fa-mobile-phone"></i> Create User</a></li>

        </ul>

    </li> 



    {{-- <li>

        <a href="#Web_Setting" data-toggle="collapse">

            <i class="fa fa-fw fa-globe"></i>Web Setting

        </a>

        <ul id="Web_Setting" class="list-unstyled collapse {{active_menu([

                    route('admin.blog'),

                    route('admin.cat'),

                ],'show',['admin.web_setting.section'])}}">

            <li>

                <a href="#home" data-toggle="collapse">

                    <i class="fa fa-fw fa-angle-double-down"></i> Home

                </a>

                <ul id="home" class="list-unstyled collapse {{active_menu([

                route('admin.web_setting.section',['home','slider-section']),

                route('admin.web_setting.section',['home','about-section']),

                route('admin.web_setting.section',['home','overview-left-section']),

                route('admin.web_setting.section',['home','overview-right-section']),

                route('admin.web_setting.section',['home','job-section']),

                route('admin.web_setting.section',['home','find-job-section']),

                route('admin.web_setting.section',['home','team-section']),

                route('admin.web_setting.section',['home','testimonial-section']),

                route('admin.web_setting.section',['home','why-people-like-section']),

                route('admin.web_setting.section',['home','brand-section']),

                ],'show')}}">

                    <li class="{{active_menu([route('admin.web_setting.section',['home','slider-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','slider-section'])}}"> <i class="fa fa-angle-double-right"></i> Slide Area</a></li>

                    <li class="{{active_menu([route('admin.web_setting.section',['home','about-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','about-section'])}}"> <i class="fa fa-angle-double-right"></i> About Area</a></li>

                    <li class="{{active_menu([route('admin.web_setting.section',['home','overview-left-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','overview-left-section'])}}"> <i class="fa fa-angle-double-right"></i> Overview Left Area</a></li>

                    <li class="{{active_menu([route('admin.web_setting.section',['home','overview-right-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','overview-right-section'])}}"> <i class="fa fa-angle-double-right"></i> Overview Right Area</a></li>

                    <li class="{{active_menu([route('admin.web_setting.section',['home','team-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','team-section'])}}"> <i class="fa fa-angle-double-right"></i> Our Team Area</a></li>

                    <li class="{{active_menu([route('admin.web_setting.section',['home','job-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','job-section'])}}"> <i class="fa fa-angle-double-right"></i> Job Section</a></li>

                    <li class="{{active_menu([route('admin.web_setting.section',['home','find-job-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','find-job-section'])}}"> <i class="fa fa-angle-double-right"></i> Find Job Area</a></li>

                    <li class="{{active_menu([route('admin.web_setting.section',['home','testimonial-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','testimonial-section'])}}"> <i class="fa fa-angle-double-right"></i> Testimonial Area</a></li>

                    <li class="{{active_menu([route('admin.web_setting.section',['home','why-people-like-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','why-people-like-section'])}}"> <i class="fa fa-angle-double-right"></i> Why People Like Area</a></li>

                    <li class="{{active_menu([route('admin.web_setting.section',['home','brand-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['home','brand-section'])}}"> <i class="fa fa-angle-double-right"></i> Brand Area</a></li>

                </ul>

            </li>

            <li>

                <a href="#blog" data-toggle="collapse">

                    <i class="fa fa-fw fa-angle-double-down"></i> Blog

                </a>

                <ul id="blog" class="list-unstyled collapse {{active_menu([

                 route('admin.blog'),

                    route('admin.cat'),

                ],'show')}}">

                    <li class="{{active_menu([route('admin.blog')],'active')}}"> <a href="{{route('admin.blog')}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Post</a></li>

                    <li class="{{active_menu([route('admin.cat')],'active')}}"> <a href="{{route('admin.cat')}}"> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> Category</a></li>

                </ul>

            </li>

            <li class="{{active_menu([route('admin.web_setting.section',['faq','faq-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['faq','faq-section'])}}"> <i class="fa fa-angle-double-right"></i> FAQ</a></li>

            <li class="{{active_menu([route('admin.web_setting.section',['contact','all-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['contact','all-section'])}}"> <i class="fa fa-angle-double-right"></i> Contact</a></li>

            <li class="{{active_menu([route('admin.web_setting.section',['general','social'])],'active')}}"> <a href="{{route('admin.web_setting.section',['general','social'])}}"> <i class="fa fa-angle-double-right"></i> Social Link</a></li>

            <li class="{{active_menu([route('admin.web_setting.section',['general','fb-comment-script'])],'active')}}"> <a href="{{route('admin.web_setting.section',['general','fb-comment-script'])}}"> <i class="fa fa-angle-double-right"></i> FB Comment Script</a></li>

            <li class="{{active_menu([route('admin.web_setting.section',['general','login-and-breadcrumb-img'])],'active')}}"> <a href="{{route('admin.web_setting.section',['general','login-and-breadcrumb-img'])}}"> <i class="fa fa-angle-double-right"></i> Login & Breadcrumb</a></li>

            <li class="{{active_menu([route('admin.web_setting.section',['general','preload-img'])],'active')}}"> <a href="{{route('admin.web_setting.section',['general','preload-img'])}}"> <i class="fa fa-angle-double-right"></i> Preload Image</a></li>

            <li class="{{active_menu([route('admin.web_setting.section',['global','global-section'])],'active')}}"> <a href="{{route('admin.web_setting.section',['global','global-section'])}}"> <i class="fa fa-angle-double-right"></i> Global Title And Image</a></li>

        </ul>

    </li> --}}
    @endif


</ul>