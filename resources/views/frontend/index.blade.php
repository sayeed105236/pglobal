@extends('frontend.master.master')
@section('body')



@php
  $home_small_feature= App\admin\raw_tbl::where('type', "home")->where("section","home small feature")->get();
@endphp  

        <!-- Start of Main-->
        <main class="main">
            <section class="intro-section">
                <div class="owl-carousel owl-theme owl-nav-inner owl-dot-inner owl-nav-lg animation-slider gutter-no row cols-1"
                    data-owl-options="{
                    'nav': false,
                    'dots': true,
                    'items': 1,
                    'responsive': {
                        '1600': {
                            'nav': true,
                            'dots': false
                        }   
                    }
                }">


                @foreach($home_small_feature as $home_small_feature)
                    <div class="banner banner-fixed intro-slide intro-slide3"
                        style="background-image: url({{asset('resources/assets/images/slider.jpg')}}); background-color: #f0f1f2;">
                        <div class="container">
                            <figure class="slide-image skrollable " data-animation-options="{
                                'name': 'fadeInDownShorter',
                                'duration': '1s'
                            }"><!-- Was class slide-animate -->
                                <img src="{{URL('public/allfiles/img/customize')}}/{{$home_small_feature->image}}" alt="Banner"
                                    data-bottom-top="transform: translateY(10vh);"
                                    data-top-bottom="transform: translateY(-10vh);" width="444" height="310">
                            </figure>
                            <div class="banner-content text-right y-50">
                                <p>
                                    <?php echo $des="$home_small_feature->description";?>
                                </p>
                                <div class="btn-group " data-animation-options="{
                                    'name': 'fadeInLeftShorter',
                                    'duration': '1s',
                                    'delay': '.8s'
                                }"><!-- Was class slide-animate -->
                                    <a href="{{$home_small_feature->url}}"
                                        class="btn btn-dark btn-outline btn-rounded btn-icon-right">
                                        {{$home_small_feature->btn}}
                                        <i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <!-- End of .banner-content -->
                            </div>
                            <!-- End of .container -->
                        </div>
                    </div>
                    <!-- End of .intro-slide3 -->

                    @endforeach




                </div>
                <!-- End of .owl-carousel -->
            </section>
            <!-- End of .intro-section -->





            <div class="container">
                <div class="owl-carousel owl-theme row cols-md-4 cols-sm-3 cols-1icon-box-wrapper appear-animate br-sm mt-6 mb-6"
                    data-owl-options="{
                    'nav': false,
                    'dots': false,
                    'loop': false,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '576': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        },
                        '992': {
                            'items': 3
                        },
                        '1200': {
                            'items': 4
                        }
                    }
                }">
                    <div class="icon-box icon-box-side icon-box-primary">
                        <span class="icon-box-icon icon-shipping">
                            <i class="w-icon-truck"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Free Shipping & Returns</h4>
                            <p class="text-default">For all orders over $99</p>
                        </div>
                    </div>
                    <div class="icon-box icon-box-side icon-box-primary">
                        <span class="icon-box-icon icon-payment">
                            <i class="w-icon-bag"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
                            <p class="text-default">We ensure secure payment</p>
                        </div>
                    </div>
                    <div class="icon-box icon-box-side icon-box-primary icon-box-money">
                        <span class="icon-box-icon icon-money">
                            <i class="w-icon-money"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Money Back Guarantee</h4>
                            <p class="text-default">Any back within 30 days</p>
                        </div>
                    </div>
                    <div class="icon-box icon-box-side icon-box-primary icon-box-chat">
                        <span class="icon-box-icon icon-chat">
                            <i class="w-icon-chat"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
                            <p class="text-default">Call or email us 24/7</p>
                        </div>
                    </div>
                </div>
                <!-- End of Iocn Box Wrapper -->
            </div>
            
            











<section class="cs_section">
  <div class="container">
    <div class="row cs_row_pr">
      @php
        $customize_tbl= App\admin\raw_tbl::where('type', 'home')->where('section', 'home product section')->get();
      @endphp






      <!-- Single Banner  -->
      @foreach($customize_tbl as $customize_tbl)

        @if($customize_tbl->layout=="image1")
        <div class="col-md-12 col-12 cs_each_sec_prdt">
          <a href="{{$customize_tbl->url}}">
            <img src="{{URL('public/allfiles/img/customize')}}/{{$customize_tbl->image}}">
          </a>
        </div>
        @elseif($customize_tbl->layout=="image2")
        <div class="col-md-6 col-12 cs_each_sec_prdt">
          <a href="{{$customize_tbl->url}}">
            <img src="{{URL('public/allfiles/img/customize')}}/{{$customize_tbl->image}}">
          </a>
        </div>

    

        <!--Start of Layout1 -->
        @elseif($customize_tbl->layout=="layout1")
            <div class="container cs_each_sec_prdt">
                <h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">
                    {{$customize_tbl->description}}
                </h2>
                <div class="tab-content product-wrapper appear-animate">
                    <div class="tab-pane active pt-4" id="tab1-1">
                        <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                        @php
                            $customize_category=$customize_tbl->category;

                            $product_tbl= App\admin\product_tbl::orderBy('id', 'ASC')->where('status', '1')->where('approve', '1')->where('category', 'like', "%{$customize_category}%")->whereRaw("Not find_in_set('".'Dealer'."',category)")->take('10')->get();
                        @endphp
                            @foreach($product_tbl as $product_tbl)
                            <div class="product-wrap">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{URL('product')}}/{{$product_tbl->name}}/{{$product_tbl->id}}">
                                            <img src="{{asset('public/allfiles/img/product')}}/{{$product_tbl->main_image}}" alt="Product"
                                                width="300" height="338" />
                                            <img src="{{asset('public/allfiles/img/product')}}/{{$product_tbl->main_image}}" alt="Product"
                                                width="300" height="338" />
                                        </a>
                                        <div class="product-action-vertical">

                                                <a href="{{URL('product')}}/{{$product_tbl->name}}/{{$product_tbl->id}}" class="btn-quickview hvr_view2" title="Quick View">
                                                    <span class="w-icon-zoom"></span>
                                                    &nbsp 
                                                </a>
                                        </div>

                                        <?php $before_discount = $product_tbl->before_discount;?>
                                        @if($before_discount !== NULL)
                                        <div class="product-label-group">
                                            <label class="product-label label-discount">
                                                <?php
                                                    $price = $product_tbl->price;
                                                    $getting_dis= $before_discount - $price;
                                                    $per_dis = ($getting_dis / $before_discount) * 100;
                                                    echo number_format((float)$per_dis, 2, '.', '');
                                                ?>
                                                % Off
                                            </label>
                                        </div>
                                        @endif

                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name">
                                            <a href="{{URL('product')}}/{{$product_tbl->name}}/{{$product_tbl->id}}">
                                                {{$product_tbl->name}}
                                            </a>
                                        </h4>
                                        <div class="ratings-container">
                                            <!-- <div class="ratings-full">
                                                <span class="ratings" style="width: 60%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div> 
                                            <a href="{{URL('product')}}/{{$product_tbl->name}}/{{$product_tbl->id}}" class="rating-reviews">(1 Reviews)</a> -->
                                        </div>
                                        <div class="product-price">
                                            <ins class="new-price">
                                                {{$product_tbl->price}}
                                            </ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!--End of Layout1 -->









        
        <!--Start of Layout2 -->
        @elseif($customize_tbl->layout=="layout2")

                <div class="product-wrapper-1 mb-5 cs_each_sec_prdt">
                    <div class="title-link-wrapper pb-1 mb-4">
                        <h2 class="title ls-normal mb-0">
                            {{$customize_tbl->description}}
                        </h2>
                        <a href="shop-boxed-banner.html" class="font-size-normal font-weight-bold ls-25 mb-0">
                            <!-- More Products --><i class="w-icon-long-arrow-right"></i>
                        </a>
                    </div>
                    @php
                        $customize_category=$customize_tbl->category;

                        $product_tbl= App\admin\product_tbl::orderBy('id', 'ASC')->where('status', '1')->where('approve', '1')->where('category', 'like', "%{$customize_category}%")->whereRaw("Not find_in_set('".'Dealer'."',category)")->take('10')->get();
                    @endphp
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 mb-4">
                            <a href="{{$customize_tbl->url}}">
                                <img src="{{URL('public/allfiles/img/customize')}}/{{$customize_tbl->image}}" class="banner h-100 br-sm">
                            </a>
                        </div>
                        <!-- End of Banner -->
                        <div class="col-lg-9 col-sm-8">






                <div class="tab-content product-wrapper layout2_w">
                    <div class="tab-pane active pt-4 layout2_w2" id="tab1-1">
                        <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2 layout2_w3">
                        @php
                            $customize_category=$customize_tbl->category;

                            $product_tbl= App\admin\product_tbl::orderBy('id', 'ASC')->where('status', '1')->where('approve', '1')->where('category', 'like', "%{$customize_category}%")->whereRaw("Not find_in_set('".'Dealer'."',category)")->take('8')->get();
                        @endphp

                            @foreach($product_tbl as $product_tbl)
                            <div class="product-wrap layout2_prdt_w col-md-3 col-sm-6">
                                <div class="product text-center layout2_prdt">
                                    <figure class="product-media layout2_media">
                                        <a href="{{URL('product')}}/{{$product_tbl->name}}/{{$product_tbl->id}}">
                                            <img src="{{asset('public/allfiles/img/product')}}/{{$product_tbl->main_image}}" alt="Product"
                                                width="300" height="338" />
                                            <img src="{{asset('public/allfiles/img/product')}}/{{$product_tbl->main_image}}" alt="Product"
                                                width="300" height="338" />
                                        </a>
                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                title="Add to cart"></a>
                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                title="Add to wishlist"></a>
                                            <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                title="Quickview"></a>
                                            <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                                title="Add to Compare"></a>
                                        </div>

                                        <?php $before_discount = $product_tbl->before_discount;?>
                                        @if($before_discount !== NULL)
                                        <div class="product-label-group">
                                            <label class="product-label label-discount">
                                                <?php
                                                    $price = $product_tbl->price;
                                                    $getting_dis= $before_discount - $price;
                                                    $per_dis = ($getting_dis / $before_discount) * 100;
                                                    echo number_format((float)$per_dis, 2, '.', '');
                                                ?>
                                                % Off
                                            </label>
                                        </div>
                                        @endif
                                        
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name">
                                            <a href="{{URL('product')}}/{{$product_tbl->name}}/{{$product_tbl->id}}">
                                                {{$product_tbl->name}}
                                            </a>
                                        </h4>
                                        <div class="ratings-container">
                                            <!-- <div class="ratings-full">
                                                <span class="ratings" style="width: 60%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="{{URL('product')}}/{{$product_tbl->name}}/{{$product_tbl->id}}" class="rating-reviews">(1 Reviews)</a> -->
                                        </div>
                                        <div class="product-price">
                                            <ins class="new-price">
                                                {{$product_tbl->price}}
                                            </ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>





                        </div>
                    </div>
                </div>
                <!-- End of Product Wrapper 1 -->
        @endif

      @endforeach
      <!-- /End Single Banner  -->








    </div>
  </div>
</section>





















        </main>
        <!-- End of Main -->


@endsection