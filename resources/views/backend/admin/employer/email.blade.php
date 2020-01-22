@extends('backend.master')
@section('title', 'Send Email')
@section('content')

    <div class="card">
        <div class="card-body border-bottom">
            <h2><i class="fa fa-paper-plane"></i> Send Email</h2>
        </div>
        <div class="card-body">
            <form role="form" method="POST" action="{{route('admin.employer.send.mail')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <label>To</label>
                        <input type="email" name="emailto" class="form-control input-lg"
                               value="{{$employer->email}}">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="reciver" class="form-control input-lg"
                               value="{{$employer->company_name}}" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control input-lg" value="" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <label>Email Message</label>
                        <textarea class="form-control" name="emailMessage" rows="10" placeholder="message">

                                                </textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn btn btn-tsk btn-square font-weight-bold btn-lg btn-block ">
                        <i class="fa fa-paper-plane"></i> Send
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection