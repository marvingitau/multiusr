@extends('frontend.master')
@section('title','Blog')
@section('content')
    @if($cat)
    @include('frontend.partials.breadcrumb',['title'=>'Blog','item'=>['Blog'=>route('blog'),$cat->name=>null]])
    @else
        @include('frontend.partials.breadcrumb',['title'=>'Blog','item'=>['Blog'=>null]])
        @endif


    <!-- blog-section start -->
    <section class="blog-section padd-top-120 padd-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-grid-wrapper">
                        <div class="row mt-mb-15">
                            @forelse($blogs as $key=>$blog)
                            <div class="col-lg-4 col-sm-6">
                                <div class="post-item">
                                    <div class="thumb">
                                        <img src="{{asset('assets/backend/image/blog/post/'.$blog->thumb)}}" alt="image">
                                    </div>
                                    <div class="content">
                                        <h4 class="post-title"><a href="{{route('blog_details',[$blog->id,str_slug($blog->title)])}}">{{$blog->title}}</a></h4>
                                        <ul class="post-meta d-flex">
                                            <li><i class="fa fa-folder-open"></i><a href="{{route('blog',$blog->category->id)}}" class="post-author-name">{{$blog->category->name}}</a></li>
                                            <li>
                                                <i class="fa fa-clock-o"></i>
                                                <a href="#" class="post-date">{{$blog->created_at->format('F d, Y')}}</a>
                                            </li>
                                            <li>
                                                <i class="fa fa-eye"></i>
                                                <a href="#" class="post-date">{{$blog->hit}}</a>
                                            </li>
                                        </ul>
                                        <p>{{str_limit($blog->details,200)}}</p>
                                    </div>
                                </div>
                            </div><!-- post-item end -->
                            @empty
                                <div class="col-12">
                                    <div class="post-item">
                                        <h3 class="text-center">No Post</h3>
                                    </div>
                                </div>
                                @endforelse
                        </div>
                    </div><!-- blog-grid-wrapper end -->
                    @include('frontend.partials.pagination',['pagination'=>$blogs])
                </div>
            </div>
        </div>
    </section>
    <!-- blog-section end -->


@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqFuLx8S7A8eianoUhkYMeXpGPvsXp1NM&callback=initMap" async defer></script>
    <!-- google map activate js -->
    <script src="{{asset('assets/frontend/js/goolg-map-activate.js')}}"></script>
    <!-- main -->
    @endsection