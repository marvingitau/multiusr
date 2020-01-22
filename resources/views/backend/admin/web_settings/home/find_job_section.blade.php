
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
                    <form action="{{route('admin.web_setting.section.store',['home','find_job_section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="title_1">Title-1</label>
                            <input type="text" class="form-control form-control-lg" id="title_1" name="title_1" value="{{web_setting()->home_find_job_section_title_1}}">
                        </div>
                        <div class="form-group">
                            <label for="title_2">Title-2</label>
                            <input type="text" class="form-control form-control-lg" id="title_2" name="title_2" value="{{web_setting()->home_find_job_section_title_2}}">
                        </div>
                        <div class="form-group">
                            <label for="find_job_bg_image">Image</label>
                            <div class="img-responsive">
                                <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/find_job_bg_image.jpg')}}" style="height: 100px">
                            </div>
                            <label for="find_job_bg_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(jpg)</small></label>
                            <input type="file"  id="find_job_bg_image" name="find_job_bg_image[jpg]" class="d-none">
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

@endsection