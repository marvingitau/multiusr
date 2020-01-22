@extends('frontend.master')
@section('title','Change Password')
@section('content')
    @include('frontend.partials.breadcrumb',['title'=>'Change Password','item'=>['Dashboard'=>route('user.dashboard'),'Change Password'=>null]])
    <!-- job-details-section start  -->
    <div class="job-details-section pt-4 padd-bottom-120">
        <div class="container">
            <div class="row">
                <aside class="col-lg-4">
                  @include('frontend.users.sidebar')
                    <div class="text-center">
                       <?php echo show_ad(1) ?>
                    </div>
                </aside>
                <main class="col-lg-8">
                    <div class="inner-main-content">
                        <div class="row">
                            <div class="col ">
                                <h3 class="">
                                    <i class="fa fa-key"></i> CHANGE PASSWORD
                                </h3>
<hr/>
                            </div>
                        </div>
                        <div class="row mt-4">

                            <div class="col-md-12">
                                <form action="{{route('user.change_pass.store')}}" method="post" >@csrf
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-lg-12">
                                            <label for="old_password">Old Password <span class="text-danger">*</span></label>
                                            <input type="password"  id="old_password" name="old_password"
                                                   placeholder="Old Password" >
                                            @if ($errors->has('old_password'))
                                                <small class="text-danger">{{ $errors->first('old_password') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-lg-12">
                                            <label for="new_password">New Password <span class="text-danger">*</span></label>
                                            <input type="password"  id="new_password" name="new_password"
                                                   placeholder="New Password" >
                                            @if ($errors->has('new_password'))
                                                <small class="text-danger">{{ $errors->first('new_password') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-lg-12">
                                            <label for="new_password_confirmation">Confirmed Password <span class="text-danger">*</span></label>
                                            <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                                   placeholder="Confirmed Password">
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-lg-12">

                                            <button type="submit" class="cmn-btn mt-4 btn-block"><i class="fa fa-save"></i> Change</button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>

                </main>

            </div>
        </div>
    </div>
    <!-- job-details-section end  -->


@endsection