@extends('frontend.master.master')
@section('body')
@include('frontend.profile.profile_master')





@php
    $Auth_id=Auth::User()->id;
    $user=App\User::findOrFail($Auth_id);
@endphp
    <!-- Start Checkout -->
    <section class="shop checkout section">
      <form class="container" action="{{URL('update_profile')}}" method="post" enctype='multipart/form-data'>
      {{csrf_field()}}
        <div class="row"> 
          <div class="col-lg-12 col-12">
            
            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="checkout-form">
              <h2>Your Profile Information</h2>
              <p></p>
              <!-- Form -->
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                      <label>Name<span>*</span></label>
                      <input class="ch_in ch_in2" type="text" name="name" value="{{$user->name}}" required="required">
                    </div>
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Email Address<span>*</span></label>
                      <p class="ch_in ch_in2">{{$user->email}}</p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Phone Number<span>*</span></label>
                      <input class="ch_in ch_in2" type="number" name="phone" value="{{$user->phone}}" required>
                    </div>
                      @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                      <label>Address<span>*</span></label>
                      <input class="ch_in ch_in2" type="text" name="address" value="{{$user->address}}" required="required">
                    </div>
                      @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" class="ch_in ch_in2">{{$user->description}}</textarea>
                    </div>
                      @error('description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                      <label>Profile picture</label>
                      <input type="file" name="pp" class="ch_file form-control" onchange="pp_image_url(this);">
                      <img src="{{URL('public/allfiles/img/pp')}}/{{$user->pp}}" class="profile_img" id="pp_img" width="150px">
                    </div>
                          <script type="text/javascript">
                            function pp_image_url(input) {
                            if (input.files && input.files[0]) {
                              var reader = new FileReader();
                              reader.onload = function (e) {
                                  $('#pp_img').attr('src', e.target.result);};
                              reader.readAsDataURL(input.files[0]);}}
                          </script>
                  </div>
                  <div class="col-md-12 col-12 text-center div_center">
                      <div class="col-md-6 col-12">
                          <button type="submit" class="btn btn-dark btn-rounded" style="width100%;margin: 10px 0px 50px 0px;">
                            Update Now
                          </button>
                      </div>
                  </div>
                </div>
              <!--/ End Form -->
            </div>
          </div>
        </div>
      </form>
    </section>















            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</main>
<!-- End of Main -->





@endsection
