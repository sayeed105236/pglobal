@extends('frontend.master.master')
@section('title',"{$product_tbl->name}")
@section('body')

@section('css')
@endsection

<?php 
	$product_id="{$product_tbl->id}";
	$before_discount="{$product_tbl->before_discount}";
	$price="{$product_tbl->price}";
	$product_category="{$product_tbl->category}";
?>





<!-- Start of Main -->
<main class="main mb-10 pb-1">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav container">
        <ul class="breadcrumb bb-no">
            <li><a href="demo1.html">Home</a></li>
            <li>Products</li>
        </ul>
    </nav>
    <!-- End of Breadcrumb -->


			@if (session('product_cart_status'))
				<div class="minipopup-area"><div class="minipopup-box show" style="top: 0px;">
					<div class="product product-list-sm  product-cart">
						<figure class="product-media">
							<a href="#">
								<img src="{{URL('public/allfiles/img/product/thumb')}}/{{$product_tbl->main_image}}" alt="Product" width="80" height="90">
							</a>
						</figure>
						<div class="product-details">
							<h4 class="product-name">
								<a href="#">{{$product_tbl->name}}</a>
							</h4>
							<p>has been added to cart:</p>
						</div>
					</div>
					<div class="product-action"><a href="{{URL('cart')}}" class="btn btn-rounded btn-sm">View Cart</a>
					</div>
					</div>
				</div>
	    @endif

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg">
                <div class="main-content">
                    <div class="product product-single row">


                        <div class="col-md-6 mb-6">
                            <div class="product-gallery product-gallery-sticky">
                                <div
                                    class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                                    <figure class="product-image">
                                        <img src="{{URL('public/allfiles/img/product/large')}}/{{$product_tbl->main_image}}"
                                            data-zoom-image="{{URL('public/allfiles/img/product/large')}}/{{$product_tbl->main_image}}" width="800" height="900">
                                    </figure>

			                              <?php $image="{$product_tbl->image}"; $image= explode(",",$image); ?>
			                              @foreach($image as $image)
			                                <figure class="product-image">
			                                    <img src="{{URL('public/allfiles/img/product/large')}}/{{$image}}"
			                                        data-zoom-image="{{URL('public/allfiles/img/product/large')}}/{{$image}}" width="488" height="549">
			                                </figure>
			                              @endforeach
                                </div>
                                <div class="product-thumbs-wrap">
                                    <div class="product-thumbs row cols-4 gutter-sm">
                                        <div class="product-thumb active">
                                            <img src="{{URL('public/allfiles/img/product/thumb')}}/{{$product_tbl->main_image}}"
                                                alt="Product Thumb" width="800" height="900">
                                        </div>

			                              <?php $image="{$product_tbl->image}"; $image= explode(",",$image); ?>
			                              @foreach($image as $image)
                                        <div class="product-thumb">
                                            <img src="{{URL('public/allfiles/img/product/thumb')}}/{{$image}}"
                                                alt="Product Thumb" width="800" height="900">
                                        </div>
			                              @endforeach
                                    </div>
                                    <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                                    <button class="thumb-down disabled"><i
                                            class="w-icon-angle-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-6">
                            <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                <h2 class="product-title">{{$product_tbl->name}}</h2>
                                <div class="product-bm-wrapper">
                                    <figure class="brand">
                                        <img src="{{URL('public/allfiles/img/product/large')}}/{{$product_tbl->main_image}}" alt="Brand"
                                            width="102" height="48" />
                                    </figure>
                                
                                    <div class="product-meta">
                                        <div class="product-categories">
                                            Category:
                                            <span class="product-category">
                                            	<!-- <a href="#">Electronics</a> -->
                                            	{{$product_tbl->category}}
                                            </span>
                                        </div>
                                        <div class="product-sku">
                                            SKU: <span>{{$product_tbl->code}}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="product-divider">

                                <div class="product-price">
                                    <ins class="new-price" id="show_prodct_total_price">
                                        ৳ {{$product_tbl->price}}

                                        <?php $before_discount = $product_tbl->before_discount;?>
                                        @if($before_discount !== NULL)
                                        <del style="font-size: 20px;"><?php echo $before_discount;?></del>

                                            <label class="product-label label-discount" style="font-size: 12px; padding: 3px 12px;">
                                                <?php
                                                    $price = $product_tbl->price;
                                                    $getting_dis= $before_discount - $price;
                                                    $per_dis = ($getting_dis / $before_discount) * 100;
                                                    echo number_format((float)$per_dis, 2, '.', '');
                                                ?>
                                                % Off
                                            </label>
                                        @endif
                                    </ins>
                                </div>

                                <!-- <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 80%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="#product-tab-reviews" class="rating-reviews scroll-to">(3
                                        Reviews)</a>
                                </div> -->

                                <div class="product-short-desc">
                                    <ul class="list-type-check list-style-none">
                                        
                                        <?php 
                                        $description=$product_tbl->description;
                                        $product_id=$product_tbl->id;

                                       echo strlen($description) > 100 ? substr($description,0,100).'..' : $description;
                                        ?>

                                    </ul>
                                </div>
                                <hr class="product-divider">


@php
  $product_attri_count=App\admin\product_attri_tbl::where('product_id', $product_id)->count();
@endphp


<!-- Product without Attribute show Start -->
@if($product_attri_count == 0)
<form method="get" action="{{URL('add_to_cart')}}">
            <input type="hidden" name="product_id" value="{{$product_tbl->id}}">


        <div class="fix-bottom product-sticky-content sticky-content">
          <div class="product-form container row">
              <div class="product-qty-form col-md-12">
                  <div class="input-group stock_inp">
                        <?php $stock="{$product_tbl->stock}"; $stock_desc="{$product_tbl->stock_desc}";?>
                        @if($stock > 0)
                            <input class="quantity form-control" onchange="showFunction()" min="1"  max="{{$product_tbl->stock}}" id="input_stock" required name="quantity" type="number">
                          <button type="button" class="quantity-plus w-icon-plus"  onclick="showFunction()"></button>
                          <button type="button" class="quantity-minus w-icon-minus"  onclick="showFunction()"></button>
                                      
                        @else
                            <input class="quantity form-control" onchange="showFunction()" min="1"  id="input_stock" required name="quantity" type="number">
                          <button type="button" class="quantity-plus w-icon-plus"  onclick="showFunction()"></button>
                          <button type="button" class="quantity-minus w-icon-minus"  onclick="showFunction()"></button>
                                      
                        @endif
                  </div>
              </div>
              @php 
                $product_attri_count=App\admin\product_attri_tbl::where('product_id', $product_id)->count();
              @endphp
              @if($product_attri_count == 0)
                    <script type="text/javascript">
                        function showFunction() {
                            var main_price = <?php echo $product_tbl->price;?>;
                            var input_stock = document.getElementById("input_stock").value;
                            var total_price = input_stock * main_price;
                                document.getElementById("show_prodct_total_price").innerHTML = "৳"+ total_price;
                        }
                    </script>
              <button type="submit" class="btn btn-primary col-md-12" style="flex: 1; margin-bottom: 1rem; padding-left: 0; padding-right: 0; min-width: 14rem;"  id="show_stock_cart">
                  <i class="w-icon-cart"></i>
                  <span>Add to Cart</span>
              </button>
              @else
              <button type="submit" class="btn btn-primary col-md-12" style="display:none;flex: 1; margin-bottom: 1rem; padding-left: 0; padding-right: 0; min-width: 14rem;"  id="show_stock_cart">
                  <i class="w-icon-cart"></i>
                  <span>Add to Cart</span>
              </button>
              <span class="btn not_cart_btn"  id="show_not_stock_cart"  style="display:none;flex: 1; margin-bottom: 1rem; padding-left: 0; padding-right: 0; min-width: 14rem;">
                  <i class="w-icon-cart"></i>
                  <span>Not in Stock</span>
              </span>
              <span class="btn not_cart_btn"  id="attri_not_selected"  style="flex: 1; margin-bottom: 1rem; padding-left: 0; padding-right: 0; min-width: 14rem;">
                  <i class="w-icon-cart"></i>
                  <span>Please Select Attribute</span>
              </span>
                @php
                    $product_attri=App\admin\product_attri_tbl::where('product_id', $product_id)->get();
                @endphp

                <script type="text/javascript">
                    function showFunction() {

                        var showing_color = document.getElementById("showing_color").value;
                        var showing_size = document.getElementById("showing_size").value;


                        if(1==0){}
                          <?php foreach($product_attri as $product_attri){ ?>

                            else if (showing_color == "<?php echo $product_attri->color;?>" && showing_size == "<?php echo $product_attri->size;?>") {

                                var main_price = <?php echo $product_attri->price;?>;



                                    var input_stock = document.getElementById("input_stock").value;
                                    var total_price = input_stock * main_price;
                                    document.getElementById("show_prodct_attri_price").innerHTML = "৳"+ total_price;


                                // Check Stock
                                var stock = <?php echo $product_attri->stock;?>;
                                if(stock <= 0){
                                    document.getElementById("attri_not_selected").style.display = "none";
                                    document.getElementById("show_stock_cart").style.display = "none";
                                    document.getElementById("show_not_stock_cart").style.display = "block";
                                }
                                else{
                                    document.getElementById("attri_not_selected").style.display = "none";
                                    document.getElementById("show_stock_cart").style.display = "block";
                                    document.getElementById("show_not_stock_cart").style.display = "none";
                                }



                            }

                          <?php } ?>
                          else{
                                document.getElementById("attri_not_selected").style.display = "none";
                                document.getElementById("show_stock_cart").style.display = "none";
                                document.getElementById("show_not_stock_cart").style.display = "block";
                          }

                    }

                </script>
              @endif
          </div>
        </div>
    </form>
<!-- Product without Attribute show End -->


<!-- Product Attribute show Start -->
@else
    <form method="get" action="{{URL('add_to_cart')}}">
        	<input type="hidden" name="product_id" value="{{$product_tbl->id}}">
        <!-- Product Color -->
        @php
          $product_color=App\admin\product_attri_tbl::select('product_id', 'color')->where('product_id', $product_id)->distinct()->get();
         $product_color_count=App\admin\product_attri_tbl::select('product_id', 'color')->where('product_id', $product_id)->distinct()->count();
        @endphp

        @if($product_color_count < 1)
        @else
          <div class="product-form product-variation-form product-color-swatch">
              <label>Color:</label>
              <div class="d-flex align-items-center product-variations">

                    <select class="prdt_attri_slt" id="showing_color" name="color" onclick="showFunction()" required="">
                        <option selected>Select Color</option>
                        @foreach($product_color as $product_color)
                          <option value="{{$product_color->color}}">
                              {{$product_color->color}}
                          </option>
                        @endforeach
                    </select>
              </div>
          </div>
        @endif



        <!-- Product Size -->
        @php
          $product_size=App\admin\product_attri_tbl::select('product_id', 'size')->where('product_id', $product_id)->distinct()->get();
          $product_size_count=App\admin\product_attri_tbl::select('product_id', 'size')->where('product_id', $product_id)->count();
        @endphp

        @if($product_size_count < 1)
        @else
          <div class="product-form product-variation-form product-size-swatch">
              <label class="mb-1">Size:</label>
              <div class="flex-wrap d-flex align-items-center product-variations">

                    <select class="prdt_attri_slt" id="showing_size" name="size" onclick="showFunction()" required="">
                        <option selected>Select Size</option>
                        @foreach($product_size as $product_size)
                          <option value="{{$product_size->size}}">
                            {{$product_size->size}}
                          </option>
                        @endforeach
                    </select>
              </div>
          </div>
        @endif


        <div id="show_prodct_attri_price"></div>



        <div class="fix-bottom product-sticky-content sticky-content">
          <div class="product-form container row">
              <div class="product-qty-form col-md-12">
                  <div class="input-group stock_inp">
                        <?php $stock="{$product_tbl->stock}"; $stock_desc="{$product_tbl->stock_desc}";?>
                        @if(!$stock == NULL)
                            <input class="quantity form-control" onchange="showFunction()" min="1"  max="{{$product_tbl->stock}}" id="input_stock" required name="quantity" type="number">
                        @else
                            <input class="quantity form-control" onchange="showFunction()" min="1" id="input_stock" required name="quantity" type="number">
                        @endif
                      <button type="button" class="quantity-plus w-icon-plus"  onclick="showFunction()"></button>
                      <button type="button" class="quantity-minus w-icon-minus"  onclick="showFunction()"></button>
                  </div>
              </div>
              @php 
                $product_attri_count=App\admin\product_attri_tbl::where('product_id', $product_id)->count();
              @endphp
              @if($product_attri_count == 0)
                    <script type="text/javascript">
                        function showFunction() {
                            var main_price = <?php echo $product_tbl->price;?>;
                            var input_stock = document.getElementById("input_stock").value;
                            var total_price = input_stock * main_price;
                                document.getElementById("show_prodct_total_price").innerHTML = "৳"+ total_price;
                        }
                    </script>
              <button type="submit" class="btn btn-primary col-md-12" style="flex: 1; margin-bottom: 1rem; padding-left: 0; padding-right: 0; min-width: 14rem;"  id="show_stock_cart">
                  <i class="w-icon-cart"></i>
                  <span>Add to Cart</span>
              </button>
              @else
              <button type="submit" class="btn btn-primary col-md-12" style="display:none;flex: 1; margin-bottom: 1rem; padding-left: 0; padding-right: 0; min-width: 14rem;"  id="show_stock_cart">
                  <i class="w-icon-cart"></i>
                  <span>Add to Cart</span>
              </button>
              <span class="btn not_cart_btn"  id="show_not_stock_cart"  style="display:none;flex: 1; margin-bottom: 1rem; padding-left: 0; padding-right: 0; min-width: 14rem;">
                  <i class="w-icon-cart"></i>
                  <span>Not in Stock</span>
              </span>
              <span class="btn not_cart_btn"  id="attri_not_selected"  style="flex: 1; margin-bottom: 1rem; padding-left: 0; padding-right: 0; min-width: 14rem;">
                  <i class="w-icon-cart"></i>
                  <span>Please Select Attribute</span>
              </span>
                @php
                    $product_attri=App\admin\product_attri_tbl::where('product_id', $product_id)->get();
                @endphp

                <script type="text/javascript">
                    function showFunction() {

                        var showing_color = document.getElementById("showing_color").value;
                        var showing_size = document.getElementById("showing_size").value;


                        if(1==0){}
                          <?php foreach($product_attri as $product_attri){ ?>

                            else if (showing_color == "<?php echo $product_attri->color;?>" && showing_size == "<?php echo $product_attri->size;?>") {

                                var main_price = <?php echo $product_attri->price;?>;



                                    var input_stock = document.getElementById("input_stock").value;
                                    var total_price = input_stock * main_price;
                                    document.getElementById("show_prodct_attri_price").innerHTML = "৳"+ total_price;


                                // Check Stock
                                var stock = <?php echo $product_attri->stock;?>;
                                if(stock <= 0){
                                    document.getElementById("attri_not_selected").style.display = "none";
                                    document.getElementById("show_stock_cart").style.display = "none";
                                    document.getElementById("show_not_stock_cart").style.display = "block";
                                }
                                else{
                                    document.getElementById("attri_not_selected").style.display = "none";
                                    document.getElementById("show_stock_cart").style.display = "block";
                                    document.getElementById("show_not_stock_cart").style.display = "none";
                                }



                            }

                          <?php } ?>
                          else{
                                document.getElementById("attri_not_selected").style.display = "none";
                                document.getElementById("show_stock_cart").style.display = "none";
                                document.getElementById("show_not_stock_cart").style.display = "block";
                          }

                    }

                </script>
              @endif
          </div>
        </div>
    </form>
    <!-- Product Attribute show End -->
@endif



                                <div class="social-links-wrapper">
                                    <div class="social-links">
                                        <div class="social-icons social-no-color border-thin">
                                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                            <a href="#"
                                                class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                            <a href="#"
                                                class="social-icon social-youtube fab fa-linkedin-in"></a>
                                        </div>
                                    </div>
                                    <span class="divider d-xs-show"></span>
                                    <div class="product-link-wrapper d-flex">
                                        <a href="#"
                                            class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                                        <a href="#"
                                            class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#product-tab-description" class="nav-link active">Description</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="#product-tab-vendor" class="nav-link">Vendor Info</a>
                            </li>
                            <li class="nav-item">
                                <a href="#product-tab-reviews" class="nav-link">Customer Reviews (3)</a>
                            </li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="product-tab-description">
                                <div class="row mb-4">
                                    <div class="col-md-11 mb-5">
                                        <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                        <p class="">
                                            <?php echo $description=$product_tbl->description;?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="product-tab-vendor">
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-4">
                                        <figure class="vendor-banner br-sm">
                                            <img src="assets/images/products/vendor-banner.jpg"
                                                alt="Vendor Banner" width="610" height="295"
                                                style="background-color: #353B55;" />
                                        </figure>
                                    </div>
                                    <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                        <div class="vendor-user">
                                            <figure class="vendor-logo mr-4">
                                                <a href="#">
                                                    <img src="assets/images/products/vendor-logo.jpg"
                                                        alt="Vendor Logo" width="80" height="80" />
                                                </a>
                                            </figure>
                                            <div>
                                                <div class="vendor-name"><a href="#">Jone Doe</a></div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 90%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <a href="#" class="rating-reviews">(32 Reviews)</a>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="vendor-info list-style-none">
                                            <li class="store-name">
                                                <label>Store Name:</label>
                                                <span class="detail">OAIO Store</span>
                                            </li>
                                            <li class="store-address">
                                                <label>Address:</label>
                                                <span class="detail">Steven Street, El Carjon, CA 92020, United
                                                    States (US)</span>
                                            </li>
                                            <li class="store-phone">
                                                <label>Phone:</label>
                                                <a href="#tel:">1234567890</a>
                                            </li>
                                        </ul>
                                        <a href="vendor-dokan-store.html"
                                            class="btn btn-dark btn-link btn-underline btn-icon-right">Visit
                                            Store<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <p class="mb-5"><strong class="text-dark">L</strong>orem ipsum dolor sit amet,
                                    consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua.
                                    Venenatis tellus in metus vulputate eu scelerisque felis. Vel pretium
                                    lectus quam id leo in vitae turpis massa. Nunc id cursus metus aliquam.
                                    Libero id faucibus nisl tincidunt eget. Aliquam id diam maecenas ultricies
                                    mi eget mauris. Volutpat ac tincidunt vitae semper quis lectus. Vestibulum
                                    mattis ullamcorper velit sed. A arcu cursus vitae congue mauris.
                                </p>
                                <p class="mb-2"><strong class="text-dark">A</strong> arcu cursus vitae congue
                                    mauris. Sagittis id consectetur purus
                                    ut. Tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla.
                                    Diam in
                                    arcu cursus euismod quis. Eget sit amet tellus cras adipiscing enim eu. In
                                    fermentum et sollicitudin ac orci phasellus. A condimentum vitae sapien
                                    pellentesque
                                    habitant morbi tristique senectus et. In dictum non consectetur a erat. Nunc
                                    scelerisque viverra mauris in aliquam sem fringilla.</p>
                            </div>
                            <div class="tab-pane" id="product-tab-reviews">
                                <div class="row mb-4">
                                    <div class="col-xl-4 col-lg-5 mb-4">
                                        <div class="ratings-wrapper">
                                            <div class="avg-rating-container">
                                                <h4 class="avg-mark font-weight-bolder ls-50">3.3</h4>
                                                <div class="avg-rating">
                                                    <p class="text-dark mb-1">Average Rating</p>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 60%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <a href="#" class="rating-reviews">(3 Reviews)</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="ratings-value d-flex align-items-center text-dark ls-25">
                                                <span
                                                    class="text-dark font-weight-bold">66.7%</span>Recommended<span
                                                    class="count">(2 of 3)</span>
                                            </div>
                                            <div class="ratings-list">
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm ">
                                                        <span></span>
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark>70%</mark>
                                                    </div>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 80%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm ">
                                                        <span></span>
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark>30%</mark>
                                                    </div>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 60%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm ">
                                                        <span></span>
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark>40%</mark>
                                                    </div>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 40%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm ">
                                                        <span></span>
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark>0%</mark>
                                                    </div>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 20%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-sm ">
                                                        <span></span>
                                                    </div>
                                                    <div class="progress-value">
                                                        <mark>0%</mark>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-7 mb-4">
                                        <div class="review-form-wrapper">
                                            <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                Review</h3>
                                            <p class="mb-3">Your email address will not be published. Required
                                                fields are marked *</p>
                                            <form action="#" method="POST" class="review-form">
                                                <div class="rating-form">
                                                    <label for="rating">Your Rating Of This Product :</label>
                                                    <span class="rating-stars">
                                                        <a class="star-1" href="#">1</a>
                                                        <a class="star-2" href="#">2</a>
                                                        <a class="star-3" href="#">3</a>
                                                        <a class="star-4" href="#">4</a>
                                                        <a class="star-5" href="#">5</a>
                                                    </span>
                                                    <select name="rating" id="rating" required=""
                                                        style="display: none;">
                                                        <option value="">Rate…</option>
                                                        <option value="5">Perfect</option>
                                                        <option value="4">Good</option>
                                                        <option value="3">Average</option>
                                                        <option value="2">Not that bad</option>
                                                        <option value="1">Very poor</option>
                                                    </select>
                                                </div>
                                                <textarea cols="30" rows="6"
                                                    placeholder="Write Your Review Here..." class="form-control"
                                                    id="review"></textarea>
                                                <div class="row gutter-md">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="Your Name" id="author">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="Your Email" id="email_1">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="checkbox" class="custom-checkbox"
                                                        id="save-checkbox">
                                                    <label for="save-checkbox">Save my name, email, and website
                                                        in this browser for the next time I comment.</label>
                                                </div>
                                                <button type="submit" class="btn btn-dark">Submit
                                                    Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a href="#show-all" class="nav-link active">Show All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#helpful-positive" class="nav-link">Most Helpful
                                                Positive</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#helpful-negative" class="nav-link">Most Helpful
                                                Negative</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#highest-rating" class="nav-link">Highest Rating</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#lowest-rating" class="nav-link">Lowest Rating</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="show-all">
                                            <ul class="comments list-style-none">
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/1-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at
                                                                    1:54 pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings"
                                                                        style="width: 60%;"></span>
                                                                    <span
                                                                        class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>pellentesque habitant morbi tristique senectus
                                                                et. In dictum non consectetur a erat.
                                                                Nunc ultrices eros in cursus turpis massa
                                                                tincidunt ante in nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum
                                                                ut tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful
                                                                    (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-1.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-1-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/2-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at
                                                                    1:52 pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings"
                                                                        style="width: 80%;"></span>
                                                                    <span
                                                                        class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>Nullam a magna porttitor, dictum risus nec,
                                                                faucibus sapien.
                                                                Ultrices eros in cursus turpis massa tincidunt
                                                                ante in nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum
                                                                ut tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful
                                                                    (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-2.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-2.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-3.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-3.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/3-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at
                                                                    1:21 pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings"
                                                                        style="width: 60%;"></span>
                                                                    <span
                                                                        class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>In fermentum et sollicitudin ac orci phasellus. A
                                                                condimentum vitae
                                                                sapien pellentesque habitant morbi tristique
                                                                senectus et. In dictum
                                                                non consectetur a erat. Nunc scelerisque viverra
                                                                mauris in aliquam sem fringilla.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (0)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful
                                                                    (1)
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="helpful-positive">
                                            <ul class="comments list-style-none">
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/1-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at
                                                                    1:54 pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings"
                                                                        style="width: 60%;"></span>
                                                                    <span
                                                                        class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>pellentesque habitant morbi tristique senectus
                                                                et. In dictum non consectetur a erat.
                                                                Nunc ultrices eros in cursus turpis massa
                                                                tincidunt ante in nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum
                                                                ut tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful
                                                                    (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-1.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-1.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/2-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at
                                                                    1:52 pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings"
                                                                        style="width: 80%;"></span>
                                                                    <span
                                                                        class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>Nullam a magna porttitor, dictum risus nec,
                                                                faucibus sapien.
                                                                Ultrices eros in cursus turpis massa tincidunt
                                                                ante in nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum
                                                                ut tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful
                                                                    (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-2.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-2-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-3.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-3-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="helpful-negative">
                                            <ul class="comments list-style-none">
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/3-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at
                                                                    1:21 pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings"
                                                                        style="width: 60%;"></span>
                                                                    <span
                                                                        class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>In fermentum et sollicitudin ac orci phasellus. A
                                                                condimentum vitae
                                                                sapien pellentesque habitant morbi tristique
                                                                senectus et. In dictum
                                                                non consectetur a erat. Nunc scelerisque viverra
                                                                mauris in aliquam sem fringilla.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (0)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful
                                                                    (1)
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="highest-rating">
                                            <ul class="comments list-style-none">
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/2-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at
                                                                    1:52 pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings"
                                                                        style="width: 80%;"></span>
                                                                    <span
                                                                        class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>Nullam a magna porttitor, dictum risus nec,
                                                                faucibus sapien.
                                                                Ultrices eros in cursus turpis massa tincidunt
                                                                ante in nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum
                                                                ut tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful
                                                                    (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-2.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-2-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-3.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-3-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="lowest-rating">
                                            <ul class="comments list-style-none">
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/1-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at
                                                                    1:54 pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings"
                                                                        style="width: 60%;"></span>
                                                                    <span
                                                                        class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>pellentesque habitant morbi tristique senectus
                                                                et. In dictum non consectetur a erat.
                                                                Nunc ultrices eros in cursus turpis massa
                                                                tincidunt ante in nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum
                                                                ut tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful
                                                                    (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-3.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-3-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- End of Main Content -->
                <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                    <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                    <div class="sidebar-content scrollable">
                        <div class="sticky-sidebar">
                            <div class="widget widget-icon-box mb-6">
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-truck"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Free Shipping & Returns</h4>
                                        <p>For all orders over $99</p>
                                    </div>
                                </div>
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-bag"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Secure Payment</h4>
                                        <p>We ensure secure payment</p>
                                    </div>
                                </div>
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-money"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Money Back Guarantee</h4>
                                        <p>Any back within 30 days</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Widget Icon Box -->

                            <div class="widget widget-banner mb-9">
                                <div class="banner banner-fixed br-sm">
                                    <figure>
                                        <img src="assets/images/shop/banner3.jpg" alt="Banner" width="266"
                                            height="220" style="background-color: #1D2D44;" />
                                    </figure>
                                    <div class="banner-content">
                                        <div class="banner-price-info font-weight-bolder text-white lh-1 ls-25">
                                            40<sup class="font-weight-bold">%</sup><sub
                                                class="font-weight-bold text-uppercase ls-25">Off</sub>
                                        </div>
                                        <h4
                                            class="banner-subtitle text-white font-weight-bolder text-uppercase mb-0">
                                            Ultimate Sale</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Widget Banner -->

                            
                        </div>
                    </div>
                </aside>
                <!-- End of Sidebar -->
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</main>
<!-- End of Main -->




@section('script')


@endsection


@endsection
