@extends('frontend.master')
@section('title','Dashboard')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'Dashboard','item'=>['Dashboard'=>null]])
    <!-- job-details-section start  -->
    <div class="job-details-section pt-4 padd-bottom-120">
        <div class="container">

            <div class="text-center mb-2 mt-2">
        <?php echo show_ad(4) ?>
    </div>

            <div class="row">
                <aside class="col-lg-4">
                  @include('frontend.users.sidebar')
                </aside>
                <main class="col-lg-8">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="job-post job-post--style-one">
                                    <div class="job-post-body d-flex">
                                        <div class="job-post-icon">
                                            <i class="fa fa-briefcase fa-2x"></i>
                                        </div>
                                        <div class="job-post-content">
                                            <h2 class="text-center">{{auth()->user()->applyJob->count()}}</h2>
                                        </div>
                                    </div>
                                    <div class="job-post-footer d-flex justify-content-between">
                                        <div class="footer-left">
                                            <span class="job-post-time">Applied Application</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="job-post job-post--style-one">
                                    <div class="job-post-body d-flex">
                                        <div class="job-post-icon">
                                            <i class="fa fa-eye fa-2x"></i>
                                        </div>
                                        <div class="job-post-content">
                                            <h2 class="text-center">{{auth()->user()->applyJob->where('view',1)->count()}}</h2>
                                        </div>
                                    </div>
                                    <div class="job-post-footer d-flex justify-content-between">
                                        <div class="footer-left">
                                            <span class="job-post-time">Viewed my Resume</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="job-post job-post--style-one">
                                    <div class="job-post-body d-flex">
                                        <div class="job-post-icon">
                                            <i class="fa fa-calendar fa-2x"></i>
                                        </div>
                                        <div class="job-post-content ">
                                            <h6 class="mt-3 text-center">{{auth()->user()->updated_at->format('d/m/Y')}}</h6>
                                        </div>
                                    </div>
                                    <div class="job-post-footer d-flex justify-content-between">
                                        <div class="footer-left">
                                            <span class="job-post-time">Resume updated on</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

    <div class="text-center mb-2 mt-2">
        <?php echo show_ad(2) ?>
    </div>

                </main>

            </div>
        </div>
    </div>
    <!-- job-details-section end  -->


@endsection