@extends('backend.master')
@section('title', 'Broadcast Mail')
@section('content')
    <div class="card">
        <div class="card-body border-bottom">
            <h5><i class="fa fa-paper-plane"></i> Broadcast Email To User</h5>
        </div>
        <div class="card-body">
            <form role="form" method="POST" action="{{route('admin.employer.broadcast.email')}}" enctype="multipart/form-data">
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
                    <button type="submit" class=" btn btn-tsk btn-square btn-lg btn-block login-button">
                        <i class="fa fa-paper-plane"></i> Send
                    </button>
                </div>
            </form>
        </div>
    </div>
        </div>
    </div>
@endsection