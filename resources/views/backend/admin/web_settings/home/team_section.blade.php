
@extends('backend.master')
@section('title',ucfirst(str_replace('-',' ',$section)))
@section('content')
    <div class="card  mb-4">
        <div class="card-header bg-white">
            <h2><i class="fa fa-hand-o-right "></i> {{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small></h2>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form action="{{route('admin.web_setting.section.store',['home','team_section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="title_1">Title 1</label>
                            <input type="text" class="form-control form-control-lg" id="title_1" name="title_1" value="{{web_setting()->home_team_section_title_1}}">
                        </div>
                        <div class="form-group">
                            <label for="title_2">Title 2</label>
                            <input type="text" class="form-control form-control-lg" id="title_2" name="title_2" value="{{web_setting()->home_team_section_title_2}}">
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
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5>{{strtoupper(str_replace('-',' ',$section))}} ITEM
            <a href="#" class="btn btn-sm btn-outline-tsk float-right" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add New</a>
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse(web_setting_item('team') as $key=>$value)
                <div class="col-md-4">
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
                                            <form action="{{route('admin.web_setting.home.team.update',$value->id)}}" method="post" enctype="multipart/form-data">@csrf
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input type="file" class="form-control" name="image" >
                                                </div>

                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name" value="{{$value->val_2}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{$value->val_3}}">
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
                    <div class="card mb-3" style="width: 18rem;">
                        <img class="card-img-top" src="{{asset('assets/frontend/img/home/team_section/'.$value->val_1)}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$value->val_2}}</h5>
                            <p class="card-text">{{$value->val_3}}</p>
                            <div class="social">
                                <h6><small class="text-tsk">Social</small></h6>
                                @foreach($value->teamSocial as $social)
                                <div class="btn-group mb-1" role="group" aria-label="Button group with nested dropdown">
                                    <button type="button" class="btn btn-secondary"><i class="fa fa-{{$social->icon}}"></i> </button>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item edit_social_btn"
                                               data-url="{{route('admin.web_setting.home.team_social.update',[$value->id,$social->id])}}"
                                               data-name="{{$social->name}}"
                                               data-link="{{$social->link}}"
                                               data-icon="{{$social->icon}}"
                                               data-toggle="modal" data-target="#edit_social_model" href="#"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="dropdown-item delete_social_btn text-info" data-url="{{route('admin.web_setting.home.team_social.delete',[$value->id,$social->id])}}" href="#"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                               @endforeach
                                <a class="btn btn-link create_social_btn" data-url="{{route('admin.web_setting.home.team_social.store',$value->id)}}" data-toggle="modal"  data-target="#create_social_model"><i class="fa fa-plus"></i> Social</a>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a class="btn btn-sm btn-tsk" data-toggle="modal" data-target="#update_{{$value->id}}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-sm btn-danger" onclick="confirm('Are you sure delete this data')?$('#delete_form_{{$value->id}}').submit():false"><i class="fa fa-trash"></i></a>
                                <form action="{{route('admin.web_setting.home.team.delete',$value->id)}}" id="delete_form_{{$value->id}}" method="post">@csrf</form>
                            </div>
                        </div>
                    </div>
                </div>
                    @empty
                    <h4>No Team</h4>
                    @endforelse
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
                            <form action="{{route('admin.web_setting.home.team.store')}}" method="post" enctype="multipart/form-data">@csrf

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image" >
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" >
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" >
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
    <div class="modal fade" id="create_social_model" tabindex="-1" role="dialog" aria-labelledby="create_social_model" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Social</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="create_social_form">@csrf
                        <input type="hidden" name="company_id" >
                        <div class="form-row">
                            <label><strong>Name</strong> </label>
                            <input class="form-control form-control-lg col-md-12" name="name">
                        </div>
                        <div class="form-row">
                            <label><strong>Icon</strong> <small class="text-info"><a href="https://fontawesome.com/v4.7.0">Font awesome</a></small></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">fa fa-</div>
                                </div>
                                <input class="form-control form-control-lg col-md-12" name="icon">
                            </div>

                        </div>
                        <div class="form-row">
                            <label><strong>Link</strong> </label>
                            <input type="url" class="form-control form-control-lg col-md-12" name="link">
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
    <div class="modal fade" id="edit_social_model" tabindex="-1" role="dialog" aria-labelledby="edit_model" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Social</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="edit_social_form">@csrf
                        <div class="form-row">
                            <label><strong>Name</strong> </label>
                            <input class="form-control form-control-lg col-md-12" name="name" id="social_name">
                        </div>
                        <div class="form-row">
                            <label><strong>Icon</strong> <small class="text-info"><a href="https://fontawesome.com/v4.7.0">Font awesome</a></small></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">fa fa-</div>
                                </div>
                                <input class="form-control form-control-lg col-md-12" name="icon" id="social_icon">
                            </div>

                        </div>
                        <div class="form-row">
                            <label><strong>Link</strong> </label>
                            <input type="url" class="form-control form-control-lg col-md-12" name="link" id="social_link">
                        </div>
                        <div class="form-row">

                            <div class="col-md-12">
                                <hr/>
                                <button type="submit" class="btn btn-block btn-tsk mt-2"><i class="fa fa-save"></i> Update</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <form action="" method="post" id="social_delete_form">
        @csrf</form>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click','.create_social_btn', function(){
                $('#create_social_form').attr('action',$(this).data('url'));
            });
            $(document).on('click','.edit_social_btn', function(){
                $('#edit_social_form').attr('action',$(this).data('url'));
                $('#social_name').val($(this).data('name'));
                $('#social_link').val($(this).data('link'));
                $('#social_icon').val($(this).data('icon'));
            });
            $(document).on('click','.delete_social_btn', function(){
                $('#social_delete_form').attr('action',$(this).data('url'));
                if(confirm('Are you sure delete social link?')){
                    $('#social_delete_form').submit();
                }else{
                    return false;
                }
            });
        })
    </script>
    @endsection