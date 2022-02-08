@extends('backend.master.backend_master')
@section('title','Dashboard')

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('resources/backend/assets/extra-libs/multicheck/multicheck.css')}}">
        <link href="{{asset('resources/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
    @endsection
@section('body')





<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="ml-auto text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
        <d
@php
    $Auth_id=Auth::User()->id;
    $user=App\User::findOrFail($Auth_id);
@endphp


    <div class="row">
        @if (session('status'))
        <div class="col-md-12 col-12">
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>
        </div>
        @endif
      
        <div class="col-md-8">
            <div class="card widget-box">
                <div class="card_main_heading">
                    অর্ডারকৃত পণ্য
                </div>
                <div class="card-body table-responsive">

                    <table class="table">
                      <tbody>

                        <?php 
                          $total_loop=0;
                          $order_detail_tbl=App\admin\order_detail_tbl::where('order_id',$order_tbl->id)->get();
                        ?>

                        @foreach($order_detail_tbl as $data)
                        <?php 
                          $total_loop=$total_loop+1;
                          $loop="{$loop->iteration}";
                          $product_id="{$data->product_id}";
                          $product_details=App\admin\product_tbl::find($product_id);
                        ?>

                            <tr>
                              <th scope="row"><?php echo $loop;?></th>
                              
                              <td>
                                <?php $name="{$product_details->name}";$name = str_replace(' ', '-', $name);?>
                                <a href="{{URL('product')}}/<?php echo $name?>/{{$product_details->id}}">
                                    <div class="cart_img_w">
                                        <img class="eo_image" src="{{URL('public/allfiles/img/product/thumb')}}/{{$product_details->main_image}}">
                                    </div>
                                 </a>
                              </td>
                              <td>
                                <div class="cart_name_w">
                                    <a href="show-product?name=<?php echo $name?>&id={{$product_details->id}}">
                                    <p class="cart_pname">
                                        {{$product_details->name}}
                                    </p>
                                    </a>
                                    <p class="cart_p_attr">
                                        <b>size:</b>{{$data->size}}, 
                                        <b>color:</b>
                                        {{$data->color}}
                                        <span class="swatch" style="background-color:{{$data->color}}">
                                        </span>
                                    </p>
                                </div>
                              </td>

                              <td>
                                <h4 class="product-price">{{$data->price}}</h4>
                              </td>
                              <td>{{$data->quantity}}</td>

                              <td>
                                <?php 
                                  $quantity="{$data->quantity}";
                                  $price="{$data->price}";
                                  echo $sum_price=$quantity*$price;
                                ?>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>ডেলিভারি খরচ</b></td>
                                <td>
                                    {{$order_tbl->shipping_price}}  
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Total</h5>
                                </td>
                                <td>
                                    <h4 id="total_sumup_taka">
                                      <?php echo $total_cost=$order_tbl->shipping_price+$order_tbl->product_price;?>
                                    </h4>
                                </td>
                                <td></td>
                            </tr>
                      </tbody>
                        
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="card widget-box">
                <div class="card_main_heading">
                        Shipping Address
                </div>

                <div class="card-body shping_dtls">
                    <p>Shipping District: <b>{{$order_tbl->district}}</b></p>
                    <p>Shipping Price: <b>৳ {{$order_tbl->shipping_price}}</b></p>
                    <p>Time: <b>{{$order_tbl->shipping_time}}</b> days</p>
                    <p>
                        Full Address: <b>{{$order_tbl->address}}, {{$order_tbl->police_station}}, {{$order_tbl->district}}</b>
                    </p>
                    
                    <p>
                        Phone: <b>{{$order_tbl->phone}}</b>
                    </p>
                </div>
            </div>
        </div>


        <div class="col-md-12 col-12 m-t50 m-b50">
            <div class="card">
                <div class="card_main_heading">
                    <h5 class="card-title">Order details</h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-6 col-12 inblc">
                        <p class="title2 m-t20">Customer Details / Billing Address</p>
                        <p>Name: <b>{{$order_tbl->name}}</b></p>
                        <p>Email: <b>{{$order_tbl->email}}</b></p>
                        <p>Phone: <b>{{$order_tbl->phone}}</b></p>
                        <p>Address: <b>{{$order_tbl->address}}</b></p>
                        <p>Police Station: <b>{{$order_tbl->police_station}}</b></p>
                        <p>District: <b>{{$order_tbl->district}}</b></p>
                    </div>

                    <div class="col-md-6 col-12 inblc">
                        <p class="title2 m-t20">Order Details</p>
                        <p>Order Code: <b>{{$order_tbl->order_code}}</b></p>
                        <p>Order Status: <b class="{{$order_tbl->status}}">{{$order_tbl->status}}</b></p>
                        <br>
                        <p>Payment: <b>{{$order_tbl->payment}}</b></p>
                        @if($order_tbl->payment=="Cash")
                            <p>Amount: <b> <?php echo $total_cost=$order_tbl->shipping_price;?></b></p>
                            <p>Shipping Payment method: <b>{{$order_tbl->cash_shipping_payment}}</b></p>
                            <p>Shipping Payment Transection Code: <b>{{$order_tbl->cash_shipping_code}}</b></p>
                        @else
                            <p>Amount: <b> <?php echo $total_cost=$order_tbl->shipping_price+$order_tbl->product_price;?></b></p>
                            <p>Transection Code: <b>{{$order_tbl->transection_code}}</b></p>
                        @endif
                        <br>
                        <p>অর্ডার নোট: <p>{{$order_tbl->description}}</p></p>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

    </div>
</div>

@endsection

@section('script')

    @if( !empty($dfrom) or  !empty($dto))               
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('makecommand/search_order')}}";
            location.replace(url+"?dfrom=<?php echo $dfrom?>&dto=<?php echo $dto?>&search_by="+selectby+"&search="+select);
        }
        </script>
    @else                            
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('makecommand/search_order')}}";
            location.replace(url+"?search_by="+selectby+"&search="+select);
        }
        </script>
    @endif

@endsection