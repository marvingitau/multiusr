@extends('backend.master')
@section('title','Package')
@section('content')
    <div class="card">
        <div class="card-body border-bottom">
            <h5>Package
                <a class="btn btn-tsk float-right mb-2" href="#" data-toggle="modal" data-target="#create_model"><i class="fa fa-plus"></i> Add Package</a>

            </h5>
        </div>
        <div class="card-body  p-0">
            <table class="table table-sm table-borderless  mb-0">
                <thead class="bg-tsk-o-1">
                <tr>
                    <th>Sl</th>
                    <th>Title </th>
                    <th>Price </th>
                    <th>Days </th>
                    <th>Limit </th>
                    <th>Package For </th>
                    <th>Status </th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($packages as $key=>$package)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$package->title}}</td>
                        <td>{{number_format($package->price)}} {{general_setting()->cur}}</td>
                        <td>{{$package->days}}</td>
                        <td>{{$package->num_of_listing}}</td>
                        <td>{{$package->package_for}}</td>
                        <td><span class="badge {{$package->status?'badge-success':'badge-danger'}}">{{$package->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-tsk edit_btn"
                               data-title="{{$package->title}}"
                               data-price="{{$package->price}}"
                               data-days="{{$package->days}}"
                               data-num_of_listing="{{$package->num_of_listing}}"
                               data-package_for="{{$package->package_for}}"
                               data-status="{{$package->status}}"
                               data-url="{{route('admin.package.update',[$package->id])}}"
                               data-toggle="modal"
                               data-target="#edit_model"><i class="fa fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-danger">No data found !</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
    <div class="modal fade" id="create_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.package.store')}}" method="post">@csrf
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Package Title</strong> </label>
                                <input class="form-control form-control-lg" name="title">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Package Price <small class="text-muted">( in {{general_setting()->cur}} )</small></strong> </label>
                                <input  class="form-control form-control-lg" name="price">
                            </div>
                            <div class="form-group col-md">
                                <label><strong>Interval </strong> </label>
                                <div class="input-group">
                                    <input type="number" class="form-control form-control-lg" name="days">
                                    <div class="input-group-append">
                                        <div class="input-group-text">Days</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>limit  </strong> </label>
                                <div class="input-group">
                                    <input class="form-control form-control-lg col-md-12" name="num_of_listing">
                                </div>
                            </div>


                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Package For</strong> </label>
                                <select name="package_for" class="form-control form-control-lg">
                                    <option value="seeker">Job Seeker</option>
                                    <option value="employer">Employer</option>
                                </select>

                            </div>
                            <div class="form-group col-md">
                                <label><strong>Status</strong> </label>
                                <input data-toggle="toggle" checked data-height="40px" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                            </div>

                        </div>
                        <div class="form-row">

                            <div class="col-md-12">
                                <hr/>
                                <button type="submit" class="btn btn-block btn-tsk mt-2"><i class="fa fa-save"></i> Save</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit_form" method="post" >@csrf
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Package Title</strong> </label>
                                <input class="form-control form-control-lg" name="title" id="title">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Package Price <small class="text-muted">( in {{general_setting()->cur}} )</small></strong> </label>
                                <input  class="form-control form-control-lg" name="price" id="price">
                            </div>
                            <div class="form-group col-md">
                                <label><strong>Interval </strong> </label>
                                <div class="input-group">
                                    <input type="number" class="form-control form-control-lg" name="days" id="days">
                                    <div class="input-group-append">
                                        <div class="input-group-text">Days</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>limit  </strong> </label>
                                <div class="input-group">
                                    <input class="form-control form-control-lg col-md-12" name="num_of_listing" id="num_of_listing">
                                </div>
                            </div>


                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label><strong>Package For</strong> </label>
                                <select name="package_for" class="form-control form-control-lg" id="package_for">
                                    <option value="seeker">Job Seeker</option>
                                    <option value="employer">Employer</option>
                                </select>

                            </div>
                            <div class="form-group col-md">
                                <label><strong>Status</strong> </label>
                                <input data-toggle="toggle" checked data-height="40px" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                            </div>

                        </div>
                        <div class="form-row">

                            <div class="col-md-12">
                                <hr/>
                                <button type="submit" class="btn btn-lg btn-block btn-tsk mt-2"><i class="fa fa-save"></i> Update</button>
                            </div>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $(document).on('click','.edit_btn', function(){
                $('#edit_form').attr('action',$(this).data('url'));
                $('#title').val($(this).data('title'));
                $('#price').val($(this).data('price'));
                $('#days').val($(this).data('days'));
                $('#num_of_listing').val($(this).data('num_of_listing'));
                $('#package_for').val($(this).data('package_for'));
                $('#status').bootstrapToggle($(this).data('status')?'on':'off')
            });
        });

    </script>
@endsection