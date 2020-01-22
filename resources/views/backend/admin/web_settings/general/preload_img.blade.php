@extends('backend.master')
@section('title',ucfirst(str_replace('-',' ',$section)))
@section('content')
    <div class="card mb-4">
        <div class="card-header bg-white ">
            <h2>{{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small></h2>

        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form action="{{route('admin.web_setting.section.store',['general','general-section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="preload_image">Preload Image <small>(gif)</small></label>
                                    <div class="img-responsive">
                                        <img src="{{asset('assets/frontend/img/general/general_section/preload_image.gif')}}" style="width: 50px">
                                    </div>
                                    <label for="preload_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(gif)</small></label>
                                    <input type="file"  id="preload_image" name="preload_image[gif]" class="d-none">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <hr/>
                            <button type="submit" class="btn btn-tsk btn-lg mt-4 btn-block"><i class="fa fa-save"></i> Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection