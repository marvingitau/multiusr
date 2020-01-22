

@extends('backend.employer.master')
@section('title','All Jobs')
@section('content')
    <div class="card ">
        <div class="card-body border-bottom">
            <h4>Job List

            </h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm table-striped">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Title</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($jobs as $key=>$job)
                <tr>
                    <td>{{$key+$jobs->firstitem()}}</td>
                    <td>{{$job->title}}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-square btn-outline-tsk dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ACTION
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('employer.job.edit',$job->id)}}"><i class="fa fa-edit"></i> EDIT</a>
                                <a class="dropdown-item" href="{{route('employer.job.view',$job->id)}}"><i class="fa fa-eye"></i> VIEW</a>
                                <a class="dropdown-item" href="{{route('job.view',[$job->id,str_slug($job->title)])}}" target="_blank"><i class="fa fa-eye"></i> PUBLIC VIEW</a>
                            </div>
                        </div>
                    </td>
                </tr>
                    @empty

                    <tr>
                        <td colspan="3" class="text-danger text-center">No job found.</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="pl-2">
               {{$jobs->links()}}
            </div>
        </div>
    </div>
@endsection
