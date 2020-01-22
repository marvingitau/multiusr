@extends('backend.master')

@section('title','All Jobs')

@section('content')

    <div class="card ">

        <div class="card-body border-bottom">
                <h5>Job List </h5>
                @if(auth()->user()->role_id == 3)
                <a class="btn btn-tsk float-right mb-2" href="{{route('admin.job.create')}}"><i class="fa fa-plus"></i> Post Job</a>
                
                @endif
                    
        </div>

        <div class="card-body p-0">

            <table class="table table-sm table-striped">

                <thead class="bg-light ">

                <tr>

                    <th>Sl.</th>

                    <th>Title</th>

                    {{-- <th>Company</th> --}}

                    <th>Published</th>

                    <th>Expired Date</th>

                    {{-- <th>Status</th> --}}

                    <th class="text-right">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($jobs as $key=>$job)
                {{-- @forelse($jobs as $job) --}}

                <tr class="">

                    <td>{{$key+1}}</td>
                   
                    <td>{{$job->title}}</td>

                     {{-- <td><a href="{{route('admin.employer.view',$job->employer->id)}}">{{$job->employer->company_name}}</a></td> --}}

                    <td>{{$job->created_at->format('M d, Y')}}</td>

                    @php($expired_date = \Carbon\Carbon::parse($job->expired_date))

                    <td class="{{$expired_date < \Carbon\Carbon::now()?'text-danger':''}}">{{$expired_date->format('M d, Y')}}</td>

                    {{-- <td><span class="badge {{$job->status?'badge-success':'badge-danger'}}">{{$job->status?'APPROVED':'NOT APPROVED'}}</span></td>  --}}

                    <td class="text-right">

                        <div class="dropdown">

                            <button class="btn btn-sm btn-square btn-tsk dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                ACTION

                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item" href="{{route('admin.job.edit',$job->id)}}"><i class="fa fa-edit"></i> EDIT</a>

                                <a class="dropdown-item" href="{{route('admin.job.view',$job->id)}}"><i class="fa fa-eye"></i> VIEW</a>

                                <a class="dropdown-item" href="{{route('job.view',[$job->id,str_slug($job->title)])}}" target="_blank"><i class="fa fa-eye"></i> PUBLIC VIEW</a>

                                <a class="dropdown-item" href="{{route('admin.job.change-status',$job->id)}}"><i class="fa fa-check"></i> MAKE {{!$job->status?'APPROVED':'NOT APPROVED'}}</a>

                            </div>

                        </div>

                    </td>

                </tr>

                    @empty



                    <tr>

                        <td colspan="" class="text-danger text-center">No job found.</td>

                    </tr>

                @endforelse



                </tbody>

            </table>

            <div class="mt-2">

                {{ $jobs->links()}}

            </div>

        </div>

    </div>

@endsection

