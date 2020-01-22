@extends('backend.master')
@section('title',$pt)
@section('content')
    <div class="card ">
        <div class="card-body border-bottom">
            <h4 class="">{{$pt}}
                <div class="actions float-right">
                    <form  class="form-inline" action="">
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


                    </form>
                </div>
            </h4>

        </div>
        <div class="card-body p-0">

            <table class="table table-sm ">
                <thead class="bg-light">
                <tr>
                    <th>
                        Company Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Phone
                    </th>
                    <th class="text-center">
                        Status
                    </th>
                    <th class="text-right">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($employers as $employer)
                    <tr>
                        <td>
                            {{$employer->company_name}}
                        </td>
                        <td>
                            {{$employer->email}}
                        </td>
                        <td>
                            {{$employer->phone}}
                        </td>
                        <td class="text-center">
                            <span  class="badge badge-{{$employer->status?'success':'danger'}} btn-square">{{$employer->status?'Active':'Inactive'}}</span>
                            <span class="badge badge-{{$employer->is_featured?'success':'danger'}} btn-square">{{$employer->is_featured?'Featured':'Not Featured'}}</span>
                        </td>
                        <td class="text-right">
                            <a href="{{route('admin.employer.view', $employer->id)}}"
                               class="btn btn-sm btn-square btn-outline-tsk">
                                <i class="fa fa-eye"></i> View </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $employers->links() }}
            </div>
        </div>
    </div>
@endsection

