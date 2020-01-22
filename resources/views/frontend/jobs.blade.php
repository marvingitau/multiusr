@extends('frontend.master')

@section('title','Job Listing')

@section('content')



@include('frontend.partials.breadcrumb',['title'=>'Job Listing','item'=>['Job Listing'=>null]])

<div class="text-center mt-2">

    <?php echo show_ad(4) ?>

</div>

    <!-- job-post-grid start  -->
    

    <div class="job-post-grid job-post-grid-style-one pt-4 padd-bottom-120" id="app">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="job-post-search-area">

                        <form class="job-post-search-form">

                            <div class="row">

                                <div class="col-md">

                                    <div class="frm-group d-none">

                                        {{-- <input type="text" v-model="search.keyword" id="job_title" placeholder="Enter Skills or Job Title" > --}}
                                        <input type="text" name="search" id="job_title" placeholder="Enter Skills or Job Title" >


                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md  pb-3">

                                    <div class="frm-group has_select">

                                        {{-- <select  v-model="search.functional_area" @change="setSearchAreaByKey('functional_area',search.functional_area,'functional_area_option')">

                                            <option :value="functional_item.id" v-for="functional_item in functional_area_option"> @{{ functional_item.text }}</option>

                                        </select> --}}


                                    </div>

                                </div>

                                <div class="col-md pb-3">

                                    <div class="frm-group has_select">

                                        {{-- <select  v-model="search.country" >

                                            <option :value="country_item.id" v-for="country_item in country_option"> @{{ country_item.text }}</option>

                                        </select> --}}

                                    </div>

                                </div>



                                <div class="col-md pb-3">

                                    <div class="frm-group has_select">

                                        {{-- <select  v-model="search.state" >

                                            <option :value="state_item.id" v-for="state_item in state_option"> @{{ state_item.text }}</option>

                                        </select> --}}

                                    </div>



                                </div>

                                <div class="col-md pb-3">

                                    <div class="frm-group has_select" >

                                        {{-- <select  v-model="search.city" >

                                            <option :value="city_item.id" v-for="city_item in city_option"> @{{ city_item.text }}</option>

                                        </select> --}}

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

          

            <div class="row">
           


            

            


             {{-- <div class="card">
               <img class="card-img-top" src="holder.js/100px180/" alt="">
               <div class="card-body">
                 <h4 class="card-title">Title</h4>
                 <p class="card-text">Body</p>
               </div>
             </div> --}}

                {{-- @foreach ($job_posts as $job)
               <div class="col-12">
                <div class="card">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                      <h4 class="card-title">{{$job->title}}</h4>
                      <p class="card-text">{{$job->description}}</p>
                      <button class="btn btn-link" href="">Apply </button>
                    </div>
                  </div>
               </div>
                @endforeach --}}

                <div class="container jobs">
                    <div class="row job-heading">
                        <div class="col-md-3">
                            <p>Job Title</p>
                        </div>
                        <div class="col-md-7">
                           <p>Description</p> 
                        </div>
                        <div class="col">
                            <p>Action</p>
                        </div>
                    </div>
                    @foreach ($job_posts as $job)
                    <div class="job-listings">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-briefcase"></i>
                                    <div class="di">
                                        <a class="d-block text-capitalize" href="/job/view/{{ $job->id}}/{{ $job->title}}">{{$job->title}}</a>
                                        {{-- <span class="badge badge-secondary rounded-0">Date Added: {{$job->created_at}}</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="job-desc">
                                    {{$job->description}}
                                    
                                </div>
                            </div>
                            <div class="col">
                                <a href="/job/view/{{ $job->id}}/{{ $job->title}}" class="btn rounded-0 w-100 apply-now-cta text-white">READ MORE</a>
                            </div>
                        </div>                         
                    </div>
                    @endforeach
        </div>




        </div>

    </div>

    <!-- job-post-grid job-post-grid-style-one end  -->



    @endsection



        @section('script')

            <script src="{{asset('assets/plugin/vue/vue.js')}}"></script>

            <script src="{{asset('assets/plugin/axios/axios.js')}}"></script>

            <script src="{{asset('assets/backend/js/custom.js')}}"></script>

            

@endsection