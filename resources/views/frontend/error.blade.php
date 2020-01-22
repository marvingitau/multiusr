@extends('frontend.master')
@section('title','Error')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'Error','item'=>['error'=>null]])

    <!-- error-section start -->
    <section class="error-section padd-top-120 padd-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="error-content">
                        <div class="error-content-inner">
                            <h2 class="title">Opps ! Sorry Do't found page</h2>

                        </div>
                        <a href="{{route('home')}}" class="cmn-btn rounded-btn">back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- error-section end -->


@endsection