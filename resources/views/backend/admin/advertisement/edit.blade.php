@extends('backend.master')
@section('title','Advertisement ')
@section('content')
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            <h4> Edit Advertisement
                <a class="btn btn-tsk btn-square float-right"  href="{{route('admin.advertisement')}}">View All Ad</a></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <form role="form" method="post" action="{{route('admin.advertisement.update',$advertisement->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label><strong>Select Advertisement Type</strong> </label>
                                        <select name="type" class="form-control" onchange="changeForm(this.value)">
                                            <option value="1" {{$advertisement->type === 1?'selected':''}}>BANNER</option>
                                            <option value="2" {{$advertisement->type === 2?'selected':''}}>SCRIPT</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label><strong>Select Advertisement Size</strong> </label>
                                        <select name="size" class="form-control">
                                            <option value="1" {{$advertisement->size === 1?'selected':''}}>300 X 250</option>
                                            <option value="2" {{$advertisement->size === 2?'selected':''}}>728 X 90</option>
                                            <option value="3" {{$advertisement->size === 3?'selected':''}}>300 X 600</option>
                                            <option value="4" {{$advertisement->size === 4?'selected':''}}>970 X 250</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="" id="urlBannerDiv" style="display: {{$advertisement->type === 1?'block':'none'}}">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label><strong>Redirect Url</strong> </label>
                                            <input type="text" name="redirect_url" class="form-control" value="{{$advertisement->redirect_url}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label><strong>Banner</strong> </label><br/>
                                            <input type="file" name="image">
                                            <img src="{{asset('assets/backend/image/advertisement/'.$advertisement->image)}}" alt="Ad" style="height:80px; "/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" style="display: {{$advertisement->type === 1?'none':'block'}}" id="scriptDiv">
                                    <div class="col-sm-12">
                                        <label><strong>Script</strong> </label><br/>
                                        <textarea  name="script"  class="form-control" rows="3" placeholder="Script will be here" >@php echo $advertisement->script ; @endphp

                                </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label class=""><strong>IS ACTIVE</strong></label>
                                    </div>
                                    <div class="col-sm-3">

                                        <input data-toggle="toggle" checked data-onstyle="success" {{!$advertisement->is_active?"":'checked'}} data-offstyle="danger" data-width="100%" data-height="30px" id="is_active" type="checkbox" name="is_active">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-tsk btn-lg btn-square btn-block">Update</button>
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
        $(document).ready(function () {
            var status = '@php echo $advertisement->is_active?'on':'off' ;@endphp';
            $('#is_active').bootstrapToggle(status)
        })
        function changeForm(adType) {

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