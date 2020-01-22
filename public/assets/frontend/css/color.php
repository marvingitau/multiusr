<?php

header("Content-Type:text/css");

$color = "#f0f"; // Change your Color Here

$color_2 = "#f0f";// Change your Color 2 Here

function checkhexcolor($color)

{

    return preg_match('/^#[a-f0-9]{6}$/i', $color);

}



if (isset($_GET['color']) AND $_GET['color'] != '') {

    $color = "#" . $_GET['color'];

}



if (!$color OR !checkhexcolor($color)) {

    $color = "#336699";

}

$color_2 = $color;

function hex2rgba($color, $opacity = false) {



    $default = 'rgb(0,0,0)';



    //Return default if no color provided

    if(empty($color))

        return $default;



    //Sanitize $color if "#" is provided

    if ($color[0] == '#' ) {

        $color = substr( $color, 1 );

    }



    //Check if color has 6 or 3 characters and get values

    if (strlen($color) == 6) {

        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );

    } elseif ( strlen( $color ) == 3 ) {

        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );

    } else {

        return $default;

    }



    //Convert hexadec to rgb

    $rgb =  array_map('hexdec', $hex);



    //Check if opacity is set(rgba or rgb)

    if($opacity){

        if(abs($opacity) > 1)

            $opacity = 1.0;

        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';

    } else {

        $output = 'rgb('.implode(",",$rgb).')';

    }



    //Return rgb(a) color string

    return $output;

}



?>

h1 > a:hover,

h2 > a:hover,

h3 > a:hover,

h4 > a:hover,

h5 > a:hover,

h6 > a:hover,

.block-title span,

.header-section .header-top .header-social-icon li a:hover,

.header-section .header-bottom .main-menu li.menu_has_children:hover::before,

.header-section .header-bottom .main-menu li a:hover,

.header-section.header-section-style-two .header-top .header-social-icon li a:hover,

.header-section.header-section-style-two .header-top .header-top-links li a:hover,

.header-section.header-section-style-two .header-top .account-area a:hover,

.header-section.header-section-style-two .header-bottom .main-menu li a:hover,

.header-section.header-section-style-two .header-bottom .main-menu li.menu_has_children:hover::before,

.header-section.header-section-style-two .header-bottom .main-menu li .sub-menu li a:hover,

.header-section .header-bottom .main-menu li.active,

.menu-toggle,

span.menu-toggle:hover,

.categories-item .icon,

.cmn-list li::before,

.job-post .job-post-footer .footer-left .post-bookmark:focus .bookmark-icon,

.popular-job-post-table table tbody tr td .job-title:hover,

.video-thumb .video-thumb-inner .video-btn,

.team-single .thumb .team-social-links li a:hover,

.team-single .content .designation,

.subscribe-section .subscribe-form-area .subscribe-form .email-element ~ .subscribe-form-btn,

.testimonial-slide .content .designation,

.post-item .content .blog-btn:hover,

.post-item blockquote::before,

.post-item blockquote a.post-author-name:hover,

.post-meta li i,

.post-meta li a:hover,

.blog-details-wrapper .blog-details-content blockquote::before,

.blog-details-wrapper .blog-details-footer .tags a:hover,

.comment-list li .single-comment-wrap .content .reply-time,

.comment-list li .single-comment-wrap .content .reply,

.footer-section .footer-bottom  .social-links li a:hover ,

.footer-section .footer-top .footer-widget .widget-contact-body ul li i,

.footer-section .footer-top .footer-widget .footer-phone,

.footer-section .footer-bottom .copy-right-text p a,

.counter-section--white .counter-item i,

.counter-item i,

.cta-post-job-section .cmn-btn,

.inner-page-banner-section .page-header-breadcrumb .breadcrumb li.active,

.widget .widget-title:hover,

.widget .widget-job-sort-list li a:hover, .widget .widget-job-sort-list li a:hover span,

.widget.widget-categories ul li a:hover, .widget.widget-categories .categories-list li a:hover,

.widget-social-list li a, .social-list li a,

.single-row .right a:hover,

.login-block .user-btn-group .btn

{

        color:<?php echo $color?>!important;

}

.cmn-btn,

.section-header .section-title::after,

.scroll-to-top,

.header-section .header-bottom .site-logo,

.header-section .header-bottom .nav-right .header-serch-btn,

.header-section .header-bottom .nav-right .header-top-search-area .header-search-form .header-search-btn,

.banner-section .job-search-area input.submit-btn,

.categories-section::before,

.categories-section.categories-section-style-two .categories-item .icon,

.rounded-video-btn i,

.rounded-video-btn:hover,

.job-post-search-area .job-post-search-form input[type="submit"],

.d-pagination .pagination .page-item.active a,

.video-thumb .video-thumb-inner .video-btn:hover,

.team-single .thumb::before,

.subscribe-section::before,

.resume-list-wrapper .resume-single-item .view-details .border-btn:hover,

.testimonial-slider .owl-dots .owl-dot.active,

.testimonial-slider-two .owl-controls .owl-dots .owl-dot.active::before,

.post-item .thumb .post-date,

.post-item .thumb .thumb-slider .owl-nav button:hover,

.post-item .content .blog-btn:hover::after,

.blog-details-wrapper .blog-details-footer .post-share li a:hover,

.comment-list li .single-comment-wrap .content .reply:hover,

.comment-form-area .comment-form .frm-group input[type="submit"],

.footer-section .footer-top .footer-widget .widget-title::after,

.footer-section .footer-top .footer-widget ul.links-list li a::before,

.counter-section::before,

.call-back-section .content .block-title::after,

.cta-post-job-section,

.work-item .content .item-count,

.widget .widget-title::before,

.widget .widget-tags-area a:hover,

.widget-social-list li a:hover, .social-list li a:hover,

.single-row .left span::before,

.post-job-wrapper .post-job-form-area .create-post-form input[type="submit"],

.login-block .user-btn-group .btn.active,

.login-block .user-btn-group .btn:hover,

.login-block .login-block-inner .login-form .frm-group input[type="submit"],

.login-block .login-block-inner .login-form .frm-group input[type="submit"]:hover,

.registration-block .registration-block-inner .registration-form .frm-group input[type="submit"],

.contact-item .icon,

.contact-form-area .contact-form .frm-group input[type="submit"],

.widget-common-list.dashboard-menu li.active,

.widget-common-list.dashboard-menu li:hover,

.toggle-handle,

.company-details_social ul li a:hover,

.login-section--style2 .login-area .login-form .btn-area .submit-btn,

.login-section--style2 .login-type-btn.active,

.contact-form-area--style2 .submit-btn

{

        background-color:<?php echo $color?>!important;

}





input:focus,

textarea:focus,

select:focus,

.d-pagination .pagination .page-item.active a,

.resume-list-wrapper .resume-single-item .view-details .border-btn:hover,

.post-item .thumb .thumb-slider .owl-nav button:hover,

.blog-details-wrapper .blog-details-footer .post-share li a:hover,

.comment-list li .single-comment-wrap .content .reply,

.widget .widget-tags-area a:hover,

.widget-social-list li, .social-list li,

.login-block .user-btn-group .btn,

.company-details_social ul li a:hover,

.login-section--style2 .login-area .login-form .login-inner-block::before,

.login-section--style2 .login-type-block

{

        border-color:<?php echo $color?>!important;

}

.load-more.load-more--loading,

.header-section .header-bottom .main-menu li .sub-menu

{

border-top-color:<?php echo $color?>;

}



.gradient-bg-light {

background: <?php echo hex2rgba($color,0.15)?>!important;

background: -webkit-linear-gradient(to top, rgba(38, 174, 97, 0.015) 18%, rgba(38, 174, 97, 0.15) 102%);

background: linear-gradient(to top, rgba(38, 174, 97, 0.015) 18%, rgba(38, 174, 97, 0.15) 102%);

}





.header-section .header-bottom {

    background-color: #fff;

}



.job-time-nature {

    background: <?php echo $color?>;

    padding: 4px 6px;

    border-radius: 4px;

    color: #fff !important;

}