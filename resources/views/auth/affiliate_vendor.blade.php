@extends('frontend.master.master')
@section('title',"Login")
@section('body')

<!-- Start of Main -->
<main class="main login-page">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">My Account</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{URL('')}}">Home</a></li>
                <li>Sign up as Affiliate / Vendor / Dealer</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    <div class="page-content">
        <div class="container">
            <div class="login-popup">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="#sign-up" class="nav-link">Sign Up</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="sign-up">
                            <form  method="POST" action="{{ route('register') }}">
                                @csrf
                            <div class="form-group">
                                <label>Your Name *</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Your E-Mail Address *</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mobile *</label>
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" min="11" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Address *</label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" min="11" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span address="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Referral Code:</label>
                                <input id="referred_by" type="text" class="form-control @error('referred_by') is-invalid @enderror" name="referred_by" min="11" value="{{ old('referred_by') }}" autocomplete="referred_by">

                                @error('referred_by')
                                    <span address="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mb-5">
                                <label>Password *</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimum 8 character">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label>Confirm Password *</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Minimum 8 character">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                    <option></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group mb-5">
                                <label>Sign up as</label>
                                <select class="form-control" name="request_role">
                                    <option value="{{$request_role}}">{{$request_role}}</option>
                                    @if($request_role == "affiliate")
                                        <option value="vendor">vendor</option>
                                    @elseif($request_role == "vendor")
                                        <option value="affiliate">affiliate</option>
                                    @elseif($request_role == "dealer")
                                        <option value="dealer">Dealer</option>
                                    @endif
                                </select>
                            </div>

                            
                            <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                <input type="checkbox" class="custom-checkbox" id="remember" required name="remember">
                                <label for="remember" class="font-size-md">I agree to the <a  href="#" class="text-primary font-size-md">privacy policy</a></label>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                Sign Up
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End of Main -->



@endsection