@extends('frontend.master.master')
@section('title',"Order Track")
@section('body')

<style>

.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 0.10rem
}

.card-header:first-child {
    border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
}

.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #fff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1)
}

.track {
    position: relative;
    background-color: #ddd;
    height: 7px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 60px;
    margin-top: 50px
}

.track .step {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    width: 25%;
    margin-top: -18px;
    text-align: center;
    position: relative
}

.track .step.active:before {
    background: #FF5722
}

.track .step::before {
    height: 7px;
    position: absolute;
    content: "";
    width: 100%;
    left: 0;
    top: 18px
}

.track .step.active .icon {
    background: #ee5435;
    color: #fff
}

.track .icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    position: relative;
    border-radius: 100%;
    background: #ddd
}

.track .step.active .text {
    font-weight: 400;
    color: #000
}

.track .text {
    display: block;
    margin-top: 7px
}

.itemside {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%
}

.itemside .aside {
    position: relative;
    -ms-flex-negative: 0;
    flex-shrink: 0
}

.img-sm {
    width: 80px;
    height: 80px;
    padding: 7px
}

ul.row,
ul.row-sm {
    list-style: none;
    padding: 0
}

.itemside .info {
    padding-left: 15px;
    padding-right: 7px
}

.itemside .title {
    display: block;
    margin-bottom: 5px;
    color: #212529
}

p {
    margin-top: 0;
    margin-bottom: 1rem
}

.btn-warning {
    color: #ffffff;
    background-color: #ee5435;
    border-color: #ee5435;
    border-radius: 1px
}

.btn-warning:hover {
    color: #ffffff;
    background-color: #ff2b00;
    border-color: #ff2b00;
    border-radius: 1px
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script>
<script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>


        <main class="main">

            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">Track Your Order</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-10 pb-8">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{URL('')}}">Home</a></li>
                        <li>Order Track</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            


            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container" style="margin-top:50px;margin-bottom:50px;">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <h3 class="text-center">Order Track</h3>
                            <div class="row">
                                <form class="col-md-12 col-12" method="get" action="{{URL('order_tracking')}}">
                                    <h4 class="title mb-3">Input your order id</h4>
                                    <div class="form-group">

                                    @if (isset($order_track))
                                        <input type="text" name="order_id" value="{{$order_id}}" class="form-control">
                                    @else
                                        <input type="text" name="order_id" class="form-control">
                                    @endif
                                    </div>
                                    <div class="col-md-12 col-12 text-center div_center">
                                        <div class="col-md-6 col-12">
                                            <button type="submit" class="btn btn-dark btn-rounded" style="width100%;">Track Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @if (isset($order_track))    

                @if($order_track_count == 0)
                <div class="container ">
                    <div class="row"> 
                        <div class="no_order_w" style="margin-top:50px;margin-bottom:50px;">
                            <p>There is no order on this id ( {{$order_id}} )</p>
                        </div>
                    </div>
                </div>

                @else
                <div class="container" style="margin-top:50px;margin-bottom:50px;">
                    <article class="card">
                        <header class="card-header"> My Orders / Tracking </header>
                        <div class="card-body">
                            <h6>
                                Order ID: {{$order_id}}
                            </h6>
                            <article class="card">
                                <div class="card-body row">
                                    <!-- <div class="col"> <strong>Estimated Delivery time:</strong> <br>29 nov 2019 </div> -->
                                    <!-- <div class="col">
                                        <strong>Shipping BY:</strong>
                                        <br> BLUEDART, |
                                        <i class="fa fa-phone"></i>
                                    </div> -->
                                    <div class="col">
                                        <strong>Status:</strong>
                                        <br> {{$order_track->status}}
                                    </div>
                                    <div class="col">
                                        <strong>Tracking #:</strong>
                                        <br> {{$order_id}}
                                    </div>
                                </div>
                            </article>

<?php
    $order_status=$order_track->status;
    if($order_status=="pending"){$for_active=1;}
    elseif($order_status=="Pending order"){$for_active=1;}
    elseif($order_status=="Processing order"){$for_active=2;}
    elseif($order_status=="Picked by courier"){$for_active=3;}
    elseif($order_status=="On the way"){$for_active=4;}
    elseif($order_status=="Complete"){$for_active=5;}
    elseif($order_status=="Cancel"){$for_active=6;}
    else{$for_active=1;}
?>

                            <div class="track">

                                <!-- order cancel -->
                                @if($for_active >= 6)
                                        <div class="step active">
                                            <span class="icon">
                                                <i class="w-icon-times-solid"></i>
                                            </span>
                                            <span class="text">Your order has been <b>Canceld</b></span>
                                        </div>

                                <!-- order not cancel -->
                                @else
                                        @if($for_active >= 1)
                                            <div class="step active">
                                        @else
                                            <div class="step">
                                        @endif
                                            <span class="icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <span class="text">Pending order</span>
                                        </div>
                                        @if($for_active >= 2)
                                            <div class="step active">
                                        @else
                                            <div class="step">
                                        @endif
                                            <span class="icon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <span class="text">Processing order / Order Confirm</span>
                                        </div>


                                        @if($for_active >= 3)
                                            <div class="step active">
                                        @else
                                            <div class="step">
                                        @endif
                                            <span class="icon"><i class="fa fa-truck"></i></span>
                                            <span class="text">Picked by courier</span>
                                        </div>

                                        @if($for_active >= 4)
                                            <div class="step active">
                                        @else
                                            <div class="step">
                                        @endif
                                            <span class="icon"><i class="fa fa-truck"></i></span>
                                            <span class="text">On the way</span>
                                        </div>

                                        @if($for_active >= 5)
                                            <div class="step active">
                                        @else
                                            <div class="step">
                                        @endif
                                            <span class="icon"><i class="fa fa-truck"></i></span>
                                            <span class="text">Complete</span>
                                        </div>
                                    @endif



                            </div>
                        </div>
                    </article>
                </div>
                @endif
            @endif
                              

            </div>
        </main>
        <!-- End of Main -->

@endsection