@php
    $Auth_id=Auth::User()->id;
    $user=App\User::findOrFail($Auth_id);
    $request_role=$user->request_role;
    $usertype=$user->usertype;
@endphp

<!-- Start of Main -->
<main class="main">
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
                <li><a href="{{URL('/')}}">Home</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->


    <!-- Start of PageContent -->
    <div class="page-content pt-2">
        <div class="container">
            <div class="row gutter-lg">
                <ul class="nav mb-6">
                    <li class="nav-item">
                        <a href="{{URL('profile')}}" class="nav-link {{'profile'==request()->path() ? 'profile_tab_a_active' : ''}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL('profile/orderlist')}}" class="nav-link">Your Order</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL('order_track')}}" class="nav-link">Track Order</a>
                    </li>
                    <li class="nav-item">
                        <!-- Vendor -->
                        @if($request_role == "vendor")
                            <a href="#" class="nav-link">
                                Wait for admin approval
                            </a>
                        @elseif($usertype == "vendor")
                            <a href="{{URL('vendor-dashboard')}}" class="nav-link">
                                Go to dashboard
                            </a>

                        <!-- Dealer -->
                        @elseif($request_role == "dealer")
                            <a href="#" class="nav-link">
                                Wait for admin approval
                            </a>
                        @elseif($usertype == "dealer")
                            <a href="{{URL('dealer-dashboard')}}" class="nav-link">
                                Go to dashboard
                            </a>

                        <!-- Affiliate -->
                        @elseif($usertype == "affiliate")
                            <a href="{{URL('create-affiliate-dashboard')}}" class="nav-link">
                                My Affiliate Dashboard
                            </a>
                        @elseif($request_role == "affiliate")
                            <a href="{{URL('create-affiliate-dashboard')}}" class="nav-link">
                                Create my Affiliate Dashboard
                            </a>
                        @else
                        @endif
                    </li>
                </ul>