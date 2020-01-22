@extends('frontend.master')
@section('title','Contact Page')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'Contact','item'=>['Contact'=>null]])


    <!-- contact-section start -->
    <section class="contact-section padd-top-120 padd-bottom-120 gradient-bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-2-thumb">
                        <img src="{{asset('assets/frontend/img/global/global_section/contact_image.png')}}" alt="image">
                    </div>
                    <div class="row mb-none-30">
                        <div class="col-sm-6">
                            <div class="contact-item--style2 mb-30">
                                <h4 class="title">Address</h4>
                                <p>{{web_setting()->contact_all_section_address}}</p>
                            </div>
                        </div><!-- contact-item--style2 end -->
                        <div class="col-sm-6">
                            <div class="contact-item--style2 mb-30">
                                <h4 class="title">email address</h4>
                                <ul>

                                    <li><a href="#0"><i class="fa fa-envelope"></i>  {{web_setting()->contact_all_section_email}} </a></li>


                                </ul>
                            </div>
                        </div><!-- contact-item--style2 end -->
                        <div class="col-sm-6">
                            <div class="contact-item--style2 mb-30">
                                <h4 class="title">Phone number</h4>
                                <ul>

                                    <li><a href="#0"><i class="fa fa-phone"></i>  {{web_setting()->contact_all_section_phone}} </a></li>


                                </ul>
                            </div>
                        </div><!-- contact-item--style2 end -->
                        <div class="col-sm-6">
                            <div class="contact-item--style2 mb-30">
                                <h4 class="title">Fax number</h4>
                                <ul>

                                    <li><a href="#0"><i class="fa fa-fax"></i>  {{web_setting()->contact_all_section_fax}}</a></li>

                                </ul>
                            </div>
                        </div><!-- contact-item--style2 end -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form-area--style2">
                        <h3 class="title text-center my-4">{{web_setting()->global_global_section_contact_title}}</h3>
                        <form class="contact-form" action="{{route('contact.submit')}}" method="post">@csrf
                            <div class="form-group">
                                <label for="#0">Full Name</label>
                                <input type="text" name="name" id="#0" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="#0">Email</label>
                                <input type="email" name="email" id="#0" placeholder="example@email.com" required>
                            </div>
                            <div class="form-group">
                                <label for="#0">Subject</label>
                                <input type="text" name="subject" id="#0" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <label for="#0">Tell me your though</label>
                                <textarea name="message" id="message" placeholder="Message here" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-btn">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->




    <!-- event-location-section start -->
    <div class="responsive-map-container">

        <iframe src="https://www.google.com/maps/embed?pb={{web_setting()->contact_all_section_map}}" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>


    </div>


@endsection