
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
                    <form action="{{route('admin.web_setting.section.store',['home','about_section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{web_setting()->home_about_section_title}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control form-control-lg"  name="description" >
{{ web_setting()->home_about_section_description}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="about_image">Image</label>
                            <div class="img-responsive">
                                <img src="{{asset('assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/about_image.png')}}" style="height: 100px">
                            </div>
                            <label for="about_image" class="btn btn-sm btn-outline-tsk mt-2">Change Image <small>(png)</small></label>
                            <input type="file"  id="about_image" name="about_image[png]" class="d-none">
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
@section('script')
 
@endsection