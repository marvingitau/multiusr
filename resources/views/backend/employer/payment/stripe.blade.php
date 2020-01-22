@extends('backend.employer.master')
@section('title',$pt)
@section('content')
    <section class="contact-page-content-area bg-dark-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="contact-page-inner"><!-- contact page inner -->
                        <div class="section-title white center"><!-- section title -->
                            <h4 class="title">{{$pt}}</h4>
                            <span class="separator center"></span>
                        </div><!-- //. section title -->
                        <div class="row justify-content-center">
                            <div class=" col-lg-8">
                                <div class="card bg-transparent mt-5 border border-radius-0">
                                    <div class="card-body ">
                                        <div class="card-wrapper"></div>

                                    </div>
                                    <form role="form" id="payment-form" method="POST" class="card-footer bg-th-o-1 contact-form" action="{{ $ipn}}" >
                                        @csrf
                                        <input type="hidden" value="{{ $track }}" name="track">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="name">CARD NAME</label>
                                                <div class="input-group">
                                                    <input
                                                            type="text"
                                                            class="form-control input-lg"
                                                            name="name"
                                                            placeholder="Card Name"
                                                            autocomplete="off" autofocus
                                                    />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-transparent"><i class="fa fa-font"></i></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="cardNumber">CARD NUMBER</label>
                                                <div class="input-group">
                                                    <input
                                                            type="tel"
                                                            class="form-control input-lg"
                                                            name="cardNumber"
                                                            placeholder="Valid Card Number"
                                                            autocomplete="off"
                                                            required autofocus
                                                    />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-transparent"><i class="fa fa-credit-card"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-7 col-md-7">
                                                <label for="cardExpiry">EXPIRATION DATE</label>
                                                <input
                                                        type="tel"
                                                        class="form-control input-lg input-sz"
                                                        name="cardExpiry"
                                                        placeholder="MM / YYYY"
                                                        autocomplete="off"
                                                        required
                                                />
                                            </div>
                                            <div class="col-xs-5 col-md-5">
                                                <label for="cardCVC">CVC CODE</label>
                                                <input
                                                        type="tel"
                                                        class="form-control input-lg input-sz"
                                                        name="cardCVC"
                                                        placeholder="CVC"
                                                        autocomplete="off"
                                                        required
                                                />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <button class="btn btn-tsk btn-block" id="payment-form-btn" type="submit" > PAY NOW </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div><!-- //. contact page inner -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/card/2.4.0/card.min.js"></script>
<script>
	(function ($) {
		$(document).ready(function () {
			var card = new Card({
				form: '#payment-form',
				container: '.card-wrapper',
				formSelectors: {
					numberInput: 'input[name="cardNumber"]',
					expiryInput: 'input[name="cardExpiry"]',
					cvcInput: 'input[name="cardCVC"]',
					nameInput: 'input[name="name"]'
				}
			});
		});
	})(jQuery);
</script>
@endsection


