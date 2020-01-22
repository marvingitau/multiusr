<div class="modal fade" id="education_create_modal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Create New Education</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <div class="modal-body">

               <div class="row">

                   <div class="col">

                       <form action="{{route('user.resume.add_education')}}" method="post">@csrf

                           <div class="form-row">

                               <div class="form-group col-md">

                                   <label><small>Degree Level</small></label>

                                   <select name="degree_level_id" >

                                       <option value="">Select</option>

                                       @foreach($attributes->getAttr('degree_level') as $degree_level)

                                           <option value="{{$degree_level->id}}">{{$degree_level->name}}</option>

                                       @endforeach

                                   </select>

                               </div>

                           </div>

                           <div class="form-row">

                               <div class="form-group col-md">

                                   <label><small>Degree Title</small></label>

                                 <input type="text" name="degree_title">

                               </div>

                           </div>

                           <div class="form-row">

                               <div class="form-group col-md">

                                   <label><small>Major Subject</small></label>

                                   <select name="major_subject_id" id="edu_major_subject_id">

                                       <option value="">Select</option>

                                       @foreach($attributes->getAttr('major_subject') as $major_subject)

                                           <option value="{{$major_subject->id}}">{{$major_subject->name}}</option>

                                       @endforeach

                                   </select>

                               </div>

                           </div>

                           <div class="form-row">

                               <div class="form-group col-md">

                                   <label><small>Country</small></label>

                                   <select type="text" class="location " data-prefix="edu" id="edu_country" name="country_id">

                                       <option value="">Select Country</option>

                                       @foreach($locations['country']['option'] as $country)

                                           <option value="{{$country->id}}" {{$country->id === optional($locations['country']['selected'])->id?'selected':''}}>{{$country->full_name}}</option>

                                       @endforeach

                                   </select>

                               </div>

                               {{-- <div class="form-group col-md">

                                   <label><small>State</small></label>

                                   <select type="text" class="location " data-prefix="edu" id="edu_state" name="state_id">

                                       <option value="">Select Country</option>

                                       @foreach($locations['state']['option'] as $state)

                                           <option value="{{$state->id}}" {{$state->id === optional($locations['state']['selected'])->id?'selected':''}}>{{$state->full_name}}</option>

                                       @endforeach

                                   </select>

                               </div>

                               <div class="form-group col-md">

                                   <label><small>City</small></label>

                                   <select type="text" class="location " data-prefix="edu" id="edu_city" name="city_id">

                                       <option value="">Select Country</option>

                                       @foreach($locations['city']['option'] as $city)

                                           <option value="{{$city->id}}" {{$city->id === optional($locations['city']['selected'])->id?'selected':''}}>{{$city->full_name}}</option>

                                       @endforeach

                                   </select>

                               </div> --}}

                           </div>

                           <div class="form-row">

                               <div class="form-group col-md">

                                   <label><small>Institute</small></label>

                                   <input type="text" name="institute">

                               </div>

                               <div class="form-group col-md">

                                   <label><small>Select Year</small></label>

                                   <select type="text"  name="passing_year">

                                       <option value="">Running</option>

                                       @for($i=date('Y')-100 ;$i<=date('Y');$i++)

                                           <option value="{{$i}}" >{{$i}}</option>

                                       @endfor

                                   </select>

                               </div>

                           </div>

                           <div class="form-row">

                               <div class="form-group col-md">

                                   <label><small>Result</small></label>

                                   <input type="text" name="result">

                               </div>

                               <div class="form-group col-md">

                                   <label><small>Result Type</small></label>

                                   <select name="result_type_id" >

                                       @foreach($attributes->getAttr('result_type') as $result_type)

                                           <option value="{{$result_type->id}}">{{$result_type->name}}</option>

                                       @endforeach

                                   </select>

                               </div>

                           </div>

                           <div class="form-row">

                               <div class="form-group col-md">

                                   <button type="submit" class="cmn-btn btn-block">Save</button>

                               </div>

                           </div>

                       </form>

                   </div>

               </div>

            </div>





        </div>

    </div>

</div>