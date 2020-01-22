@extends('frontend.master')

<style>
input[type=checkbox] {
    display: block !important;
}
</style>

@section('title','Manage Resume')

@section('content')

    @include('frontend.partials.breadcrumb',['title'=>'Manage Resume','item'=>['Dashboard'=>route('user.dashboard'),'Manage Resume'=>null]])

    <!-- job-details-section start  -->

    <div class="job-details-section pt-md-4 padd-bottom-120">

        <div class="container">

            <div class="row">

                <aside class="col-lg-4">

                  @include('frontend.users.sidebar')

                    <div class="text-center">

                      <?php echo show_ad(3) ?>

                    </div>

                    <div class="text-center mt-2 mb-2">

                        <?php echo show_ad(1) ?>

                    </div>

                </aside>

                <main class="col-lg-8">

                    <div class="inner-main-content">

                        <div class="row">

                            <div class="col ">

                                <h3 class="">

                                    <i class="fa fa-file-text"></i> Manage Resume



                                    <!-- <a   class="btn btn-sm btn-outline-secondary float-md-right" data-toggle="modal" data-target="#upload_cv_modal"><i class="fa fa-file-pdf-o"></i> Upload PDF</a> -->

                                </h3>

                                <hr/>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col ">

                               <div class="form-row">

                                   <div class="form-group col">

                                       <p class="content-title">Summary <a  onclick="toggleSummary_edit();" id="summery_edit_btn" class="text-info float-right"><small>Edit</small></a></p>

                                       <p class="mt-3" id="summery_text">{{$user->cv_summary}}</p>

                                     <form  method="post" action="{{route('user.resume.update_summary')}}
" id="summery_edit_form" class="d-none mt-3">@csrf

                                         <textarea class="form-control" name="cv_summary" id="summery_input" >{{$user->cv_summary}}</textarea>

                                         <button type="submit" class="cmn-btn mt-4">Update</button>

                                     </form>

                                   </div>

                               </div>

                               <div class="form-row">

                                   <div class="form-group col">

                                       <p class="content-title">Experience <a  data-toggle="modal" data-target="#experience_create_modal" class="text-info  float-right"><small>Add New</small></a></p>

                                       @forelse($user->cvExperience as $cvExperience)

                                       <div class="job-post">

                                           <div class="job-post-header">

                                               <h6 class="title">{{$cvExperience->title}}</h6>

                                               <hr/>

                                               <p class="title font-weight-bold">{{$cvExperience->company}}</p>

                                               <div class="job-post-meta">

                                                   <div class="company-details">

                                                       <small class="company-name">{{date('d M, Y',strtotime($cvExperience->start_date))}} - {{$cvExperience->end_date?date('d M, Y',strtotime($cvExperience->end_date)):'Running'}} {{count($cvExperience->address())?'|':null}} {{implode(' , ',$cvExperience->address())}}</small>

                                                   </div>

                                               </div>

                                           </div>

                                           <div class="job-post-details">

                                               <p>{{$cvExperience->description}}</p>

                                           </div>

                                           <div class="job-post-footer d-flex justify-content-between">

                                               <div class="footer-left">

                                                   <a href="#" class="job-post-time text-info exp_edit_btn"

                                                      data-url="{{route('user.resume.edit_experience',$cvExperience->id)}}"

                                                      data-title="{{$cvExperience->title}}"

                                                      data-company="{{$cvExperience->company}}"

                                                      data-country="{{$cvExperience->country_id}}"

                                                      data-state="{{$cvExperience->state_id}}"

                                                      data-city="{{$cvExperience->city_id}}"

                                                      data-start_date="{{date('d-m-Y',strtotime($cvExperience->start_date))}}"

                                                      data-end_date="{{$cvExperience->end_date?date('d-m-Y',strtotime($cvExperience->end_date)):""}}"

                                                      data-description="{{$cvExperience->description}}"

                                                      data-toggle="modal" data-target="#experience_edit_modal">Edit</a>

                                                   <button class="post-bookmark">

                                                       <a href="#" class="bookmark-text text-danger" onclick="confirm('Are you sure delete?')?$('#exp_delete_form_{{$cvExperience->id}}').submit():null">Delete</a>

                                                   </button>

                                                   <form action="{{route('user.resume.delete_experience',$cvExperience->id)}}" method="post" id="exp_delete_form_{{$cvExperience->id}}">@csrf</form>

                                               </div>

                                           </div>

                                       </div><!-- job-post end -->

                                       @empty

                                       <p class="text-warning">No experience.</p>

                                       @endforelse

                                   </div>

                               </div>

                               <div class="form-row">

                                   <div class="form-group col">

                                       <p class="content-title">Higher Education <a  data-toggle="modal" data-target="#education_create_modal" class="text-info float-right"><small>Add New</small></a></p>

                                       @forelse($user->cvEducation as $cvEducation)

                                           <div class="job-post">

                                               <div class="job-post-header">

                                                   <h6 class="title">{{optional($cvEducation->degreeLevel)->name}} <small>( {{$cvEducation->degree_title}} )</small> <small class="float-md-right">{{optional($cvEducation->major)->name}}</small></h6>

                                                   <hr/>

                                                   <div class="job-post-meta">

                                                       <div class="company-details">

                                                          <div class="row">

                                                              <p class="col-md-12"><small><strong>Institute</strong> </small> <small class="float-right">{{ucfirst($cvEducation->institute)}}</small></p>

                                                              <p class="col-md-12"><small><strong>Result</strong> </small> <small class="float-right">{{optional($cvEducation->resultType)->name}} :{{$cvEducation->result}}</small> </p>

                                                              <p class="col-md-12"><small><strong>Passing Years</strong> </small><small class="float-right"><strong>{{$cvEducation->passing_year?$cvEducation->passing_year:'RUNNING'}}</strong></small> </p>

                                                          </div>

                                                       </div>

                                                   </div>

                                               </div>

                                               <div class="job-post-details">



                                               </div>

                                               <div class="job-post-footer d-flex justify-content-between">

                                                   <div class="footer-left">

                                                       <a href="#" class="job-post-time text-info edu_edit_btn"

                                                          data-url="{{route('user.resume.edit_education',$cvEducation->id)}}"

                                                          data-country="{{$cvEducation->country_id}}"

                                                          data-state="{{$cvEducation->state_id}}"

                                                          data-city="{{$cvEducation->city_id}}"

                                                          data-degree_level="{{$cvEducation->degree_level_id}}"

                                                          data-degree_title="{{$cvEducation->degree_title}}"

                                                          data-major="{{$cvEducation->major_subject_id}}"

                                                          data-institute="{{$cvEducation->institute}}"

                                                          data-year="{{$cvEducation->year}}"

                                                          data-result="{{$cvEducation->result}}"

                                                          data-result_type_id="{{$cvEducation->result_type}}"

                                                          data-toggle="modal" data-target="#education_edit_modal">Edit</a>

                                                       <button class="post-bookmark">

                                                           <a href="#" class="bookmark-text text-danger" onclick="confirm('Are you sure delete?')?$('#edu_delete_form_{{$cvEducation->id}}').submit():null">Delete</a>

                                                       </button>

                                                       <form action="{{route('user.resume.delete_education',$cvEducation->id)}}" method="post" id="edu_delete_form_{{$cvEducation->id}}">@csrf</form>

                                                   </div>

                                                   <div class="footer-right ">

                                                       <small >{{implode(' , ',$cvExperience->address())}}</small>

                                                   </div>

                                               </div>

                                           </div><!-- job-post end -->

                                       @empty

                                           <p class="text-warning">No Education.</p>

                                       @endforelse



                                   </div>

                               </div>

                               <div class="form-row">

                                   <div class="form-group col">

                                       <p class="content-title">Skills <a  data-toggle="modal" data-target="#skill_create_modal" class="text-info float-right"><small>Add New</small></a></p>



                                       <div class="table-responsive mt-3">

                                           <table class="w-100 table-striped">

                                               <tbody>

                                               @forelse($user->cvSkill as $cvSkill)

                                               <tr>

                                                   <td>{{$cvSkill->skill->name}}</td>

                                                   <td>{{$cvSkill->experience->name}}</td>

                                                   <td class="text-right">

                                                        <a



                                                                data-url="{{route('user.resume.edit_skill',$cvSkill->id)}}"

                                                                data-skills="{{$cvSkill->skills_id}}"

                                                                data-experience="{{$cvSkill->experience_id}}"

                                                                data-toggle="modal" data-target="#skill_edit_modal"

                                                                class="btn-link text-info border-right pr-1 skill_edit_btn"><i class="fa fa-pencil"></i> </a>

                                                        <a class="btn-link text-danger pr-2" onclick="confirm('Are you sure delete?')?$('#skill_delete_form_{{$cvSkill->id}}').submit():null"><i class="fa fa-trash"></i> </a>

                                                       <form action="{{route('user.resume.delete_skill',$cvSkill->id)}}" method="post" id="skill_delete_form_{{$cvSkill->id}}">@csrf</form>

                                                   </td>

                                               </tr>

                                                   @empty

                                                   <tr>

                                                       <td colspan="3">No Skill</td>

                                                   </tr>

                                               @endforelse

                                               </tbody>

                                           </table>

                                       </div><!-- job-post end -->



                                   </div>

                               </div>

                               <div class="form-row">

                                   <div class="form-group col">

                                       <p class="content-title">Languages <a  data-toggle="modal" data-target="#lang_create_modal" class="text-info float-right"><small>Add New</small></a></p>

                                       <div class="table-responsive mt-3">

                                           <table class="w-100 table-striped">

                                               <tbody>

                                               @forelse($user->cvLanguage as $cvLanguage)

                                                   <tr>

                                                       <td>{{$cvLanguage->language->name}}</td>

                                                       <td>{{$cvLanguage->languageLevel->name}}</td>

                                                       <td class="text-right">

                                                           <a



                                                                   data-url="{{route('user.resume.edit_language',$cvLanguage->id)}}"

                                                                   data-language="{{$cvLanguage->language_id}}"

                                                                   data-language_level="{{$cvLanguage->language_level_id}}"

                                                                   data-toggle="modal" data-target="#lang_edit_modal"

                                                                   class="btn-link text-info border-right pr-1 lang_edit_btn"><i class="fa fa-pencil"></i> </a>

                                                           <a class="btn-link text-danger pr-2" onclick="confirm('Are you sure delete?')?$('#language_delete_form_{{$cvLanguage->id}}').submit():null"><i class="fa fa-trash"></i> </a>

                                                           <form action="{{route('user.resume.delete_language',$cvLanguage->id)}}" method="post" id="language_delete_form_{{$cvLanguage->id}}">@csrf</form>

                                                       </td>

                                                   </tr>

                                               @empty

                                                   <tr>

                                                       <td colspan="3">No Skill</td>

                                                   </tr>

                                               @endforelse

                                               </tbody>

                                           </table>

                                       </div><!-- job-post end -->



                                   </div>

                               </div>
                               

                               <form class="d-flex">

                              <div> <label><input type="radio" class="radio-inline"  name="truthBox" value="agree">BY checking this You Agree that the <br> informatiomation U've given is the truth.</label></div><hr>
                              <div> <label> <input type="radio" class="radio-inline" name="truthBox" value="disagree" checked>I don't agree. <label><div>                    
                               </form>
                              
                               <!-- @if(!is_null($typeOfUser))
                                 <a type="button" href="{{route('job')}}">Continue </a>
                                @endif -->
                                             <!-- Elis added this when user finished cv changes to continue with job application --> 
                               


                               </div>

                            </div>

                        </div>

                    </div>

                </main>



            </div>

            

        </div>

    </div>

    <!-- job-details-section end  -->

@include('frontend.users.resume_modal.experience_create')

@include('frontend.users.resume_modal.experience_edit')

@include('frontend.users.resume_modal.education_create')

@include('frontend.users.resume_modal.education_edit')

@include('frontend.users.resume_modal.skill_create')

@include('frontend.users.resume_modal.skill_edit')

@include('frontend.users.resume_modal.lang_create')

@include('frontend.users.resume_modal.lang_edit')

@include('frontend.users.resume_modal.upload_cv')

@endsection

@section('script')

    <script src="{{asset('assets/plugin/niceditor/nicEdit.js')}}"></script>

    <script type="text/javascript">

        var summery_input;

        $('.location').select2({

            width:'100%',

        });

        $('#edu_major_subject_id').select2({

            width:'100%',

        });

        $('#cre_exp_start_date').datepicker({ dateFormat: "dd-mm-yy"});

        $('#cre_exp_end_date').datepicker({

            dateFormat: "dd-mm-yy",

            showButtonPanel: true,

            closeText: 'Currently Working',

            onClose: function () {

                var event = arguments.callee.caller.caller.arguments[0];

                // If "Clear" gets clicked, then really clear it

                if ($(event.delegateTarget).hasClass('ui-datepicker-close')) {

                    $(this).val('');

                }

            }});

        $(document).on('click','.exp_edit_btn',function () {

            $('#exp_edit_form').attr('action',$(this).data('url'));

            $('#exp_edit_title').val($(this).data('title'));

            $('#exp_edit_company').val($(this).data('company'));

            var prefix = 'exp_edit';

            $.ajax({

                url:'{{route('user.location_change')}}',

                data:{

                    'country_id':$(this).data('country'),

                    'state_id':$(this).data('state'),

                    'city_id':$(this).data('city')

                },

                success:function (res) {

                    $('#'+prefix+'_country').empty().select2({

                        width:'100%',

                        data: res.country

                    });

                    $('#'+prefix+'_state').empty().select2({

                        width:'100%',

                        data: res.state

                    });

                    $('#'+prefix+'_city').empty().select2({

                        width:'100%',

                        data: res.city

                    });

                }

            });

            $('#cre_exp_edit_start_date').datepicker({ dateFormat: "dd-mm-yy"}).val($(this).data('start_date')).trigger('change');

            $('#cre_exp_edit_end_date').datepicker({

                dateFormat: "dd-mm-yy",

                showButtonPanel: true,

                closeText: 'Currently Working',

                onClose: function () {

                    var event = arguments.callee.caller.caller.arguments[0];

                    // If "Clear" gets clicked, then really clear it

                    if ($(event.delegateTarget).hasClass('ui-datepicker-close')) {

                        $(this).val('');

                    }

                }

            }).val($(this).data('end_date')).trigger('change');

            $('#exp_edit_description').val($(this).data('description'));

        });

        $(document).on('click','.edu_edit_btn',function () {

            $('#edu_edit_form').attr('action',$(this).data('url'));

            $('#edu_edit_degree_level').val($(this).data('degree_level'));

            $('#edu_edit_degree_title').val($(this).data('degree_title'));

            $('#edu_edit_major_subject_id').val($(this).data('major'));

            $('#edu_edit_institute').val($(this).data('institute'));

            $('#edu_edit_year').val($(this).data('year'));

            $('#edu_edit_result').val($(this).data('result'));

            $('#edu_edit_result_type').val($(this).data('result_type'));

            var prefix = 'edu_edit';

            $.ajax({

                url:'{{route('user.location_change')}}',

                data:{

                    'country_id':$(this).data('country'),

                    'state_id':$(this).data('state'),

                    'city_id':$(this).data('city')

                },

                success:function (res) {

                    $('#'+prefix+'_country').empty().select2({

                        width:'100%',

                        data: res.country

                    });

                    $('#'+prefix+'_state').empty().select2({

                        width:'100%',

                        data: res.state

                    });

                    $('#'+prefix+'_city').empty().select2({

                        width:'100%',

                        data: res.city

                    });

                }

            });

        });



        $(document).on('click','.skill_edit_btn',function () {

            $('#skill_edit_form').attr('action',$(this).data('url'));

            $('#skill_edit_skills_id').val($(this).data('skills'));

            $('#skill_edit_experience_id').val($(this).data('experience'));

        });

        $(document).on('click','.lang_edit_btn',function () {

            $('#lang_edit_form').attr('action',$(this).data('url'));

            $('#lang_language_id').val($(this).data('language'));

            $('#lang_language_level_id').val($(this).data('language_level'));

        });



        function toggleSummary_edit() {

            if(!summery_input) {

                $('#summery_edit_btn').html('<small>View</small>');

                $('#summery_text').addClass('d-none');

                $('#summery_edit_form').removeClass('d-none');

                summery_input = new nicEditor({

                    iconsPath : '{{asset('assets/plugin/niceditor/nicEditorIcons.gif')}}',

                    fullPanel : true}).panelInstance('summery_input',{hasPanel : true});

            } else {

                summery_input.removeInstance('summery_input');

                summery_input = null;

                $('#summery_text').removeClass('d-none');

                $('#summery_edit_form').addClass('d-none');

                $('#summery_edit_btn').html('<small>Edit</small>');

            }

        }

        $(document).on('change','.location',function () {

            var prefix = $(this).data('prefix');

            changeLocation(prefix);



        });



        function changeLocation(prefix){

            $.ajax({

                url:'{{route('user.location_change')}}',

                data:{

                    'country_id':$('#'+prefix+'_country').val(),

                    'state_id':$('#'+prefix+'_state').val(),

                    'city_id':$('#'+prefix+'_city').val()

                },

                success:function (res) {

                    $('#'+prefix+'_country').empty().select2({

                        width:'100%',

                        data: res.country

                    });

                    $('#'+prefix+'_state').empty().select2({

                        width:'100%',

                        data: res.state

                    });

                    $('#'+prefix+'_city').empty().select2({

                        width:'100%',

                        data: res.city

                    });

                }

            });

        }

        $(document).on('change','.location',function () {



        })

    </script>

@endsection