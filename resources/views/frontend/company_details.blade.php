@extends('frontend.master')
@section('title','Company Detail')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'Company Detail','item'=>['Company Detail'=>null]])
    <!-- resume-details-section start  -->
    <div class="resume-details-section pt-4 padd-bottom-120">
        <div class="container">
            <div class="row">
                <main class="col-lg-8">
                    <div class="resume-details-wrapper">
                        <div class="details-area">
                            <div class="details-header">
                                <div class="resume-single-item d-flex align-items-center">
                                    <div class="thumb">
                                        <img src="{{$company->company_logo()}}" alt="image">
                                    </div>
                                    <div class="content">
                                        <h6 class="name">{{$company->company_name}}</h6>
                                        <ul class="resume-meta d-flex">
                                            <li><i class="fa fa-map-marker"></i>{{implode(' , ',$company->address())}}</li>
                                            <li><i class="fa fa-clock-o"></i>Member Since, {{$company->created_at->format('M d, Y')}}</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="single-row p-4">
                                <h3 class="mb-4">About Company</h3>
                                   <p>{{$company->description}}</p>
                            </div>
                        </div>
                    </div>
                </main>
                <aside class="col-lg-4">
                    <div class="sidebar">
                        <div class="widget widget-job-details">
                            <ul class="company-details_list p-3">
                                <li><i class="fa fa-phone"></i>  {{$company->phone}}</li>
                                <li><i class="fa fa-envelope"></i>  {{$company->email}}</li>
                                <li><i class="fa fa-globe"></i> <a href="{{$company->web}}" target="_blank">{{$company->web}}</a></li>
                            </ul>
                        </div><!-- widget end -->
                        <div class="widget widget-social mt-md-4">
                            <h5 class="widget-title">Follow me</h5>
                            <ul class="widget-social-list">
                                @foreach($company->socials as $social)
                                <li><a href="{{$social->link}}" target="_blank"><i class="fa fa-{{$social->icon}}"></i></a></li>
                               @endforeach
                            </ul>
                        </div><!-- widget end -->
                        <div class="widget widget-add map_script mt-md-4">
                            <?php echo $company->map_script?>
                        </div><!-- widget end -->
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <!-- resume-details-section end  -->

@endsection