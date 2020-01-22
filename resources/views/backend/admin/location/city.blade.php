@extends('backend.master')
@section('title','City list of '.$state->name)
@section('content')
    <div class="card">
        <div class="card-body border-bottom">
            <h5>
                <a href="{{route('admin.location')}}" class="nav-link float-left"><strong>Country :</strong> {{$state->country->name}}</a>
                <span class="nav-link float-left"> > </span>
                <a href="{{route('admin.state',$state->country->id)}}" class="nav-link float-left"><strong>State :</strong> {{$state->name}}</a>
                <span class="nav-link float-left"> > </span>
                <span class="nav-link float-left">City list</span>
                <div class="btn-group float-right mb-2">
                    <a class="btn btn-tsk  " href="#" data-toggle="modal" data-target="#create_model"><i class="fa fa-plus"></i> Add City</a>
                </div>

            </h5>
        </div>
        <div class="card-body  p-0">
            <table class="table table-sm table-borderless  mb-0">
                <thead class="bg-tsk-o-1">
                <tr>
                    <th></th>
                    <th>Name </th>
                    <th>Status </th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody id="tabledivbody">
                @forelse($cities as $key=>$city)
                    <tr class="sectionsid" id="sectionsid_{{$city->id}}">
                        <td><a href="#"><i class="fa fa-arrows"></i></a></td>
                        <td>{{$city->name}}</td>
                        <td><span class="badge {{$city->status?'badge-success':'badge-danger'}}">{{$city->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-tsk edit_btn"
                               data-name="{{$city->name}}"
                               data-status="{{$city->status}}"
                               data-url="{{route('admin.city.update',[$state->id,$city->id])}}"
                               data-toggle="modal"
                               data-target="#edit_model"><i class="fa fa-edit"></i> Edit</a>
                           </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-danger">No data found !</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>

    </div>
    <div class="modal fade" id="create_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.city.store',$state->id)}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Name</strong> <span class="text-danger">**</span></label>
                                <input class="form-control form-control-lg" name="name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Status</strong> </label>
                                <input data-toggle="toggle" checked data-height="40px" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col-md-12">
                                <hr/>
                                <button type="submit" class="btn btn-block btn-tsk mt-2"><i class="fa fa-save"></i> Save</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit_form" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Name</strong> <span class="text-danger">**</span></label>
                                <input class="form-control form-control-lg col-md-12" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Status</strong> </label>
                                <input data-toggle="toggle" id="status" checked data-height="40px"  data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col-md-12">
                                <hr/>
                                <button type="submit" class="btn btn-lg btn-block btn-tsk mt-2"><i class="fa fa-save"></i> Update</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $(document).on('click','.edit_btn', function(){
                $('#edit_form').attr('action',$(this).data('url'));
                $('#name').val($(this).data('name'));
                $('#status').bootstrapToggle($(this).data('status')?'on':'off')
            });
            $("#tabledivbody").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    var order = $("#tabledivbody").sortable("serialize");
                    $.ajax({
                        type: "GET",dataType: "json", url: "{{route('admin.location_shortable','city')}}",
                        data: order,
                        success: function(response) {
                            console.log(response);
                            if (response.status == "success") {
                                window.location.href = window.location.href;
                            } else {
                                alert('Some error occurred');
                            }
                        }
                    });
                }
            });
        });

    </script>
@endsection