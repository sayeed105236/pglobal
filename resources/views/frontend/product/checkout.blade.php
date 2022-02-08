@extends('frontend.master.master')
@section('title',"Checkout")
@section('body')

@section('css')
@endsection





@php
	$Auth_id=Auth::User()->id;
	$user=App\User::findOrFail($Auth_id);
@endphp
<!-- Breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="">
					<ul class="bread-list">
						<li><a href="{{URL('/')}}">Home</a></li>
						<li class="active"><a href="{{URL('checkout')}}">Checkout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->

<div class="section">
	<div class="container">
		<div class="row clearfix">

            @if (session('status'))
            	<div class="col-md-12">
	                <div class="alert alert-success" role="alert">
	                    {{ session('status') }}
	                </div>
            	</div>
            @endif
            @if (session('error'))
            	<div class="col-md-12">
	                <div class="alert alert-warning" role="alert">
	                    {{ session('error') }}
	                </div>
            	</div>
            @endif



				
		<!-- Start Checkout -->
		<section class="shop checkout section">
			<form class="container"method="post" action="{{URL('order_place')}}">
			{{csrf_field()}}
				<div class="row"> 
					<div class="col-lg-7 col-12">
						<div class="checkout-form">
							<h2>Make Your Checkout</h2>
							<h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                    Billing Details
                                </h3>
							<!-- Form -->
								<div class="row">
									<div class="col-lg-12 col-md-12 col-12">
										<div class="form-group">
											<label>Name<span>*</span></label>
											<input class="form-control form-control-md" type="text" name="name" value="{{$user->name}}" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Email Address<span>*</span></label>
											<input class="form-control form-control-md" type="email" name="email" value="{{$user->email}}" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Phone Number<span>*</span></label>
											<input class="form-control form-control-md" type="number" name="phone" value="{{$user->phone}}" required="required">
										</div>
									</div>
									<hr>
									<div class="col-md-12 col-12" style="margin: 0px 10px;font-size: 14px;">
										আপনার ডেলিভারি এড্রেস
									</div>
									<div class="col-lg-12 col-md-12 col-12">
										<div class="form-group">
											<label>Address<span>*</span></label>
											@if(empty($user->address))
												<input class="form-control form-control-md" type="text" name="address" placeholder="House# 123, Street# 123, ABC Road" required="required">
											@else
												<input class="form-control form-control-md" type="text" name="address" value="{{$user->address}}" required="required">
											@endif
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Post Office<span>*</span></label>
											<input type="text" class="form-control form-control-md" required name="police_station" placeholder="">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>District<span>*</span></label>
											<select class="form-control form-control-md district" name="district" required="required" id="district">
										        <option value="" selected></option>
										        <option value="Bagerhat">Bagerhat</option>
										        <option value="Bandarban">Bandarban</option>
										        <option value="Barguna">Barguna</option>
										        <option value="Barisal">Barisal</option>
										        <option value="Bhola">Bhola</option>
										        <option value="Bogra">Bogra</option>
										        <option value="Brahmanbaria">Brahmanbaria</option>
										        <option value="Chandpur">Chandpur</option>
										        <option value="Chittagong">Chittagong</option>
										        <option value="Chuadanga">Chuadanga</option>
										        <option value="Comilla">Comilla</option>
										        <option value="Cox'sBazar">Cox'sBazar</option>
										        <option value="Dhaka">Dhaka</option>
										        <option value="Dinajpur">Dinajpur</option>
										        <option value="Faridpur">Faridpur</option>
										        <option value="Feni">Feni</option>
										        <option value="Gaibandha">Gaibandha</option>
										        <option value="Gazipur">Gazipur</option>
										        <option value="Gopalganj">Gopalganj</option>
										        <option value="Habiganj">Habiganj</option>
										        <option value="Jaipurhat">Jaipurhat</option>
										        <option value="Jamalpur">Jamalpur</option>
										        <option value="Jessore">Jessore</option>
										        <option value="Jhalokati">Jhalokati</option>
										        <option value="Jhenaidah">Jhenaidah</option>
										        <option value="Khagrachari">Khagrachari</option>
										        <option value="Khulna">Khulna</option>
										        <option value="Kishoreganj">Kishoreganj</option>
										        <option value="Kurigram">Kurigram</option>
										        <option value="Kushtia">Kushtia</option>
										        <option value="Lakshmipur">Lakshmipur</option>
										        <option value="Lalmonirhat">Lalmonirhat</option>
										        <option value="Madaripur">Madaripur</option>
										        <option value="Magura">Magura</option>
										        <option value="Manikganj">Manikganj</option>
										        <option value="Maulvibazar">Maulvibazar</option>
										        <option value="Meherpur">Meherpur</option>
										        <option value="Munshiganj">Munshiganj</option>
										        <option value="Mymensingh">Mymensingh</option>
										        <option value="Naogaon">Naogaon</option>
										        <option value="Narail">Narail</option>
										        <option value="Narayanganj">Narayanganj</option>
										        <option value="Narsingdi">Narsingdi</option>
										        <option value="Natore">Natore</option>
										        <option value="Nawabganj">Nawabganj</option>
										        <option value="Netrokona">Netrokona</option>
										        <option value="Nilphamari">Nilphamari</option>
										        <option value="Noakhali">Noakhali</option>
										        <option value="Pabna">Pabna</option>
										        <option value="Panchagarh">Panchagarh</option>
										        <option value="Patuakhali">Patuakhali</option>
										        <option value="Pirojpur">Pirojpur</option>
										        <option value="Rajbari">Rajbari</option>
										        <option value="Rajshahi">Rajshahi</option>
										        <option value="Rangamati">Rangamati</option>
										        <option value="Rangpur">Rangpur</option>
										        <option value="Satkhira">Satkhira</option>
										        <option value="Shariatpur">Shariatpur</option>
										        <option value="Sherpur">Sherpur</option>
										        <option value="Sirajganj">Sirajganj</option>
										        <option value="Sunamganj">Sunamganj</option>
										        <option value="Sylhet">Sylhet</option>
										        <option value="Tangail">Tangail</option>
										        <option value="Thakurgaon">Thakurgaon</option>
										</select>
										</div>
									</div>

									<div class="col-lg-12 col-md-12 col-12">
											<label>নোট</label>
										<div class="form-group">
											<textarea class="form-control mb-0" id="order-notes" name="description" cols="30" rows="4" placeholder="Notes about your order, e.g special notes for delivery"></textarea>

										</div>
									</div>
									
								
								</div>
							<!--/ End Form -->
						</div>
					</div>
					<div class="col-lg-5 col-12">
						<div class="order-details">
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>YOUR ORDER</h2>
								<div class="content">
									<ul>
										<table class="yo_tbl">
											<tr class="yo_tr">
												<td class="yo_td">Sub Total</td>
												<td class="yo_td">
													@php
														$Auth_id=Auth::user()->id;
														$cart_tbl=App\admin\cart_tbl::where('user_id',$Auth_id)->get();
														$total_cost=0;
													@endphp
													
													@foreach($cart_tbl as $cart_tbl)



									      	<?php 
									      		$quantity="{$cart_tbl->quantity}";
									      		$color="{$cart_tbl->color}";
									      		$size="{$cart_tbl->size}";

														$product_id="{$cart_tbl->product_id}";
														$product_details=App\admin\product_tbl::find($product_id);

														if( !empty($color) || !empty($size)){
											        $product_attri=App\admin\product_attri_tbl::where('product_id', $product_id)->where('color', $color)->where('size', $size)->first();

											        $price="{$product_attri->price}";
									      		}
									      		else{$price="{$product_details->price}";}
									      		$sum_price=$quantity*$price;

															$total_cost=(int)$total_cost+$sum_price;
														?>		    
													@endforeach
														৳<?php echo $total_cost?>
												</td>
											</tr>
											<tr class="yo_tr">
												<td class="yo_td">
													(+) Shipping	
											<button type="button" class="info_btn" data-toggle="modal" data-target="#modalofshipping">
													 <i class="fas fa-info-circle"></i>
											</button>							
														
												</td>
												<td class="yo_td"><span id="shipping_price"></span></td>
											</tr>
											<tr class="yo_tr">
												<td class="yo_td">Total</td>
												<td class="yo_td"><span id="total_taka"></span></td>
											</tr>
										</table>

											<!-- Modal of shipping Start -->
											<div class="modal fade" id="modalofshipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											  <div class="modal-dialog modal-dialog-centered" role="document">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h5 class="modal-title" id="exampleModalLongTitle">ডেলিভারি চার্জ</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body">
											        <table class="table table-striped shopping-summery">
												    		<tr class="dch_th1">
												    			<th colspan="3" class="text-center">ডেলিভারি চার্জ</th>
												    		</tr>
												    		<tr class="dch_th2">
												    			<th>জায়গা</th>
												    			<th>চার্জ</th>
												    			<th>সময়</th>
												    		</tr>
												    		@php
																	$shipping_tbl=App\admin\shipping_tbl::orderBy('time','asc')->get();
																@endphp
																@foreach($shipping_tbl as $shipping_tbl)
																<tr class="dch_tr">
																	<td>
																		{{$shipping_tbl->district}}
										                 @if($shipping_tbl->district=="Other")
		                                    <small>(অন্যান্য সব জায়গা)</small>
		                                	@endif
																	</td>
																	<td>{{$shipping_tbl->price}}টাকা</td>
																	<td>{{$shipping_tbl->time}} দিন</td>
																</tr>
														    @endforeach
											        </table>
											      			<div class="col-12 col-md-12 dch_wrning_w">
											      				<div class="alert alert-warning">
												      				আলাদা আলাদা মারচেন্ট থেকে পণ্য ক্রয়েরক্ষেত্রে শিপিং চার্জ আলাদাভাবে ধার্য করা হবে
											      				</div>
											      			</div>
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											      </div>
											    </div>
											  </div>
											</div>
											<!-- Modal of shipping End -->

											
									</ul>
								</div>
							</div>
							<!--/ End Order Widget -->
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>Payments</h2>
								<div class="content">
									<div class="checkbox">
										<div class="radio_btn_w" for="2">
											<input class="ch_in" name="payment" value="Cash" type="radio" required>
											<span>Cash On Delivery</span>
										</div>
									</div>
								</div>
							</div>
							<!--/ End Order Widget -->
							<!-- Payment Method Widget -->
							<!-- <div class="single-widget payement">
								<div class="content">
									<img src="{{URL('public/allfiles/img/payment.JPG')}}" alt="#">
								</div>
							</div> -->
							<!--/ End Payment Method Widget -->
							<!-- Button Widget -->
							<div class="single-widget get-button">
								<div class="content">
									<div class="button">
										<button type="submit" class="btn">Proceed to checkout</button>
									</div>
								</div>
							</div>
							<!--/ End Button Widget -->
						</div>
					</div>
				</div>
			</form>
		</section>
		<!--/ End Checkout -->








		<div class="container">
			<div class="row">
						
					<div class="col-md-12">
						<div class="cs_card">
							<div class="cs_card_body table-responsive">
								<table class="table table-striped shopping-summery">
								  <thead>
										<tr class="main-hading" style="border-top: none;">
											<th>PRODUCT</th>
											<th>NAME</th>
											<th>SHOP NAME</th>
											<th class="text-center">UNIT PRICE</th>
											<th class="text-center">QUANTITY</th>
											<th class="text-center">TOTAL</th> 
										</tr>
								  </thead>
								  <tbody>
								  	@php
								  		$t_g_price=0;
								  		$total_loop=0;
									    $Auth_user_id=Auth::user()->id;
									    $cart_product=App\admin\cart_tbl::orderBy('id', 'desc')->where('user_id',$Auth_user_id)->get();
								  	@endphp
								  	

								  	@foreach($cart_product as $data)
									
										@php
											$total_loop=$total_loop+1;
											$loop="{$loop->iteration}";
											$product_id="{$data->product_id}";
											$color="{$data->color}";
											$size="{$data->size}";

											$product_details=App\admin\product_tbl::find($product_id);
										@endphp

								    <tr class="main-hading cart_tbdy_tr">
								      <td>
											<?php $name="{$product_details->name}"; $name = str_replace(' ', '-', $name);?>
												<a href="{{URL('product')}}/<?php echo $name?>/{{$product_details->id}}">
									      	<div class="cart_img_w">
										    		<img class="thumb_pv_main_img" src="{{URL('public/allfiles/img/product/thumb')}}/{{$product_details->main_image}}" alt="">
									      	</div>
										    </a>
									    </td>
									    <td>
												<a href="{{URL('product')}}/<?php echo $name?>/{{$product_details->id}}">
											      	<p class="cart_pname">{{$product_details->name}}</p>
										    </a>
								      	<div class="cart_name_w">
									      	<p class="cart_p_attr">
									      		@if(!empty($data->size))
										      		<b>size:</b>{{$data->size}}
									      		@endif
									      		&nbsp
									      		@if(!empty($data->color))
										      		<b>color:</b>{{$data->color}}
									      		@endif
									      	</p>
								      	</div>
									      </td>
									      <td>
												<a href="{{URL('product')}}/<?php echo $name?>/{{$product_details->id}}">
										      		@php
										      			$shop=App\User::find($product_details->user_id);
										      		@endphp
													<p class="cart_simg">
														<img src="{{URL('public/allfiles/img/pp')}}/{{$shop->pp}}">
													</p>
											      	<p class="cart_sname">{{$shop->name}}</p>
										        </a>
									      </td>

									      <td class="">
									      	<?php 
									      		$quantity="{$data->quantity}";
									      		$before_discount="{$product_details->before_discount}";
									      		$color="{$data->color}";
									      		$size="{$data->size}";

														if( !empty($color) || !empty($size)){
											        $product_attri=App\admin\product_attri_tbl::where('product_id', $product_id)->where('color', $color)->where('size', $size)->first();

											        $price="{$product_attri->price}";
											        $product_in_stock="{$product_attri->stock}";
									      		}
									      		else{
											        $price="{$product_details->price}";
											        $product_in_stock_to_check="{$product_details->stock}";
																if( !empty($product_in_stock_to_check)){
															        $product_in_stock="{$product_details->stock}";
																}
																else{ $product_in_stock=1000; }
									      		}
									      		$sum_price=$quantity*$price;
									      	?>

									      	@if($quantity <= $product_in_stock)
														<h4 class="product-price">৳ {{$product_details->price}}</h4>
									      		<?php $t_g_price=$t_g_price+$sum_price;?>
													@else
														<div class="shp_add_btn_w mt_20 col-md-12 col-12">
															<button type="button" class="btn btn_sz primary_btn2">
															   Out of stock
															</button>
														</div>
													@endif
									      </td>

									    <td class="scart_sw">{{$data->quantity}}</td>
										  <td><?php echo $quantity*$price;?></td>

									   </tr>
								    @endforeach

								    	<tr>
								    		<td></td>
								    		<td></td>
								    		<td></td>
								    		<td>
								    			<h5>Total</h5>
								    		</td>
								    		<td class="text-center">
										      	<h4 id="total_sumup_taka" class="text-center">
										      		৳
										      		<?php 
										      			echo $t_g_price;
										      			?>
										      	</h4>
								    		</td>
								    	</tr>
								  </tbody>
									
								</table>
							</div>
						</div>
					</div>
			</div>
		</div>


		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("input[type='radio']").change(function() {
                if ($(this).val() == "Cash") {
                    $("#Bkash").hide();
                    $("#Rocket").hide();
                    $("#Nagad").hide();
                    $("#in_Rocket").remove();
                    $("#in_Nagad").remove();
                    $("#in_Bkash").remove();
                }
                else if ($(this).val() == "Bkash") {
                    $("#Bkash").show();
                    $("#Rocket").hide();
                    $("#Nagad").hide();
                    $("#in_Rocket").remove();
                    $("#in_Nagad").remove();

                    $("#Bkash").append("<span>আপনার ট্রান্সেকশন কোডটি দিন</span><input type='text'class='form-control'id='in_Bkash'name='transection_code'>");
                }
                else if ($(this).val() == "Rocket") {
                    $("#Rocket").show();
                    $("#Bkash").hide();
                    $("#Nagad").hide();
                    $("#in_Bkash").remove();
                    $("#in_Nagad").remove();

                    $("#Rocket").append("<span>আপনার ট্রান্সেকশন কোডটি দিন</span><input type='text'class='form-control'id='in_Rocket'name='transection_code'>");
                }
                else if ($(this).val() == "Nagad") {
                    $("#Nagad").show();
                    $("#Bkash").hide();
                    $("#Rocket").hide();
                    $("#in_Bkash").remove();
                    $("#in_Rocket").remove();

                    $("#Nagad").append("<span>আপনার ট্রান্সেকশন কোডটি দিন</span><input type='text'class='form-control'id='in_Nagad'name='transection_code'>");
                }
            });
        });
    </script>

@php
	$Auth_id=Auth::user()->id;
	$cart_shop_count=App\admin\cart_tbl::orderBy('id', 'desc')->where('user_id',$Auth_id)->select('shop_id')->distinct('shop_id')->count();
@endphp

<script type="text/javascript">
$(document).ready(function(){
	$('#district').on('change', function() {
		
		@php
			$shipping_tbl=App\admin\shipping_tbl::orderBy('time','asc')->get();
			$shipping_tbl_other=App\admin\shipping_tbl::where('district','Other')->first();
		@endphp
        @foreach($shipping_tbl as $shipping_tbl)

		    @if ($loop->first)
			    if( this.value == "<?php echo ucwords($shipping_tbl->district);?>" ){
				    <?php 
					    $sp="{$shipping_tbl->price}";
					    $total_shipping_price=$sp*$cart_shop_count;
				    ?>
				    $("#mdl_shipping").text("আপনার টোটাল ডেলিভারি চার্জ ৳<?php echo $total_shipping_price;?>");
				    $("#shipping_price").text("৳ <?php echo $total_shipping_price;?>");
				    $("#total_taka").text("৳ <?php echo $main_cost=$total_cost+$total_shipping_price;?>");
		        }
		    @else
			    else if( this.value == "<?php echo ucwords($shipping_tbl->district);?>" ){
				    <?php 
					    $sp="{$shipping_tbl->price}";
					    $total_shipping_price=$sp*$cart_shop_count;
				    ?>
				    $("#mdl_shipping").text("আপনার টোটাল ডেলিভারি চার্জ ৳<?php echo $total_shipping_price;?>");
				    $("#shipping_price").text("৳ <?php echo $total_shipping_price;?>");
				    $("#total_taka").text("৳ <?php echo $main_cost=$total_cost+$total_shipping_price;?>");
		        }
		    @endif
		@endforeach

        else{
			    <?php 
				    $sp="{$shipping_tbl_other->price}";
				    $total_shipping_price=$sp*$cart_shop_count;
			    ?>
				    $("#mdl_shipping").text("আপনার টোটাল ডেলিভারি চার্জ ৳<?php echo $total_shipping_price;?>");
		    $("#shipping_price").text("৳ <?php echo $total_shipping_price;?>");
		    $("#total_taka").text("৳ <?php echo $main_cost=$total_cost+$total_shipping_price;?>");
        }

	});
});
</script>
<script type="text/javascript">
    function forgift()
    {
        if($('.forgift').is(":checked"))   
            $("#forgiftdiv").show();
        else
            $("#forgiftdiv").hide();
    }
</script>


@endsection
