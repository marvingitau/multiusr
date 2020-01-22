@extends('backend.master')
@section('title',"Users")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="card light bordered">
                <div class="card-header bg-tsk text-white">
                    <h5>Band Users</h5>
                </div>
                <div class="card-body">

                    <table class="table table-sm table-striped table-bordered table-hover order-column">
                        <thead>
                        <tr>
                            <th>
                                Full name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Username
                            </th>
                            <th>
                                Phone
                            </th>
                            <th class="text-right">
                                Details
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$user->full_name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->username}}
                                </td>
                                <td>
                                    {{$user->phone}}
                                </td>
                                <td class="text-right">
                                    <a href="{{route('admin.user.view', $user->id)}}"
                                       class="btn btn-sm btn-outline-tsk">
                                        <i class="fa fa-eye"></i> View </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div><!-- row -->
        </div>
    </div>
@endsection

