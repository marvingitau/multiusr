<html>
    <head>
        <title>
            JOB APP 
        </title>

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    </head>
    <body>


{{-- @extends('frontend.master')

@section('title','Jobs')

@section('content') --}}

        <form role="form"  method="POST" action="{{ route('upload.form',$id) }}" >
            @csrf
            {{-- @method() --}}
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" name="firstName" id="firstName">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastName" id="lastname">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" >
            </div>

            <div class="form-group">
                <label for="phone">Alt Phone</label>
                <input type="text" class="form-control" name="alt_phone" id="phone" >
            </div>


            <div class="form-group col-md "  data-toggle="tooltip" data-placement="top" title=" Date of Birth"> 
                <label for="dob">DOB</label>
                <input name="dob" type="date" class="form-control form-control-lg" id="dob" placeholder="Job Expired Date (Year-Month-Day)" autocomplete="off" value="">

            </div>

            <div class="form-group">
                <label for="employer">Current Employer</label>
                <textarea name="current_employer" rows="3" placeholder="Current Employer" id="employer"></textarea>
            </div>

            <div class="form-group">
                <label for="job">Current Job</label>
                <textarea name="current_role" rows="2" placeholder="Current Job" id="job"></textarea>
            </div>

            <div class="form-group">
                <label for="exp">Experience</label>
                <select name="experience" id="exp">

                    <option value="">Select Experience</option>
                    @foreach($attributes->getAttr('experience') as $experience)

                    <option value="{{$experience->id}}" >{{$experience->name}}</option>

                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <label for="agree">I acknowledge that the information provided above is truthful to the best * of my knowledge
                    Agree</label>
                <input type="checkbox" value="1" name="info_acknowledgement" id="agree">
            </div>



            <div class="form-group">
                <label for="ed">Highest level of education attained</label>
                <select name="education" id="ed">

                    <option value="">Select Education Level</option>
                    @foreach($attributes->getAttr('degree_level') as $degree_level)

                    <option value="{{$degree_level->id}}" >{{$degree_level->name}}</option>

                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <label for="colleage">Name of university you graduated with first degree from</label>
                <textarea name="institute" rows="2" placeholder="University Name" id="colleage"></textarea>
            </div>

            

<div class="form-group">
    <label for="colleage1">List any other degree(s) obtained including the University/Faculty/Degree Title/Grade
        (Classification)</label>
    <textarea name="other_degreeAndCollege" rows="2" placeholder="" id="colleage1"></textarea>
</div>

<div class="form-group">
    <label for="colleage3">List any other professional qualifications obtained e.g. CPA, CPS, ACCA etc.</label>
    <textarea name="other_qualifications" rows="2" placeholder="" id="colleage3"></textarea>
</div>



<div class="form-group col-md">  
    <label for="cv"> CV:</label>
                                    <input type="file" name="cv" id="cv">
    
                                    </div>





            <button type="submit" class="btn btn-info" >sub</button>

        </form>
        @if($errors->any())
         @foreach($errors as $err)
         {{ $err }}
         @endforeach
        @endif
        {{-- @endsection --}} 

        {{-- <script>
            var msg = '{{Session::get('integrity')}}';
            var exist = '{{Session::has('integrity')}}';
            if(exist){
              alert(msg);
            }
          </script> --}}


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
    </body>
</html>
