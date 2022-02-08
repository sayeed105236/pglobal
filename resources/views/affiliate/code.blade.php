@extends('affiliate.master.affiliate_master')
@section('title','Code')
@section('body')



<div class="page-wrapper">
    
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="ml-auto text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Code</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-12">
                <div class="card widget-box">
                    <div class="card-body">


<?php
   $Auth=Auth::User();
?>
                        <div class="row">
                            <div class="col-md-12 col-12 text-center">
                                My Referral code is &nbsp <b>{{$Auth->referral_code}}</b>
                            </div>
                            <div class="col-md-12 col-12 text-center">
                                <h3>&</h3>
                            </div>
                            <div class="col-md-12 col-12 text-center">
                                <?php
                                $referral_code=$Auth->referral_code;
                                  $referral_code=str_replace("#", '', $referral_code);?>

                                My Referral Link is &nbsp 
                                <input type="disabled" value="{{URL('login')}}?ref=<?php echo $referral_code;?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
