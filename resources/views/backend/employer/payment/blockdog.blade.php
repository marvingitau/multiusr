
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
							<div class=" col-lg-8 ">
								<div class="card border-radius-0 bg-transparent border">
									<div class="card-body text-center">
										<h6 style="color: #003399;"> PLEASE SEND EXACTLY <span style="color: green"> {{ $bcoin }}</span> ETH</h6>
										<h5 style="color: #003399;">TO <span style="color: green"> {{ $wallet}}</span></h5>
										<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{$qrurl}}&choe=UTF-8" title='' style='width:300px;' />
										<h4 class="text-white" style="font-weight:bold;">SCAN TO SEND</h4>
									</div>
								</div>


							</div>
						</div>
					</div><!-- //. contact page inner -->
				</div>
			</div>
		</div>
	</section>
@endsection