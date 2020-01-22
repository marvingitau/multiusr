@extends('frontend.master')

@section('title','Profile')

@section('style')

    <link href="{{asset('assets/plugin/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    @include('frontend.partials.breadcrumb',['title'=>'Profile','item'=>['Dashboard'=>route('user.dashboard'),'Profile'=>null]])

    <!-- job-details-section start  -->

    <div class="job-details-section pt-4 padd-bottom-120">

        <div class="container">

            <div class="row">

                <aside class="col-lg-4">

                  @include('frontend.users.sidebar')

                    <div class="text-center">

                        <?php echo show_ad(3) ?>

                    </div>

                </aside>

                <main class="col-lg-8">

                    <div class="inner-main-content">

                        <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">@csrf

                        <div class="row">

                            <div class="col ">

                                <h3 class="">

                                    <i class="fa fa-user"></i> PROFILE

                                </h3>

                                <hr/>

                            </div>

                        </div>

                        <div class="row mt-4">

                            <div class="col-md-12">

                                <div class="form-row">

                                    <div class="form-group col-md text-center">

                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">

                                            <div class="fileinput-new thumbnail " style="width: 150px; height: 150px;"

                                                 data-trigger="fileinput">

                                                <img style="width: 150px"

                                                     src="{{$user->picture_path()}}" alt="...">

                                            </div>

                                            <div class="fileinput-preview fileinput-exists thumbnail"

                                                 style="max-width: 150px; max-height: 150px"></div>



                                            <div class="img-input-div text-center pt-2">

                                                <span class="cmn-btn btn-file  ">

                                                    <span class="fileinput-new bold uppercase text-white"><i

                                                                class="fa fa-file-image-o"></i> Select image</span>

                                                    <span class="fileinput-exists bold uppercase"><i

                                                                class="fa fa-edit"></i> Change</span>

                                                    <input type="file" name="picture" accept="image/*">

                                                </span>

                                                <a href="#" class="cmn-btn btn-danger bg-danger fileinput-exists bold uppercase ml-2"

                                                   data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>

                                            </div>

                                            @if ($errors->has('picture'))

                                                <small class="text-danger">{{ $errors->first('picture') }}</small>

                                            @endif

                                        </div>

                                    </div>

                                    <div class="col-md">

                                        <div class="form-row">

                                            <div class="form-group col">

                                                <label><small>First Name</small></label>

                                                <input type="text" name="first_name" placeholder="First Name" value="{{$user->first_name}}">

                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col">

                                                <label><small>Last Name</small></label>

                                                <input type="text"  name="last_name" placeholder="Last Name" value="{{$user->last_name}}">

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class="form-row">

                                    <div class="form-group col-md">

                                        <label><small>Email</small></label>

                                        <input type="email" name="email" placeholder="Email" value="{{$user->email}}">

                                    </div>

                                    <div class="form-group col-md">

                                        <label><small>Gender</small></label>

                                        <select name="sex" >

                                            <option value="M" {{$user->sex==='M'?'selected':null}}>Male</option>

                                            <option value="F" {{$user->sex==='F'?'selected':null}}>Female</option>

                                            {{-- <option value="O" {{$user->sex==='O'?'selected':null}}>Other</option> --}}

                                        </select>

                                    </div>

                                    <div class="form-group col-md">

                                        <label><small>Marital Status</small></label>

                                        <select name="marital_status_id" >

                                            <!-- @foreach($attributes->getAttr('marital_status') as $marital_status)

                                                <option value="{{$marital_status->id}}" {{$user->marital_status_id===$marital_status->id?'selected':''}}>{{$marital_status->name}}</option>

                                            @endforeach -->
                                            <option value=1  {{$user->marital_status_id===1?'selected':''}} > Married </option>
                                            <option value=2  {{$user->marital_status_id===2?'selected':''}}>Single </option>

                                        </select>

                                    </div>

                                </div>



                                <!-- {{-- <div class="form-row d-non">

                                    <div class="form-group col-md">

                                        <label><small>Father's Name</small></label>

                                        <input type="text" name="father_name" placeholder="Father's Name" value="{{$user->father_name}}">

                                    </div>

                                    <div class="form-group col-md">

                                        <label><small>Mother's Name</small></label>

                                        <input type="text" name="mother_name" placeholder="Mother's Name" value="{{$user->mother_name}}">

                                    </div>

                                </div> --}} -->

                                <div class="form-row">

                                    <div class="form-group col-md">

                                        <label><small>Country</small></label>

                                        <select name="country_id" class="location" id="country">

                                            <option value="">Select Country</option>

                                            @foreach($locations['country']['option'] as $country)

                                                <option value="{{$country->id}}" {{$country->id === optional($locations['country']['selected'])->id?'selected':''}}>{{$country->full_name}}</option>

                                            @endforeach

                                        </select>



                                    </div>

                                    <!-- {{-- <div class="form-group col-md">

                                        <label><small>State</small></label>

                                        <select name="state_id" class="location" id="state">

                                            <option value="">Select State</option>

                                            @foreach($locations['state']['option'] as $state)

                                                <option value="{{$state->id}}" {{$state->id === optional($locations['state']['selected'])->id?'selected':''}}>{{$state->name}}</option>

                                            @endforeach

                                        </select>

                                    </div> --}} -->

                                    <!-- {{-- <div class="form-group col-md">

                                        <label><small>City</small></label>

                                        <select name="city_id" class="location" id="city">

                                            <option value="">Select City</option>

                                            @foreach($locations['city']['option'] as $city)

                                                <option value="{{$city->id}}" {{$city->id === optional($locations['city']['selected'])->id?'selected':''}}>{{$city->name}}</option>

                                            @endforeach

                                        </select>

                                    </div> --}} -->

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md">

                                        <label><small>Address</small></label>

                                        <textarea  name="address" placeholder="Address">{{ ($user->address)}}</textarea>

                                    </div>

                                    <!-- {{-- <div class="form-group col-md">

                                        <label><small>Permanent Address</small></label>

                                        <textarea  name="permanent_address" placeholder="Permanent Address">{{$user->permanent_address}}</textarea>

                                    </div> --}} -->

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md">

                                        <label><small>Date Of Birth</small></label>

                                        <input type="text" name="dob" placeholder="Date Of Birth" id="dob" autocomplete="off" value="{{date('d-m-Y',strtotime($user->dob))}}">

                                    </div>

                                    {{-- <div class="form-group col-md">

                                        <label><small>Nationality</small></label>

                                        <input type="text" name="nationality" placeholder="Nationality" value="{{$user->nationality}}">

                                    </div> --}}

                                    <div class="form-group col-md">

                                        <label><small>National ID No.</small></label>

                                        <input type="text" name="nid_no" placeholder="###############" value="{{$user->nid_no}}">

                                    </div>

                                    <div class="form-group col-md">

                                        <label><small>Phone</small></label>

                                        <input type="text" name="phone" placeholder="Phone" value="{{$user->phone}}">

                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md">

                                        <label><small>Select Experience</small></label>

                                        <select name="experience_id" >

                                            

                                            @foreach($attributes->getAttr('experience') as $experience)

                                                <option value="{{$experience->id}}" {{$user->experience_id==$experience->id?'selected':''}}>{{$experience->name}}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group col-md">

                                        <label><small>Select Career Level</small></label>

                                        <select name="career_level_id" >

                                            

                                            @foreach($attributes->getAttr('career_level') as $career_level)

                                                {{$career_level }}

                                                <option value="{{$career_level->id}}" {{$user->career_level_id==$career_level->id?'selected':''}}>{{$career_level->name}}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <!--<div class="form-group col-md">-->

                                    <!--    <label><small>Select Industry</small></label>-->

                                    <!--    <select name="industry_id" >-->

                                            

                                    <!--        @foreach($attributes->getAttr('industry') as $industry)-->

                                    <!--            <option value="{{$industry->id}}" {{$user->industry_id===$industry->id?'selected':''}}>{{$industry->name}}</option>-->

                                    <!--        @endforeach-->

                                    <!--    </select>-->

                                    <!--</div>-->

                                    <div class="form-group col-md">

                                        <label><small>Select Functional Area</small></label>

                                        <select name="functional_area_id" >

                                            

                                            @foreach($attributes->getAttr('functional_area') as $functional_area)

                                                <option value="{{$functional_area->id}}" {{$user->functional_area_id===$functional_area->id?'selected':''}}>{{$functional_area->name}}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <div class="form-row">

                                    <!--<div class="form-group col-md">-->

                                    <!--    <label><small>Current Salary</small></label>-->

                                    <!--    <input type="text" name="current_salary" placeholder="0.00" value="{{$user->current_salary}}">-->

                                    <!--</div>-->

                                    <!--<div class="form-group col-md">-->

                                    <!--    <label><small>Expected Salary</small></label>-->

                                    <!--    <input type="text" name="expected_salary" placeholder="0.00" value="{{$user->expected_salary}}">-->

                                    <!--</div>-->

                                    {{-- <div class="form-group col-md">

                                        <label><small>Salary Currency</small></label>

                                        <select name="currency_id" >

                                            

                                            @foreach($attributes->getAttr('currency') as $currency)

                                                <option value="{{$currency->id}}" {{$user->currency_id===$currency->id?'selected':''}}>{{$currency->name}}</option>

                                            @endforeach

                                        </select>



                                    </div> --}}

                                </div>



                                <div class="form-row">

                                <input type="hidden" name="typeOfUser" value="{{ $newUser4 }}">

                                    <div class="form-group col-md">

                                        <button type="submit" class="cmn-btn btn-block">UPDATE PROFILE</button>

                                    </div>

                                </div>

                            </div>



                        </div>

                        </form>

                    </div>

                </main>



            </div>

        </div>

    </div>

    <!-- job-details-section end  -->
    @if(auth()->user()->popStatus == 1)
       
        <!-- Modal -->
        <div class="modal fade" id="modal-1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-0 border-0">
                    <div class="modal-header">
                        <h5 class="modal-title">Please Fill OR UPDATE </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled text-danger">
                            <li > My RESUME</li>
                            <li > Manage PROFILE</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif





@endsection

@section('script')

    <script src="{{asset('assets/plugin/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>



    <script type="text/javascript">

    jQuery(document).ready(function($){
        $('#modal-1').modal('show');
    })
        
    //     $('#md-close').on('click', function(e) {
    //   $('#modal-1').toggleClass("md-show"); //you can list several class names 
    //   e.preventDefault();
    // });



        $('#country').select2({width:'100%'});

        $('#state').select2({width:'100%'});

        $('#city').select2({width:'100%'});

        $(document).ready(function () {

            $('#modal-1').toggleClass("md-show"); //you can list several class names 

            $('#dob').datepicker({

                changeMonth: true,

                changeYear: true,

                yearRange: '-100:+0',

                dateFormat: "dd-mm-yy"

            });

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

                    url:'{{route('user.location_change')}}',

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

        });



       

    </script>

@endsection