@extends('admin.layout.master')
@section('page_title', 'Subscribers')
@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="page-title uppercase bold"> Subscriber information </h3>
            <hr>
            @include('admin.layout.flash')
            <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-users font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Subscribers</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    @foreach($subs as $sub)
                        {{$sub->email}}, &nbsp;
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-envelope font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Send News Letter</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form" method="POST" action="{{route('subscribers.email')}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="subject" class="form-control input-lg" value="">
                            </div>
                            <div class="form-group">
                                <label>Email Message</label>
                                <textarea class="form-control" name="emailMessage" rows="10">
                                                	
                                                </textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="submit-btn btn btn-primary btn-lg btn-block login-button">
                                <i class="fa fa-paper-plane"></i> Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection