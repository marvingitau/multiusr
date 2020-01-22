

@extends('backend.employer.master')
@section('title','Profile')
@section('content')
    <form action="{{route('employer.profile.update')}}" method="post" enctype="multipart/form-data">@csrf
<div class="card ">
    <div class="card-body border-bottom">
        <h4>Company Information
            <div class="float-right">
                <input  data-toggle="toggle" {{$employee->subscribe?'checked':''}} data-on="Subscribe On" data-off="Subscribe Off" data-onstyle="success" data-offstyle="danger"  type="checkbox" name="subscribe">

            </div>

        </h4>
    </div>
    <div class="card-body">
        <h6>Social Info</h6>
        <div class="form-row mb-4">
            <div class="col-md">
                @forelse($employee->socials as $social)

                    <div class="btn-group  mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="{{$social->link}}">
                        <button type="button" class="btn btn-tsk" style="background: #{{$social->color}}"><i class="fa fa-{{$social->icon}}"></i> {{$social->name}}</button>
                        <button type="button" class="btn btn-outline-tsk edit_social_btn"
                                data-id="{{$social->id}}"
                                data-name="{{$social->name}}"
                                data-color="{{$social->color}}"
                                data-link="{{$social->link}}"
                                data-icon="{{$social->icon}}"
                                data-toggle="modal" data-target="#edit_model"><i class="fa fa-pencil"></i> </button>
                        <button type="button" class="btn btn-outline-danger delete_social_btn" data-id="{{$social->id}}"><i class="fa fa-trash"></i></button>
                    </div>
                @empty

                @endforelse
                <div class="btn-group  mr-1 mb-1">
                    <a class="btn btn-tsk " data-toggle="modal" data-target="#create_social_model"> <i class="fa fa-plus"></i> Add New Social</a>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4  text-center bg-light p-3" style="height: 145px" data-toggle="tooltip" data-placement="top" title="Company Logo">
                <div class="w-100" style="height: 90px">
                    <img src="{{$employee->company_logo()}}" class="img-thumbnail" style="height: 80px">
                </div>
                <input type="file" class="d-none" id="logo" name="company_logo">
                <label for="logo" class="btn btn-sm btn-outline-tsk btn-block btn-square">Change Logo</label>
            </div>
            <div class="form-group col-md">
                <div class="form-row">
                    <div class="form-group col-md">
                        <input type="text" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Company Name" placeholder="Company Name" name="company_name" value="{{$employee->company_name}}">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg bg-white" readonly data-toggle="tooltip" data-placement="top" title="Username" placeholder="Username" value="{{$employee->username}}">

                        </div>
                    </div>
                    <div class="form-group col-md">
                        <input type="text" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Company Email" placeholder="Company Email" name="email" value="{{$employee->email}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select Manufacture">
                        <select type="text" class="form-control form-control-lg select2" name="industry_id">
                            <option value="">Select Manufacture</option>
                            @foreach($attributes->getAttr('industry') as $industry)
                                <option value="{{$industry->id}}" {{$employee->industry_id===$industry->id?'selected':''}}>{{$industry->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md"  data-toggle="tooltip" data-placement="top" title="Select Ownership">
                        <select type="text" class="form-control form-control-lg select2" name="ownership_type_id">
                            <option value="">Select Ownership</option>
                            @foreach($attributes->getAttr('ownership_types') as $ownership_types)
                                <option value="{{$ownership_types->id}}" {{$employee->ownership_type_id===$ownership_types->id?'selected':''}}>{{$ownership_types->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Description">
                <textarea class="form-control" name="description"  placeholder="Description" id="description"  rows="10">{{$employee->description}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md">
                <div class="form-row">
                    <div class="form-group col">
                        <div class="input-group">
                            <textarea class="form-control form-control-lg" name="address" style="min-height: 90px" data-toggle="tooltip" data-placement="top" title="Address" placeholder="Address">{{$employee->address}}</textarea>


                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select Country">
                        <select type="text" class="form-control form-control-lg location " id="country" name="country_id">
                            <option value="">Select Country</option>
                            @foreach($locations['country']['option'] as $country)
                                <option value="{{$country->id}}" {{$country->id === optional($locations['country']['selected'])->id?'selected':''}}>{{$country->full_name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select State">
                        <select type="text" class="form-control form-control-lg  location" id="state" name="state_id">
                            <option value="">Select State</option>
                            @foreach($locations['state']['option'] as $state)
                                <option value="{{$state->id}}" {{$state->id === optional($locations['state']['selected'])->id?'selected':''}}>{{$state->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select City" >
                        <select type="text" class="form-control form-control-lg location" id="city" name="city_id">
                            <option value="">Select City</option>
                            @foreach($locations['city']['option'] as $city)
                                <option value="{{$city->id}}" {{$city->id === optional($locations['city']['selected'])->id?'selected':''}}>{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group col-md">
                <div class="form-row">
                    <div class="form-group col-md">
                        <div class="input-group">
                            <input type="number" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Number of office" placeholder="Number of office" name="number_of_office" value="{{$employee->number_of_office}}">

                        </div>
                    </div>
                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Select Num. of Employee">
                        <select type="text" class="form-control form-control-lg select2" name="number_of_employee_id">
                            <option value="">Select Num. of Employee</option>
                            @foreach($attributes->getAttr('number_of_employee') as $number_of_employee)
                                <option value="{{$number_of_employee->id}}" {{$employee->number_of_employee_id===$number_of_employee->id?'selected':''}}>{{$number_of_employee->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md" data-toggle="tooltip" data-placement="top" title="Established in">
                        <select type="text" class="form-control form-control-lg select2" name="establish_year">
                            <option value="">Established in</option>
                            @foreach(range(date("Y"), 1910) as $year)
                                <option value="{{$year}}" {{$employee->establish_year===$year?'selected':''}}>{{$year}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-fax"></i> </div>
                            </div>
                            <input type="text" name="fax" value="{{$employee->fax}}" class="form-control form-control-lg" data-toggle="tooltip" data-placement="top" title="Fax" placeholder="Fax">

                        </div>
                    </div>
                    <div class="form-group col-md">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-phone"></i> </div>
                            </div>
                            <input type="text" class="form-control form-control-lg" name="phone" value="{{$employee->phone}}" data-toggle="tooltip" data-placement="top" title="Phone" placeholder="Phone">

                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-globe"></i> </div>
                            </div>
                            <input type="text" class="form-control form-control-lg" name="web" value="{{$employee->web}}" data-toggle="tooltip" data-placement="top" title="Website" placeholder="Website">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md">
                <div class="form-row">
                    <div class="form-group col-md">
                        <textarea class="form-control" data-toggle="tooltip" name="map_script" rows="2" data-placement="top" title="Google Map Script" placeholder="Google Map Script"><?php echo $employee->map_script?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md">
                <hr/>
                <button type="submit" class="btn btn-tsk btn-square btn-block">Update Profile <i class="fa fa-arrow-right"></i> </button>
            </div>
        </div>
    </div>
</div>

    </form>
    <div class="modal fade" id="create_social_model" tabindex="-1" role="dialog" aria-labelledby="create_social_model" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Social</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('employer.profile.social.store')}}" method="post">@csrf
                        <input type="hidden" name="company_id" value="{{$employee->id}}">
                        <div class="form-row">
                            <label><strong>Name</strong> </label>
                            <input class="form-control form-control-lg col-md-12" name="name">
                        </div>
                        <div class="form-row">
                            <label><strong>Color</strong> </label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">#</div>
                              </div>
                              <input class="form-control form-control-lg col-md-12" name="color" placeholder="ffffff">
                          </div>
                        </div>
                        <div class="form-row">
                            <label><strong>Icon</strong> <small class="text-info"><a href="https://fontawesome.com/v4.7.0">Font awesome</a></small></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">fa fa-</div>
                                </div>
                                <input class="form-control form-control-lg col-md-12" name="icon">
                            </div>

                        </div>
                        <div class="form-row">
                            <label><strong>Link</strong> </label>
                            <input type="url" class="form-control form-control-lg col-md-12" name="link">
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
    <div class="modal fade" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="edit_model" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Social</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('employer.profile.social.update')}}" method="post">@csrf
                        <input type="hidden" name="id" id="social_id">
                        <input type="hidden" name="company_id" value="{{$employee->id}}">
                        <div class="form-row">
                            <label><strong>Name</strong> </label>
                            <input class="form-control form-control-lg col-md-12" name="name" id="social_name">
                        </div>
                        <div class="form-row">
                            <label><strong>Color</strong> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">#</div>
                                </div>
                                <input class="form-control form-control-lg col-md-12" name="color" placeholder="ffffff" id="social_color">
                            </div>
                        </div>
                        <div class="form-row">
                            <label><strong>Icon</strong> <small class="text-info"><a href="https://fontawesome.com/v4.7.0">Font awesome</a></small></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">fa fa-</div>
                                </div>
                                <input class="form-control form-control-lg col-md-12" name="icon" id="social_icon">
                            </div>

                        </div>
                        <div class="form-row">
                            <label><strong>Link</strong> </label>
                            <input type="url" class="form-control form-control-lg col-md-12" name="link" id="social_link">
                        </div>
                        <div class="form-row">

                            <div class="col-md-12">
                                <hr/>
                                <button type="submit" class="btn btn-block btn-tsk mt-2"><i class="fa fa-save"></i> Update</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <form action="{{route('employer.profile.social.delete')}}" method="post" id="social_delete_form">
        <input type="hidden" name="delete_id" id="delete_id">
        @csrf</form>
@endsection
@section('script')
    <script type="text/javascript">

        $('#country').select2({width:'100%'});
        $('#state').select2({width:'100%'});
        $('#city').select2({width:'100%'});
        $(document).ready(function () {
            $(document).on('click','.edit_social_btn', function(){
                $('#social_id').val($(this).data('id'));
                $('#social_name').val($(this).data('name'));
                $('#social_color').val($(this).data('color'));
                $('#social_link').val($(this).data('link'));
                $('#social_icon').val($(this).data('icon'));
            });
            $(document).on('click','.delete_social_btn', function(){
                $('#delete_id').val($(this).data('id'));
                if(confirm('Are you sure delete social link?')){
                    $('#social_delete_form').submit();
                }else{
                    return false;
                }
            });

          $(document).on('change','.location',function () {
              $.ajax({
                 url:'{{route('employer.location_change')}}',
                  data:{
                      'country_id':$('#country').val(),
                      'state_id':$('#state').val(),
                      'city_id':$('#city').val()
                  },
                  success:function (res) {
                      $('#country').empty().select2({
                          data: res.country,
                          width:'100%'
                      });
                      $('#state').empty().select2({
                          data: res.state,
                          width:'100%'
                      });
                      $('#city').empty().select2({
                          data: res.city,
                          width:'100%'
                      });
                  }
              });
          })
        })

      
    </script>
@endsection
