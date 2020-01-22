<div class="sidebar mb-3">

    <div class=" widget-job-details">

        <ul class="widget-common-list dashboard-menu">

            <li class="{{active_menu([route('user.dashboard')],'active')}}"><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="{{active_menu([route('user.profile')],'active')}}"><a href="{{route('user.profile')}}"><i class="fa fa-user"></i> My Profile</a></li>

            <li class="{{active_menu([],'active',['user.application'])}}"><a href="{{route('user.application','monthly')}}"><i class="fa fa-desktop"></i> My Job Application</a></li>

            <li class="{{active_menu([route('user.resume_view')],'active')}}"><a href="{{route('user.resume_view')}}"><i class="fa fa-file"></i> View Resume</a></li>
           
            <li class="{{active_menu([route('user.resume')],'active')}}">
            <a href="{{route('user.resume')}}"><i class="fa fa-file-text"></i> Manage Resume</a></li>

            <li class="{{active_menu([route('user.change_pass')],'active')}}"><a href="{{route('user.change_pass')}}"><i class="fa fa-key"></i> Change Password</a></li>

            <li><a onclick="$('#logout_form').submit()"><i class="fa fa-sign-out" ></i> Log out</a></li>

        </ul>

    </div><!-- widget end -->

</div>



