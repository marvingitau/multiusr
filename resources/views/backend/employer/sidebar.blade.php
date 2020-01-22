<ul class="list-unstyled">
    <li class="{{active_menu([route('employer.dashboard')],'active')}}"><a href="{{route('employer.dashboard')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
    <li class="{{active_menu([route('employer.profile')],'active')}}"><a href="{{route('employer.profile')}}"><i class="fa fa-fw fa-user"></i> Company Profile </a></li>
    <li>
        <a href="#user" data-toggle="collapse">
            <i class="fa fa-fw fa-user-md"></i> Management Job
        </a>
        <ul id="user" class="list-unstyled collapse {{active_menu([
            route('employer.job_post'),
            route('employer.job_list'),
            ],'show',['employer.job.edit','employer.job.view'])}}">
            <li class="{{active_menu([route('employer.job_post')],'active')}}"> <a href="{{route('employer.job_post')}}"> <i class="fa fa-circle-o"></i> Post job</a></li>
            <li class="{{active_menu([route('employer.job_list')],'active',['employer.job.view','employer.job.edit'])}}"> <a href="{{route('employer.job_list')}}"> <i class="fa fa-circle-o"></i> All Jobs</a></li>
        </ul>
    </li>
   <li ><a href="#" onclick="$('#logout-form').submit()"><i class="fa fa-fw fa-sign-out"></i> Logout </a></li>


</ul>