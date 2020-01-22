<div class="modal fade" id="lang_create_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create New Language</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <div class="row">
                   <div class="col">
                       <form action="{{route('user.resume.add_language')}}" method="post">@csrf
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <label><small>Select Language</small></label>
                                   <select name="language_id" >
                                       <option value="">Select</option>
                                       @foreach($attributes->getAttr('language') as $language)
                                           <option value="{{$language->id}}">{{$language->name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md">
                                   <label><small>Select Language Level</small></label>
                                   <select name="language_level_id" >
                                       <option value="">Select</option>
                                       @foreach($attributes->getAttr('language_level') as $language_level)
                                           <option value="{{$language_level->id}}">{{$language_level->name}}</option>
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