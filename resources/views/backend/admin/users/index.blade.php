@extends('backend.master')

@section('title',"Users")

@section('content')

    <div class="row">

        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="card light bordered">

                <div class="card-header bg-white">

                    <h5>Users

                        <div class="actions float-right">
                            {{-- <form  class="form-inline" action="">

                                <div class="form-group">

                                    <div class="input-group">

                                        <input type="text" name="search" class="form-control" placeholder="Search">

                                        <div class="input-group-append">

                                            <div class="input-group-btn">

                                                <button class="btn btn-tsk" type="submit"><i

                                                            class="fa fa-search"></i></button>

                                            </div>

                                        </div>

                                    </div>

                                </div> 
                            </form>--}}
                        </div>
                    </h5>

                </div>

                <div class="card-body p-0">



                    <table class="table table-striped table-alternate" id="jquery-datatable">

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

                                Action

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

                                    <a href="{{route('admin.view-cv', $user->id)}}"

                                       class="btn btn-sm btn-outline-tsk">

                                        <i class="fa fa-id-card"></i> cv </a>
                                        
                                       @if( auth()->user()->role_id == 1)
                                        
                                        <a href="{{route('admin.deactivate', $user->id)}}"

                                       class="btn btn-sm btn-outline-tsk">

                                        <i class="fa fa-id-card"></i> Deactivate</a>
                                        
                                          <a href="{{route('admin.delete', $user->id)}}"

                                       class="btn btn-sm btn-outline-tsk">

                                        <i class="fa fa-id-card"></i> Delete user</a>
                                        
                                        @endif

                                </td>

                            </tr>

                        @endforeach

                        </tbody>
                        
                 

                    </table>
                    
                    <table class="table table-striped table-alternate" id="jquery-datatable">
                        <tbody>

                        @foreach($usersDeactivated as $user)

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

                                    <a href="{{route('admin.view-cv', $user->id)}}"

                                       class="btn btn-sm btn-outline-tsk">

                                        <i class="fa fa-id-card"></i> cv </a>
                                        
                                        @if(auth()->user()->role_id == 1)
                                         <a href="{{route('admin.activate', $user->id)}}" class="btn btn-sm btn-outline-tsk">

                                        <i class="fa fa-id-card"></i> Activate</a>
                                        
                                        <a href="{{route('admin.delete', $user->id)}}"

                                       class="btn btn-sm btn-outline-tsk">

                                        <i class="fa fa-id-card"></i> Delete user</a>
                                        
                                        @endif
                                        

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



