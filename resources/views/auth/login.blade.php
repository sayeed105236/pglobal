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
                <li>My account</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    <div class="page-content">
        <div class="container">

            @if (session('referred_by_count_error'))
                <div class="alert alert-warning" role="alert">
                    {{ session('referred_by_count_error') }}
                </div>
            @endif

            <div class="login-popup">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="#sign-in" class="nav-link active">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a href="#sign-up" class="nav-link">Sign Up</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="sign-in">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Phone or Email *</label>
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Password *</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-checkbox d-flex align-items-center justify-content-between">
                                    <input type="checkbox" class="custom-checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember1">Remember me</label>
                                    <!-- <a href="#">Last your password?</a> -->
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">
                                    Sign In
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane" id="sign-up">
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
                                <label>Your E-Mail Address </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

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
                            <div class="form-group mb-5">
                                <label>Password *</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" min="8" required autocomplete="new-password" placeholder="Minimum 8 character">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label>Confirm Password *</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" min="8" required autocomplete="new-password" placeholder="Minimum 8 character">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label>Referral Code:</label>

                                @if (isset($_GET['ref']))
                                    <input id="referred_by" type="text" class="form-control @error('referred_by') is-invalid @enderror" name="referred_by" min="11" value="#<?php echo $_GET['ref'];?>"  autocomplete="referred_by">
                                @else
                                    <input id="referred_by" type="text" class="form-control @error('referred_by') is-invalid @enderror" name="referred_by" min="11" value="{{ old('referred_by') }}"  autocomplete="referred_by">
                                @endif


                                    @if (session('referred_by_count_error'))
                                        <div class="alert alert-warning" role="alert">
                                            {{ session('referred_by_count_error') }}
                                        </div>
                                    @endif

                                    @if (isset($referred_by_count_error))
                                      echo "Variable 'a' is set.<br>";
                                    @endif


                                @error('referred_by')
                                    <span address="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <p>Your personal data will be used to support your experience 
                                throughout this website, to manage access to your account, 
                                and for other purposes described in our <a href="#" class="text-primary">privacy policy</a>.</p>

                            <p class="link_signup">
                                <span>Signup as a</span> 
                                <a href="{{URL('Affiliate-Reg')}}" class="d-block mb-5 text-primary">Affiliator</a> 
                                <span>/</span>
                                <a href="{{URL('Vendor-Reg')}}" class="d-block mb-5 text-primary">Vendor</a>
                                <span>/</span>
                                <a href="{{URL('Dealer-Reg')}}" class="d-block mb-5 text-primary">Dealer</a>
                            </p>

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