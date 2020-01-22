<div class="modal fade" id="experience_edit_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Experience</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <div class="row">
                   <div class="col">
                       <form action="" method="post" id="exp_edit_form">@csrf
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <label><small>Title *</small></label>
                                 <input type="text" name="title" id="exp_edit_title">
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <label><small>Company *</small></label>
                                 <input type="text" name="company" id="exp_edit_company">
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <label><small>Country</small></label>
                                   <select type="text" class="location " data-prefix="exp_edit" id="exp_edit_country" name="country_id">
                                       <option value="">Select Country</option>
                                       @foreach($locations['country']['option'] as $country)
                                           <option value="{{$country->id}}" {{$country->id === optional($locations['country']['selected'])->id?'selected':''}}>{{$country->full_name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                               <div class="form-group col-md">
                                   <label><small>State</small></label>
                                   <select type="text" class="location " data-prefix="exp_edit" id="exp_edit_state" name="state_id">
                                       <option value="">Select Country</option>
                                       @foreach($locations['state']['option'] as $state)
                                           <option value="{{$state->id}}" {{$state->id === optional($locations['state']['selected'])->id?'selected':''}}>{{$state->full_name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                               <div class="form-group col-md">
                                   <label><small>City</small></label>
                                   <select type="text" class="location " data-prefix="exp_edit" id="exp_edit_city" name="city_id">
                                       <option value="">Select Country</option>
                                       @foreach($locations['city']['option'] as $city)
                                           <option value="{{$city->id}}" {{$city->id === optional($locations['city']['selected'])->id?'selected':''}}>{{$city->full_name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <label><small>Start Date *</small></label>
                                 <input type="text" name="start_date" id="cre_exp_edit_start_date" autocomplete="off" placeholder="dd-mm-yyy" >
                               </div>
                               <div class="form-group col-md">
                                   <label><small>End Date</small></label>
                                   <input type="text" name="end_date" id="cre_exp_edit_end_date" autocomplete="off" placeholder="Currently Working">
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <label><small>Description</small></label>
                                   <textarea  name="description" id="exp_edit_description"></textarea>
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <button type="submit" class="cmn-btn btn-block">Update</button>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
            </div>


        </div>
    </div>
</div>