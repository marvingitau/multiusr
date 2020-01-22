
@extends('backend.master')
@section('title',ucfirst(str_replace('-',' ',$section)))
@section('content')
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5>{{strtoupper(str_replace('-',' ',$section))}} ITEM
            <a href="#" class="btn btn-sm btn-outline-tsk float-right" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add New</a>
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-sm  mb-0">
                        <thead>
                        <tr>
                            <th width="30px">SL</th>
                            <th>Image</th>
                            <th>Quotation</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th class="text-right">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(web_setting_item('testimonial') as $key=>$value)
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
                                                    <form action="{{route('admin.web_setting.home.testimonial.update',$value->id)}}" method="post" enctype="multipart/form-data">@csrf
                                                        <div class="form-group">
                                                            <label for="image">Image </label>
                                                            <input type="file" class="form-control" id="image" name="image" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="quotation">Quotation </label>
                                                            <textarea  class="form-control" id="quotation" name="quotation">{{$value->val_2}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="image">Name </label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{$value->val_3}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title">Title </label>
                                                            <input type="text" class="form-control" id="title" name="title" value="{{$value->val_4}}">
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
                            <td >{{$key+1}}</td>
                            <td ><img src="{{asset('assets/frontend/img/home/testimonial_section/'.$value->val_1)}}" height="50px"></td>
                            <td>{{$value->val_2}}</td>
                            <td>{{$value->val_3}}</td>
                            <td>{{$value->val_4}}</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-tsk" data-toggle="modal" data-target="#update_{{$value->id}}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" onclick="confirm('Are you sure delete this data')?$('#delete_form_{{$value->id}}').submit():false"><i class="fa fa-trash"></i></a>
                                </div>
                                <form action="{{route('admin.web_setting.home.testimonial.delete',$value->id)}}" id="delete_form_{{$value->id}}" method="post">@csrf</form>

                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="3">No result </td>
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
                            <form action="{{route('admin.web_setting.home.testimonial.store')}}" method="post" enctype="multipart/form-data">@csrf
                                <div class="form-group">
                                    <label for="image">Image </label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="form-group">
                                    <label for="quotation">Quotation </label>
                                    <textarea  class="form-control" id="quotation" name="quotation"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Name </label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="title">Title </label>
                                    <input type="text" class="form-control" id="title" name="title">
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