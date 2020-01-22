@extends('frontend.master')
@section('title','Blog Details')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'Blog Details','item'=>['Blog Details'=>null]])
    <div class="text-center mb-2 mt-2">
        <?php echo show_ad(2) ?>
    </div>

    <!-- blog-details-section start -->
    <section class="blog-details-section mt-4 padd-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-wrapper">
                        <div class="blog-details-thumb">
                            <img src="{{asset('assets/backend/image/blog/post/'.$blog->image)}}" alt="image">
                        </div>
                        <div class="blog-details-content">
                            <h3 class="post-title">{{$blog->title}}</h3>
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
                        <p><?php echo $blog->details ?></p>
                        </div>
                        <div class="blog-details-footer d-flex align-items-center justify-content-between">
                            <div class="tags">
                            </div>
                            <ul class="post-share d-flex align-items-center">
                                <li>share</li>
                                <li><a  href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a  href="https://twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a  href="https://plus.google.com/share?url={{urlencode(url()->current()) }}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a  href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="comment-wrapper">
                        <div class="comment-area">
                            <div class="fb-comments"  data-width="100%"
                                 data-href="{{url()->current()}}"
                                 data-numposts="5"></div>
                            <div id="fb-root"></div>
                        </div>
                    </div>
                    <div class="text-center mb-2 mt-2">
                        <?php echo show_ad(2) ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="widget widget-categories">
                            <h5 class="widget-title">news categories</h5>
                            <ul class="categories-list">
                                @foreach($categories as $category)
                                <li><a href="{{route('blog',$category->id)}}">{{$category->name}} <span class="badge badge-secondary float-right">{{$category->post->count()}}</span></a></li>
                                @endforeach
                            </ul>
                        </div><!-- widget end -->
                        <div class="text-center mb-2 mt-2">
                              <?php echo show_ad(1) ?>
                        </div>
                        <div class="widget widget-recent-news">
                            <h5 class="widget-title">recent news</h5>
                            <ul class="small-post-list">
                                @foreach( $latest_blogs as $latest_blog)
                                <li>
                                    <div class="post-item">
                                        <div class="post-content">
                                            <h6 class="post-title"><a href="{{route('blog_details',[$latest_blog->id,str_slug($latest_blog->title)])}}">{{$latest_blog->title}} </a></h6>
                                            <ul class="post-meta d-flex">
                                                <li>Post by <a class="post-author-name">Admin</a></li>
                                                <li> <a href="#" class="post-date">{{$blog->created_at->format('F d, Y')}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div><!-- widget end -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-details-section end -->


@endsection
@section('script')
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId={{web_setting()->general_general_section_fb_comment_script}}&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

@endsection