@extends('backend.master')

@section('title',"Users")

@section('content')

<form   method="post"  action="{{ route('backend.admin.store') }}">

    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                First Name: <input class="form-control" type="text" name="first_name" >
            </div>    
            
            <div class="form-group">
                Surname: <input class="form-control" type="text" name="last_name" >
            </div>            
            
            <div class="form-group">
                Your Username: <input class="form-control" type="text" name="username" >
            </div>    
            <div class="form-group">
                Email: <input class="form-control" type="mail" name="email" >
            </div>
            <div class="form-group">
                Gender
                <select name="sex" class="form-control">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                Password: <input class="form-control" type="password" name="password" >
            </div>
            <div class="form-group">
                Phone Number: <input class="form-control" type="num" name="phone" >
            </div>

            <div class="form-group">
                        Address: <textarea class="form-control"  name="address" ></textarea>
            </div>        
            <select class="form-control" name="role_id">
                <option value="1">Admin</option>
                <option value="3">KMRC</option>
                <option value="2">HR</option>
            </select>
            <input class="btn btn-success w-100" type="submit" value="submit">
        </div>
    </div>
</form>

<div class="jumbotron">
    
    <h2>Delete Priviledged User </h2>

    <form   method="get"  action="{{ route('backend.admin.delete') }}">
        <select class="form-control" name="role_id">
            <option value="1">Admin</option>
            <option value="3">KMRC</option>
            <option value="2">HR</option>
        </select>

        FName: <input class="form-control" type="text" name="first_name" >
        SName: <input class="form-control" type="text" name="last_name" >
        <input class="btn btn-primary" type="submit" value="submit">
    </form>

</div>

@endsection