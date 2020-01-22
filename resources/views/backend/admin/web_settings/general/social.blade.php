@extends('backend.master')
@section('title',ucfirst(str_replace('-',' ',$section)))
@section('content')

    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5>{{strtoupper(str_replace('-',' ',$section))}} ITEM
                <a href="#" class="btn btn-sm btn-tsk btn-square float-right" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add New</a>
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-sm table-striped mb-0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Icon</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th class="text-right">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(web_setting_item('social') as $key=>$value)
                            <div class="modal fade" id="update_{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small> Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    <form action="{{route('admin.web_setting.social.update',$value->id)}}" method="post" enctype="multipart/form-data">@csrf
                                                        <div class="form-group">
                                                            <label for="name">Name </label>
                                                            <input type="text" class=" form-control form-control-lg" id="name" name="name" value="{{$value->val_1}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="icon">Icon <small><a href="https://fontawesome.com/icons?d=gallery" target="_blank">Font awesome</a></small></label>
                                                            <div class="input-group input-group-lg">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">fa fa-</div>
                                                                </div>
                                                                <input type="text" class=" form-control" id="icon" name="icon" value="{{$value->val_2}}">

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="link">Link </label>
                                                            <input type="text" class=" form-control form-control-lg" id="link" name="link" value="{{$value->val_3}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status </label>
                                                            <select class="  form-control form-control-lg" name="status" id="status">
                                                                <option value="1" {{$value->val_4==1?'selected':''}}>Active</option>
                                                                <option value="0" {{$value->val_4==0?'':'selected'}}>Inactive</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <hr/>
                                                            <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                                            <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Update</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <tr>
                                <td ><a href="{{$value->val_3}}" target="_blank" style="color:#{{$value->color}} "><i class="fa fa-{{$value->val_2}}" style="width: 20px"></i>  {{$value->val_1}}</a></td>
                                <td >fa fa-{{$value->val_2}}</td>
                                <td >{{$value->val_3}}</td>
                                <td ><span class="badge badge-{{$value->val_4 == 1?'success':'danger'}}">{{$value->status?'Active':'Inactive'}}</span> </td>
                                <td class="text-right">
                                    <div class="">
                                        <a class="btn btn-sm btn-tsk btn-square" data-toggle="modal" data-target="#update_{{$value->id}}"><i class="fa fa-edit"></i> edit</a>
                                        <a href="#" class="btn btn-sm btn-danger btn-square" onclick="confirm('Are you sure delete this data')?$('#delete_form_{{$value->id}}').submit():false"><i class="fa fa-trash"></i> delete</a>
                                    </div>
                                    <form action="{{route('admin.web_setting.social.delete',$value->id)}}" id="delete_form_{{$value->id}}" method="post">@csrf</form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="5">No result </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small> Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form action="{{route('admin.web_setting.social.store')}}" method="post" >@csrf

                                <div class="form-group">
                                    <label for="name">Name </label>
                                    <input type="text" class=" form-control form-control-lg" id="name" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="icon">Icon <small><a href="https://fontawesome.com/icons?d=gallery" target="_blank">Font awesome</a></small></label>
                                    <div class="input-group input-group-lg">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">fa fa-</div>
                                        </div>
                                        <input type="text" class=" form-control" id="icon" name="icon">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="link">Link </label>
                                    <input type="text" class=" form-control form-control-lg" id="link" name="link">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status </label>
                                    <select class="  form-control form-control-lg" name="status" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <hr/>
                                    <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                    <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection