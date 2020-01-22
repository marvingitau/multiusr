<!-- footer-section start -->
<footer class="footer-section">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="copy-right-text">
                        <p>Copyright © {{date('Y')}} <a href="{{route('home')}}">{{general_setting()->title}}</a> . All rights reserved</p>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <ul class="menu-short-links">
                        @forelse(web_setting_item('social') as $key=>$social)
                            <li><a href="{{$social->val_3}}" target="_blank"><i class="fa fa-{{$social->val_2}}"></i></a></li>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-section end -->