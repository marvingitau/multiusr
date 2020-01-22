@extends('backend.master')
@section('title','Advertisement List')
@section('content')
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            <h3>Advertisement List
                <a class="btn btn-tsk btn-square float-right"  href="{{route('admin.advertisement.create')}}">Create New</a></h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-tsk text-white">
                    <tr>
                        <th># </th>
                        <th>TYPE </th>
                        <th>SIZE </th>
                        <th>REDIRECT URL </th>
                        <th>TOTAL CLICK </th>
                        <th>STATUS </th>
                        <th class="text-right"> ACTION </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($advertisements as $key=>$advertisement)
                        <tr>
                            <td> {{$key+$advertisements->firstItem()}}</td>
                            <td> {{$advertisement->type===1?'BANNER':'SCRIPT'}}</td>
                            <td>
                                @if($advertisement->size == 1)
                                    300 X 250
                                @elseif($advertisement->size == 2)
                                    728 X 90
                                @elseif($advertisement->size == 3)
                                    300 X 600
                                @endif

                            </td>
                            <td> {{$advertisement->redirect_url}}</td>
                            <td> {{$advertisement->click}}</td>
                            <td> {{$advertisement->is_active?'ACTIVE':""}}
                            </td>
                            @include('backend.admin.advertisement.view',['id'=>$advertisement->id])
                            <td class="text-right">
                                <a data-toggle="modal" href="#" class="btn btn-tsk btn-square btn-sm" data-target="#advertisement_view_{{$advertisement->id}}">VIEW</a>
                                <a href="{{route('admin.advertisement.edit',$advertisement->id)}}" class="btn btn-tsk btn-square btn-sm" >EDIT</a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-danger"> No result found ! </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @endsection