@extends('frontend.master.master')
	@section('css')
	@endsection
@section('body')




@include('frontend.profile.profile_master')

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
  
    <div class="col-md-12">
        <div class="card widget-box">
            <div class="card-body table-responsive">

                <table class="table table-striped shopping-summery">
                  <tbody>
                        <tr class="main-hading text-center">
                            <th colspan="6" class="text-center">
                                <i class="w-icon-orders"></i>  Order Items
                            </th>
                        </tr>


                        <tr class="main-hading">
                            <th>S.L.</th>
                            <th>Product Image</th>
                            <th>Product Details</th>
                            <th>Unit Price</th>
                            <th>Unit</th>
                            <th>Total Price</th>
                        </tr>

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
                                <a href="{{URL('product')}}/<?php echo $name?>/{{$product_details->id}}">
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
        <div class="card widget-box cs_card">
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


    <div class="col-md-8 col-12 m-t50 m-b50">
        <div class="card cs_card">
            <div class="card_main_heading">
                Order details 
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
    <!-- End of PageContent -->
</main>
<!-- End of Main -->




@endsection
