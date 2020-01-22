@extends('frontend.master')
@section('title','FAQ')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'FAQ','item'=>['FAQ'=>null]])


    <!-- faq-section start -->
    <section class="faq-section padd-top-120 padd-bottom-120">
        <div class="container">
            <div class="row">
                @forelse(web_setting_item('faq') as $key=>$faq)
                <div class="col-lg-6">
                    <div class="faq-item">
                        <h4 class="title">{{$faq->val_1}}</h4>
                        <p>{{$faq->val_2}}</p>
                    </div>
                </div><!-- faq-item end -->
             @endforeach
            </div>
        </div>
    </section>
    <!-- faq-section end -->

    @endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqFuLx8S7A8eianoUhkYMeXpGPvsXp1NM&callback=initMap" async defer></script>
    <!-- google map activate js -->
    <script src="{{asset('assets/frontend/js/goolg-map-activate.js')}}"></script>
    <!-- main -->
    @endsection