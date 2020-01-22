<div class="modal fade" id="upload_cv_modal">

    <div class="modal-dialog">

        <div class="modal-content">



            <!-- Modal Header -->

            <div class="modal-header">

                <h4 class="modal-title">Upload PDF File</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <!-- Modal body -->

            <div class="modal-body">

               <div class="row">

                   <div class="col">

                       <form action="{{route('user.resume.upload')}}" method="post" enctype="multipart/form-data">@csrf

                           <div class="form-row">
                                    <!-- cv   elis -->
                               <div class="form-group col-md">  

                                    CV: <input type="file" name="file">

                               </div>
                                        <!-- letter  elis-->
                               <div class="form-group col-md">

                                    Letter: <input type="file" name="letter">

                                </div>

                           </div>

                           <div class="form-row">

                               <div class="form-group col-md">

                                   <button type="submit" class="cmn-btn btn-block">Upload</button>

                               </div>

                           </div>

                       </form>

                   </div>

               </div>

            </div>





        </div>

    </div>

</div>