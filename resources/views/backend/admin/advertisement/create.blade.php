@extends('backend.master')
@section('title','Advertisement ')
@section('content')
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
           <h4> Create Advertisement
               <a class="btn btn-tsk btn-square float-right"  href="{{route('admin.advertisement')}}">View All Ad</a></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <form role="form" method="post" action="{{route('admin.advertisement.store')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label><strong>Select Advertisement Type</strong> </label>
                                        <select name="type" class="form-control form-control-lg" onchange="changeForm(this.value)">
                                            <option value="1">BANNER</option>
                                            <option value="2">SCRIPT</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label><strong>Select Advertisement Size</strong> </label>
                                        <select name="size" class="form-control form-control-lg">
                                            <option value="1">300 X 250</option>
                                            <option value="2">728 X 90</option>
                                            <option value="3">300 X 600</option>
                                            <option value="4">970 X 250</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="" id="urlBannerDiv">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label><strong>Redirect Url</strong> </label>
                                            <input type="text" name="redirect_url" class="form-control form-control-lg">
                                        </div>
                                        <div class="col-sm-6">
                                            <label><strong>Banner</strong> </label><br/>
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" style="display: none" id="scriptDiv">
                                    <div class="col-sm-12">
                                        <label><strong>Script</strong> </label><br/>
                                        <textarea  name="script"  class="form-control" rows="3" placeholder="Script will be here">

                                </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=""><strong>IS ACTIVE</strong></label>
                                    <input data-toggle="toggle" data-onstyle="success" checked data-offstyle="danger"  data-height="30px" type="checkbox" name="is_active">

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-tsk btn-lg btn-square btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function changeForm(adType) {
            console.log(adType);
            if(adType == 1) {
                document.getElementById('scriptDiv').style.display = 'none';
                document.getElementById('urlBannerDiv').style.display = 'block';
            } else {
                document.getElementById('scriptDiv').style.display = 'block';
                document.getElementById('urlBannerDiv').style.display = 'none';
            }
        }

    </script>
    @endsection