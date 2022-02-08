@extends('frontend.master.master')
@section('title',"cart")
@section('body')

@section('css')
	<style type="text/css">
		.mdl_bdy_w {
    padding: 73px 10px;
    text-align: center;
    font-size: 25px;
	}

	.mdl_bdy_w p {
	    line-height: 36px;
	}

	.modal-body {
	    height: fit-content !important;
	}
	</style>
@endsection




@guest
	<div class="section">
		<div class="container">
			<div class="row clearfix">

				<div class="col-md-12">
					<div class="cs_card">
						<div class="cs_card_header">
							<div class="cs_card_title vc_lg_w">
								<a href="login" class="btn primary_btn">
									আপনার কার্ট দেখতে লগিন করুন
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@else
<?php $t_g_price=0;?>

<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="">
					<ul class="bread-list">
						<li><a href="{{URL('/')}}">Home</a></li>
						<li class="active"><a href="{{URL('cart')}}">Cart</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

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

<form method="post" action="update_cart" class="cart_w_form col-md-12">
	{{csrf_field()}}
			<div class="col-md-12">
				<div class="cs_card">
					<div class="cs_card_body table-responsive">
						<table class="table table_cart table shopping-summery">
						  <thead>
								<tr class="main-hading" style="border-top: none;">
									<th>PRODUCT</th>
									<th>NAME</th>
									<th>SHOP NAME</th>
									<th class="text-center">UNIT PRICE</th>
									<th class="text-center">QUANTITY</th>
									<th class="text-center">TOTAL</th> 
									<th class="text-center"><i class="fas fa-trash-alt"></i></th>
								</tr>
						  </thead>
						  <tbody>
						  	<?php $total_loop=0;?>
						  	@foreach($cart_product as $data)
							<?php 
								$total_loop=$total_loop+1;
								$loop="{$loop->iteration}";
								$product_id="{$data->product_id}";
								$color="{$data->color}";
								$size="{$data->size}";
							?>
							<input type="hidden" name="id<?php echo $loop?>" value="{{$data->id}}">
							@php 
								$product_details=App\admin\product_tbl::find($product_id);
							@endphp

						    <tr class="main-hading cart_tbdy_tr">
						      <td>
								<?php
									$name="{$product_details->name}";
									$name = str_replace(' ', '-', $name);?>
									<a href="{{URL('product')}}/<?php echo $name?>/{{$product_details->id}}">
							      	<div class="cart_img_w">
								    	<img class="thumb_pv_main_img" src="{{URL('public/allfiles/img/product/thumb')}}/{{$product_details->main_image}}" alt="">
							      	</div>
								     </a>
							      </td>
							      <td>
										<a href="{{URL('product')}}/<?php echo $name?>/{{$product_details->id}}">
									      	<p class="cart_pname">
									      		{{$product_details->name}}
									      	</p>
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
									    $stock_desc="{$product_details->stock_desc}";
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

							      <td class="scart_sw">
							      	@if($quantity <= $product_in_stock)
								      	<input class="input shp_quan" min="1" max="<?php echo $product_in_stock;?>" name="quantity<?php echo $loop?>" value="{{$data->quantity}}" id="quantity<?php echo $loop?>" onchange="ts_sc<?php echo $loop?>()" type="number">

							      	@elseif($product_in_stock == 0)
							      	0
									@else
								      	<input class="input shp_quan" min="1" max="<?php echo $product_in_stock;?>" name="quantity<?php echo $loop?>" value="{{$data->quantity}}" id="quantity<?php echo $loop?>" onchange="ts_sc<?php echo $loop?>()" type="number">
									@endif
							      </td>

								   <td>
							      	@if($quantity <= $product_in_stock)
								      	<input type="disable" id="taka_sum<?php echo $loop?>" class="cart_taka_sum text-center" value="<?php echo $quantity*$price;?>" onchange="total_sumup()" disabled>
									@else
								      	<input type="hidden" id="taka_sum<?php echo $loop?>" class="cart_taka_sum text-center" value="<?php echo $quantity*$price;?>" onchange="total_sumup()" disabled>
								      	0
									@endif
							      		

							      	<script type="text/javascript">
										function ts_sc<?php echo $loop?>(){
										  var price=<?php echo $price?>;
										  var quantity = document.getElementById("quantity<?php echo $loop?>").value;
										  var sum=price*quantity;
										  document.getElementById("taka_sum<?php echo $loop?>").value = sum;

										  total_sumup();
										}
							      	</script>
							      </td>
							      <td>
							      	<a href="delete_from_cart?id={{$data->id}}" class="cart_dlt_btn">
							      		<i class="fas fa-trash-alt"></i>
							      	</a>
							      </td>

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
								      		৳<?php echo $t_g_price?>
								      	</h4>
						    		</td>
						    		<td>
										<button type="submit" class="btn btn-success">
											Update
										</button>
						    		</td>
						    	</tr>
						  </tbody>
							
						</table>
					</div>
				</div>
			</div>
<hr>
			<div class="row">
				<div class="col-md-7 col-12">
				</div>
				<div class="col-md-5 col-12 cors_w cart-summary mb-4">
					<div class="cs_card cors">
						<div class="cs_card_header cors_h">
							<div class="cs_card_title">
								অর্ডার সামারি
							</div>
						</div>
						<div class="cs_card_body cors_b">

@php
	$Auth_id=Auth::user()->id;
	 $cart_shop_count=App\admin\cart_tbl::where('user_id',$Auth_id)->select('shop_id')->distinct('shop_id')->count();
	 $cart_shop=App\admin\cart_tbl::where('user_id',$Auth_id)->distinct('shop_id')->select('shop_id')->get();
@endphp
							<table class="table bord_less">
								<tr>
									<td class="cors_pcl1">
										মোট প্রোডাক্ট ভেরিয়েন্ট
									</td>
									<td class="cors_pcr1">
										<?php echo $total_loop;?>টি 
									</td>
								</tr>
								<tr>
									<td class="cors_pcl1">
										টোটাল শপের পণ্য
									</td>
									<td class="cors_pcr1">
										<?php echo $cart_shop_count;?>টি 
									</td>
								</tr>
								<tr>
									<td class="cors_pcl2">
										মোট 
									</td>
									<td class="cors_pcr2">
								      	<h4 id="total_sumup_taka">
								      		৳ <?php echo $t_g_price?>
								      	</h4>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										@if($cart_shop_count > 1)
											<!-- Button trigger modal -->
											<button type="button" class="btn full_width_btn" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
											Proceed to Checkout<i class="w-icon-long-arrow-right"></i>
											</button>

											<!-- Modal -->
											<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											  <div class="modal-dialog modal-dialog-centered" role="document">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h5 class="modal-title text-left" id="exampleModalLongTitle">
											        </h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body">
											        <div class="mdl_bdy_w">
											        	<p>
											        	আপনি
											        		<b>
											        		@foreach($cart_shop as $cart_shop)
											        			@php
													      			echo $shop=App\User::find($cart_shop->shop_id)->name;
											        			@endphp
													      			@if($loop->last)
													      			 
													      			@else
													      			,
													      			@endif
											        		@endforeach
												        	</b>

											        	এই শপ {{$cart_shop_count}}টির  পণ্য কার্টে যুক্ত করেছেন। তাই এই {{$cart_shop_count}}টি শপ এর জন্যে আলাদা আলাদা ডেলিভারি চার্জ এবং আলাদাভাবেই পণ্য অর্ডার হবে</p>
											        </div>
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<a href="{{URL('checkout')}}"  class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
											Proceed to Checkout<i class="w-icon-long-arrow-right"></i>
													</a>
											      </div>
											    </div>
											  </div>
											</div>
										@else
										<a href="{{URL('checkout')}}" class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
											Proceed to Checkout<i class="w-icon-long-arrow-right"></i>
										</a>
										@endif
									</td>
								</tr>
							</table>				
						</div>
					</div>
				</div>
			</div>

<input type="hidden" name="total_loop" value="<?php echo $total_loop;?>">
</form>		

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

@endguest


@section('script')
	<script type="text/javascript">
	function total_sumup(){
	  <?php for($i=1;$i<=$total_loop;$i++){?>

		  var total_sumup_tk<?php echo $i;?> = Number(document.getElementById("taka_sum<?php echo $i?>").value);
	  <?php }?>

	  var all_taka=<?php for($i=1;$i<=$total_loop;$i++){?> total_sumup_tk<?php echo $i;?> +<?php }?> 0;
	    document.getElementById("total_sumup_taka").innerHTML = all_taka;

	}
	</script>
@endsection




@endsection
