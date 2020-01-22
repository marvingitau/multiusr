@extends('backend.master')
@section('title','Country')
@section('content')
    <div class="card">
        <div class="card-body border-bottom">
            <h5>Country
                <div class="btn-group float-right mb-2">
                    <a class="btn btn-tsk  " href="#" data-toggle="modal" data-target="#create_model"><i class="fa fa-plus"></i> Add Country</a>
                </div>

            </h5>
        </div>
        <div class="card-body  p-0">
            <table class="table table-sm table-borderless  mb-0">
                <thead class="">
                <tr>
                    <th></th>
                    <th>Flag </th>
                    <th>Name </th>
                    <th>Full Name </th>
                    <th>Status </th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody id="tabledivbody">
                @forelse($countries as $key=>$country)
                    <tr class="sectionsid" id="sectionsid_{{$country->id}}">
                        <td><a href="#"><i class="fa fa-arrows"></i></a></td>
                        <td><img src="{{asset('assets/backend/image/flag/'.$country->flag)}}" height="30"> </td>
                        <td>{{$country->name}}</td>
                        <td>{{$country->full_name}}</td>
                        <td><span class="badge {{$country->status?'badge-success':'badge-danger'}}">{{$country->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-tsk edit_btn"
                               data-name="{{$country->name}}"
                               data-full_name="{{$country->full_name}}"
                               data-status="{{$country->status}}"
                               data-url="{{route('admin.location.update',[$country->id])}}"
                               data-toggle="modal"
                               data-target="#edit_model"><i class="fa fa-edit"></i> Edit</a>
                            <a href="{{route('admin.state',$country->id)}}" class="btn btn-sm btn-tsk"><i class="fa fa-eye"></i> View State</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Create New Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.location.store')}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Name</strong> <span class="text-danger">**</span></label>
                                <input class="form-control form-control-lg" name="name">
                            </div>
                            <div class="form-group col-md">
                                <label><strong>Full Name</strong> </label>
                                <input class="form-control form-control-lg" name="full_name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Flag</strong> <small class="text-muted">(.png)</small></label>
                               <input type="file" name="flag">
                            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
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
                            <div class="form-group col-md">
                                <label><strong>Full Name</strong> </label>
                                <input class="form-control form-control-lg" name="full_name" id="full_name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Flag</strong> <small class="text-muted">(.png)</small></label>
                                <input type="file" name="flag">
                            </div>
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
                $('#id').val($(this).data('id'));
                $('#name').val($(this).data('name'));
                $('#full_name').val($(this).data('full_name'));
                $('#status').bootstrapToggle($(this).data('status')?'on':'off')
            });

            $("#tabledivbody").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    var order = $("#tabledivbody").sortable("serialize");
                    $.ajax({
                        type: "GET",dataType: "json", url: "{{route('admin.location_shortable','country')}}",
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