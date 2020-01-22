@extends('frontend.master')

@section('title','Apply on Job')

@section('content')

    @include('frontend.partials.breadcrumb',['title'=>'Apply Job','item'=>['Apply Job'=>null]])

    <!-- job-details-section start  -->

    <section class="login-section mt-4 padd-bottom-120 text-left">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="login-block text-center">

                        <div class="login-block-inner">

                            <h3 class="title text-left"><a href="{{route('job.view',[$job->id,str_slug($job->title)])}}">Job title : {{$job->title}}</a> </h3>
                                <p>Kindly upload the below documents in pdf format. Note that KMRC is an equal opportunity employer.</p>
                            &nbsp; 
                                <form action="{{route('user.apply_job.store',$job->id)}}" method="post" enctype="multipart/form-data">
                                
                                @csrf

                                <div class="form-row">
     
                                          <!-- cv   elis -->
                               <div class="form-group col-md">  
<label for=""> CV:</label>
                                <input type="file" name="file">

                                </div>
                                    <!-- letter  elis-->
                                <div class="form-group col-md">
                                <label for="">Cover Letter:</label>
                                 <input type="file" name="letter">

                                </div>
     
                                </div>
     
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <button type="submit" class="cmn-btn btn-block font-weight-bold">Upload</button>
                                        <button type="submit" class="cmn-btn btn-block font-weight-bold">skip if CV & Letter is Uptodate</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- job-details-section end  -->





@endsection