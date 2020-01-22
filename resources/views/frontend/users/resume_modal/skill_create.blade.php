<div class="modal fade" id="skill_create_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create New Skills</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <div class="row">
                   <div class="col">
                       <form action="{{route('user.resume.add_skill')}}" method="post">@csrf
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <label><small>Select Skills</small></label>
                                   <select name="skills_id" >
                                       <option value="">Select</option>
                                       @foreach($attributes->getAttr('skills') as $skills)
                                           <option value="{{$skills->id}}">{{$skills->name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <label><small>Experience</small></label>
                                   <select name="experience_id" >
                                       <option value="">Select</option>
                                       @foreach($attributes->getAttr('experience') as $experience)
                                           <option value="{{$experience->id}}">{{$experience->name}}</option>
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