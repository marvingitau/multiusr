
@extends('backend.master')
@section('title',ucfirst(str_replace('-',' ',$section)))
@section('content')
    <div class="card  mb-4">
        <div class="card-header bg-white">
            <h2><i class="fa fa-edit "></i> {{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small></h2>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form action="{{route('admin.web_setting.section.store',['contact','all-section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="address">Office Address</label>
                            <textarea type="text" class="form-control" id="address" name="address">{{web_setting()->contact_all_section_address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{web_setting()->contact_all_section_email}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{web_setting()->contact_all_section_phone}}">
                        </div>
                        <div class="form-group">
                            <label for="fax">Fax Number</label>
                            <input type="text" class="form-control" id="fax" name="fax" value="{{web_setting()->contact_all_section_fax}}">
                        </div>
                        <div class="form-group">
                            <label for="map">Map Script</label>
                            <textarea class="form-control" id="map" name="map">{{web_setting()->contact_all_section_map}}</textarea>
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