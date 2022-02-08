@extends('frontend.master.master')
@section('body')


    <link href="{{asset('resources/views/backend/master/css.css')}}" rel="stylesheet">



<!-- Logo Customize -->
    <div class="container"> 
        <button type="button" class="customize_span customize_sldr_posi logo_top" data-toggle="modal" data-target=".footer_logo">
            <i class="fas fa-pen customize_icn"></i>
        </button>
    </div>

    <div class="modal fade footer_logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Home feature -->
            <div class="mdl_bdy_w">
                <div class="card widget-box warning_w mdl_bdy_widget_box">
                    <div class="modal-header warning mdl_bdy_header">
                        <h4 class="modal-title">Logo</h4>
                        <button type="button" class="close btn_cls_mdl" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <form autocomplete="off" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                            @php
                              $footer_logo= DB::table('raw_tbl')->where('type', 'logo')->where('section', 'footer')->first();
                            @endphp
                                {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$footer_logo->id}}">
                            <input type="hidden" name="type" value="logo">
                            <input type="hidden" name="section" value="footer">

                        <input type="hidden" name="image_w" value="165">
                        <input type="hidden" name="image_h" value="70">

                                <div class="control-group col-md-12 col-12">
                                    <div class="controls col-md-9 col-12">
                                      <input type="file" class="" name="image" id="w4-image" onchange="f_logo(this);">
                                    </div>
                                    <br><br>
                                    <div class="controls col-md-9 col-12">
                                         <div class="show_img_in_input_w">
                                           <img id="footer_logo" class="show_img_in_input" src="{{URL('public/allfiles/img/customize')}}/{{$footer_logo->image}}" width="165px" height="70px">
                                      </div>
                                        <script type="text/javascript">
                                        function f_logo(input) {
                                        if (input.files && input.files[0]) {
                                          var reader = new FileReader();
                                          reader.onload = function (e) {
                                              $('#footer_logo').attr('src', e.target.result);};
                                          reader.readAsDataURL(input.files[0]);}}
                                        </script>
                                     </div>
                                </div>

                                <div class="control-group col-md-12 col-12 text-center">
                                    <input type="submit" name="submit" class="btn btn-success">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Home feature -->
        </div>
      </div>
    </div>
<!-- /Logo Customize -->






@php
  $home_small_feature= App\admin\raw_tbl::where('type', "home")->where('section',"home small feature")->get();
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
                        style="background-image: url({{asset('resources/assets/images/slide-1.jpg')}}); background-color: #f0f1f2;">
                        <div class="container">
                            <figure class="slide-image skrollable slide-animate" data-animation-options="{
                                'name': 'fadeInDownShorter',
                                'duration': '1s'
                            }">
                                <img src="{{URL('public/allfiles/img/customize')}}/{{$home_small_feature->image}}" alt="Banner"
                                    data-bottom-top="transform: translateY(10vh);"
                                    data-top-bottom="transform: translateY(-10vh);" width="310" height="444">
                            </figure>
                            <div class="banner-content text-right y-50">
                                <p>
                                    <?php echo $des="$home_small_feature->description";?>
                                </p>
                                <div class="btn-group slide-animate" data-animation-options="{
                                    'name': 'fadeInLeftShorter',
                                    'duration': '1s',
                                    'delay': '.8s'
                                }">
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






        <!-- Modal -->
        <div class="modal fade" id="delete_modal{{$customize_tbl->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Do you want to delete this section?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{URL('makecommand/delete_customized_section?id')}}={{$customize_tbl->id}}" class="btn btn-warning">Delete</a>
              </div>
            </div>
          </div>
        </div>





        @if($customize_tbl->layout=="image1")
        <div class="col-md-12 col-12 cs_each_sec_prdt">

            
            <!-- modal button Start -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_modal{{$customize_tbl->id}}">
              Delete
            </button>

            <div class="edt_btn_for">
                <button type="button" class="btn btn_edit_section" data-toggle="modal" data-target=".edit_modal{{$customize_tbl->id}}">
                    <i class="fas fa-pen customize_icn"></i>
                </button>
            </div>
            <!-- modal button End -->

            
          <a href="{{$customize_tbl->url}}">
            <img src="{{URL('public/allfiles/img/customize')}}/{{$customize_tbl->image}}">
          </a>
        </div>
        @elseif($customize_tbl->layout=="image2")
        <div class="col-md-6 col-12 cs_each_sec_prdt">

            
            <!-- Edit button Start -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_modal{{$customize_tbl->id}}">
              Delete
            </button>

            <div class="edt_btn_for">
                <button type="button" class="btn btn_edit_section" data-toggle="modal" data-target=".edit_modal{{$customize_tbl->id}}">
                    <i class="fas fa-pen customize_icn"></i>
                </button>
            </div>
            <!-- Edit button End -->

            
          <a href="{{$customize_tbl->url}}">
            <img src="{{URL('public/allfiles/img/customize')}}/{{$customize_tbl->image}}">
          </a>
        </div>

    

        <!--Start of Layout1 -->
        @elseif($customize_tbl->layout=="layout1")
            <div class="container cs_each_sec_prdt">
                <h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">
                    {{$customize_tbl->description}} &nbsp&nbsp&nbsp

            
            <!-- Edit button Start -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_modal{{$customize_tbl->id}}">
              Delete
            </button>

            <div class="edt_btn_for">
                <button type="button" class="btn btn_edit_section" data-toggle="modal" data-target=".edit_modal{{$customize_tbl->id}}">
                    <i class="fas fa-pen customize_icn"></i>
                </button>
            </div>
            <!-- Edit button End -->

            
                </h2>
                <div class="tab-content product-wrapper appear-animate">
                    <div class="tab-pane active pt-4" id="tab1-1">
                        <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                        @php
                            $customize_category=$customize_tbl->category;

                            $product_tbl= App\admin\product_tbl::orderBy('id', 'ASC')->where('status', '1')->where('approve', '1')->where('category', 'like', "%{$customize_category}%")->take('10')->get();
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
                                            <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                title="Add to cart"></a>
                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                title="Add to wishlist"></a>
                                            <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                title="Quickview"></a>
                                            <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                                title="Add to Compare"></a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name">
                                            <a href="product-default.html">
                                                {{$product_tbl->name}}
                                            </a>
                                        </h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 60%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="product-default.html" class="rating-reviews">(1 Reviews)</a>
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

                <div class="product-wrapper-1 appear-animate mb-5 cs_each_sec_prdt">
                    <div class="title-link-wrapper pb-1 mb-4">
                        <h2 class="title ls-normal mb-0">
                            {{$customize_tbl->description}} &nbsp&nbsp&nbsp

            
            <!-- Edit button Start -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_modal{{$customize_tbl->id}}">
              Delete
            </button>

            <div class="edt_btn_for">
                <button type="button" class="btn btn_edit_section" data-toggle="modal" data-target=".edit_modal{{$customize_tbl->id}}">
                    <i class="fas fa-pen customize_icn"></i>
                </button>
            </div>
            <!-- Edit button End -->

            
                        </h2>
                        <a href="shop-boxed-banner.html" class="font-size-normal font-weight-bold ls-25 mb-0">
                            <!-- More Products --><i class="w-icon-long-arrow-right"></i>
                        </a>
                    </div>
                    @php
                        $customize_category=$customize_tbl->category;

                        $product_tbl= App\admin\product_tbl::orderBy('id', 'ASC')->where('status', '1')->where('approve', '1')->where('category', 'like', "%{$customize_category}%")->take('10')->get();
                    @endphp
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 mb-4">
                            <a href="{{$customize_tbl->url}}">
                                <img src="{{URL('public/allfiles/img/customize')}}/{{$customize_tbl->image}}" class="banner h-100 br-sm">
                            </a>
                        </div>
                        <!-- End of Banner -->
                        <div class="col-lg-9 col-sm-8">






                <div class="tab-content product-wrapper appear-animate layout2_w">
                    <div class="tab-pane active pt-4 layout2_w2" id="tab1-1">
                        <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2 layout2_w3">
                        @php
                            $customize_category=$customize_tbl->category;

                            $product_tbl= App\admin\product_tbl::orderBy('id', 'ASC')->where('status', '1')->where('approve', '1')->where('category', 'like', "%{$customize_category}%")->take('8')->get();
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
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name">
                                            <a href="product-default.html">
                                                {{$product_tbl->name}}
                                            </a>
                                        </h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 60%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="product-default.html" class="rating-reviews">(1 Reviews)</a>
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







                    <!-- Edit Start  -->
                    <div class="edt_modal_one">
                    <div class="modal fade edit_modal{{$customize_tbl->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" style="margin-top: 100px;">
                        <div class="modal-content">
                            <!-- Home feature -->
                            <div class="mdl_bdy_w">
                                <div class="card widget-box warning_w">
                                    <div class="card-header warning">
                                        <h5 class="card-title">Edit new Section</h5>
                                        <button type="button" class="close btn_cls_mdl" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="">
                                            <form autocomplete="off" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data' class="row">

                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{$customize_tbl->id}}">
                                            <input type="hidden" name="type" value="home">
                                            <input type="hidden" name="section" value="home product section">


                                                <div class="control-group lc_w row col-md-12 col-12">
                                                    <label class="control-label lc_l col-md-2 col-12">
                                                       Layout &nbsp
                                                    </label>

                                                    <div class="col-md-8 col-12 lc_s">
                                                        <select class="form-control ch_in" name="layout" required data-live-search="true">
                                                            <option value="{{$customize_tbl->layout}}">
                                                                {{$customize_tbl->layout}}
                                                            </option>
                                                            <option value="layout1">Product Layout 1</option>
                                                            <option value="layout2">Product Layout 2</option>
                                                            <option value="image1">Images 100%</option>
                                                            <option value="image2">Image 50%</option>
                                                        </select>
                                                    </div>
                                                </div>





                                                <div id="accordion">

                                                  <div class="card">
                                                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$customize_tbl->id}}" aria-expanded="false" aria-controls="collapse{{$customize_tbl->id}}">
                                                        <div class="card-header" id="headingTwo">
                                                          <h5 class="mb-0">
                                                            Product <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                          </h5>
                                                        </div>
                                                    </button>
                                                    <div id="collapse{{$customize_tbl->id}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                      <div class="card-body">

                                                        <div class="control-group col-md-12 col-12">
                                                            <label class="control-label col-md-2 col-12">
                                                                Title
                                                            </label>
                                                            <div class="controls col-md-12 col-12">
                                                              <input type="text" name="description" class="form-control ch_in" value="{{$customize_tbl->description}}">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="control-group lc_w row">
                                                            <label class="control-label lc_l col-md-2 col-12">
                                                               Category
                                                            </label>
                                                            <div class="col-md-10 col-12 lc_s">
                                                                <select class="form-control" name="category" data-live-search="true">
                                                                    @php
                                                                        $category_tbl= App\admin\category_tbl::orderBy('name', 'asc')->get();
                                                                    @endphp
                                                                    <option  value="{{$customize_tbl->category}}">
                                                                        {{$customize_tbl->category}}
                                                                    </option>
                                                                    @foreach($category_tbl as $category_tbl)
                                                                        <option value="{{$category_tbl->name}}">
                                                                            {{$category_tbl->name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>



                                                  <div class="card">
                                                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSecond{{$customize_tbl->id}}" aria-expanded="false" aria-controls="collapseSecond{{$customize_tbl->id}}">
                                                        <div class="card-header" id="headingTwo">
                                                          <h5 class="mb-0">
                                                            Images <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                          </h5>
                                                        </div>
                                                    </button>
                                                    <div id="collapseSecond{{$customize_tbl->id}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                      <div class="card-body row">



                                                        <div class="control-group col-md-6 col-12">
                                                            <label class="control-label col-md-2 col-12">
                                                                Width
                                                            </label>
                                                            <div class="controls col-md-12 col-12">
                                                                <input type="number" class="form-control" name="image_w" value="">
                                                            </div>
                                                        </div>

                                                        <div class="control-group col-md-6 col-12">
                                                            <label class="control-label col-md-2 col-12">
                                                                Height
                                                            </label>
                                                            <div class="controls col-md-12 col-12">
                                                                <input type="number" class="form-control" name="image_h" value="">
                                                            </div>
                                                        </div>

                                                        <div class="meas_image">
                                                            <p>
                                                                For  <b>Product Layout 2</b> best image size is <b>295px*670px</b>
                                                            </p>
                                                            <p>
                                                                For  <b>100% or 1 image</b> best size is <b>1240px*160px</b>
                                                            </p>
                                                            <p>
                                                                For  <b>50% or 2 image</b> best size is <b>610px*200px</b>
                                                            </p>
                                                        </div>


                                                        <div class="control-group col-md-12 col-12">
                                                            <label class="control-label col-md-2 col-12">
                                                                URL
                                                            </label>
                                                            <div class="controls col-md-12 col-12">
                                                                <input type="url" class="form-control" name="url" value="{{$customize_tbl->url}}">
                                                            </div>
                                                        </div>


                                                        <div class="control-group col-md-12 col-12"><br><br><br>
                                                            <label class="control-label col-md-2 col-12">
                                                                Image
                                                            </label>
                                                            <div class="controls col-md-9 col-12">
                                                              <input type="file" class="" name="image" id="w4-image" onchange="image_layout_function(this);">
                                                            </div>
                                                            <br><br>
                                                            <div class="controls col-md-9 col-12">
                                                                 <div class="show_img_in_input_w">
                                                                   <img id="image_layout" class="show_img_in_input" src="{{URL('public/allfiles/img/customize')}}/{{$customize_tbl->image}}" style="height:200px !Important;">
                                                              </div>
                                                                <script type="text/javascript">
                                                                function image_layout_function(input) {
                                                                if (input.files && input.files[0]) {
                                                                  var reader = new FileReader();
                                                                  reader.onload = function (e) {
                                                                      $('#image_layout').attr('src', e.target.result);};
                                                                  reader.readAsDataURL(input.files[0]);}}
                                                                </script>
                                                             </div>
                                                        </div>


                                                      </div>
                                                    </div>
                                                  </div>

                                                </div>
                                                <div class="control-group col-md-12 col-12 text-center">
                                                    <input type="submit" name="submit" class="btn btn-success">
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                      </div>
                    </div>
                    </div>
                    <!-- Edit End -->




      @endforeach
      <!-- /End Single Banner  -->








    </div>
  </div>
</section>






























<!-- add section  -->
<br><br><br>
<div class="text-center btn_add_section_w">
    <button type="button" class="btn btn_add_section" data-toggle="modal" data-target=".add_section">
        Add Section
    </button>
</div>

<div class="modal fade add_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 100px;">
    <div class="modal-content">
      
        <!-- Home feature -->
        <div class="mdl_bdy_w">
            <div class="card widget-box warning_w">
                <div class="card-header warning">
                    <h5 class="card-title">Add A new Section</h5>
                    <button type="button" class="close btn_cls_mdl" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="">
                        <form autocomplete="off" action="{{URL('makecommand/insert_customize')}}" method="post" enctype='multipart/form-data' class="row">

                            {{csrf_field()}}
                        <input type="hidden" name="type" value="home">
                        <input type="hidden" name="section" value="home product section">


                            <div class="control-group lc_w row col-md-12 col-12">
                                <label class="control-label lc_l col-md-2 col-12">
                                   Layout &nbsp
                                </label>

                                <div class="col-md-8 col-12 lc_s">
                                    <select class="form-control ch_in" name="layout" required data-live-search="true">
                                        <option value="" selected>---select layout---</option>
                                        <option value="layout1">Product Layout 1</option>
                                        <option value="layout2">Product Layout 2</option>
                                        <option value="image1">Images 100%</option>
                                        <option value="image2">Image 50%</option>
                                    </select>
                                </div>
                            </div>





                            <div id="accordion">

                              <div class="card">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="card-header" id="headingTwo">
                                      <h5 class="mb-0">
                                        Product <i class="fas fa-angle-down" aria-hidden="true"></i>
                                      </h5>
                                    </div>
                                </button>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                  <div class="card-body">

                                    <div class="control-group col-md-12 col-12">
                                        <label class="control-label col-md-2 col-12">
                                            Title
                                        </label>
                                        <div class="controls col-md-12 col-12">
                                          <input type="text" name="description" class="form-control ch_in">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="control-group lc_w row">
                                        <label class="control-label lc_l col-md-2 col-12">
                                           Category
                                        </label>
                                        <div class="col-md-10 col-12 lc_s">
                                            <select class="form-control" name="category" data-live-search="true">
                                                @php
                                                    $category_tbl= App\admin\category_tbl::orderBy('name', 'asc')->get();
                                                @endphp
                                                <option  value="" selected>---select layout---</option>
                                                @foreach($category_tbl as $category_tbl)
                                                    <option value="{{$category_tbl->name}}">
                                                        {{$category_tbl->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                  </div>
                                </div>
                              </div>



                              <div class="card">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    <div class="card-header" id="headingTwo">
                                      <h5 class="mb-0">
                                        Images <i class="fas fa-angle-down" aria-hidden="true"></i>
                                      </h5>
                                    </div>
                                </button>
                                <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                  <div class="card-body row">



                                    <div class="control-group col-md-6 col-12">
                                        <label class="control-label col-md-2 col-12">
                                            Width
                                        </label>
                                        <div class="controls col-md-12 col-12">
                                            <input type="number" class="form-control" name="image_w" value="610">
                                        </div>
                                    </div>

                                    <div class="control-group col-md-6 col-12">
                                        <label class="control-label col-md-2 col-12">
                                            Height
                                        </label>
                                        <div class="controls col-md-12 col-12">
                                            <input type="number" class="form-control" name="image_h" value="200">
                                        </div>
                                    </div>

                                    <div class="meas_image">
                                        <p>
                                            For  <b>Product Layout 2</b> best image size is <b>295px*670px</b>
                                        </p>
                                        <p>
                                            For  <b>100% or 1 image</b> best size is <b>1240px*160px</b>
                                        </p>
                                        <p>
                                            For  <b>50% or 2 image</b> best size is <b>610px*200px</b>
                                        </p>
                                    </div>


                                    <div class="control-group col-md-12 col-12">
                                        <label class="control-label col-md-2 col-12">
                                            URL
                                        </label>
                                        <div class="controls col-md-12 col-12">
                                            <input type="url" class="form-control" name="url">
                                        </div>
                                    </div>


                                    <div class="control-group col-md-12 col-12"><br><br><br>
                                        <label class="control-label col-md-2 col-12">
                                            Image
                                        </label>
                                        <div class="controls col-md-9 col-12">
                                          <input type="file" class="" name="image" id="w4-image" onchange="image_layout_function(this);">
                                        </div>
                                        <br><br>
                                        <div class="controls col-md-9 col-12">
                                             <div class="show_img_in_input_w">
                                               <img id="image_layout" class="show_img_in_input" src="" style="height:200px !Important;">
                                          </div>
                                            <script type="text/javascript">
                                            function image_layout_function(input) {
                                            if (input.files && input.files[0]) {
                                              var reader = new FileReader();
                                              reader.onload = function (e) {
                                                  $('#image_layout').attr('src', e.target.result);};
                                              reader.readAsDataURL(input.files[0]);}}
                                            </script>
                                         </div>
                                    </div>


                                  </div>
                                </div>
                              </div>



                            </div>





                            

                            <div class="control-group col-md-12 col-12 text-center">
                                <input type="submit" name="submit" class="btn btn-success">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Home feature -->

    </div>
  </div>
</div>
<br><br><br>
<!-- /add section Customize -->


    



            
        </main>
        <!-- End of Main -->




<div class="container">
    <div class="row">
        
        <button class="social_edit_btn" type="button" data-toggle="modal" data-target=".footer_social_link" style="margin-bottom: 20px;">
          Edit your social links
          <br>
          <img src="{{asset('public/allfiles/img/customize/social_icn.png')}}">
        </button>
        <!-- Modal -->
        @php
          $footer_logo=App\admin\raw_tbl::where('type', 'logo')->where('section', 'footer')->first();
        @endphp
        
        <div class="edt_modal_one">
        <div class="modal fade  footer_social_link" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog modal-lg" style="margin-top: 100px;" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Footer Social Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <!-- Facebook -->
                  @php
                    $footer_social_dtl=App\admin\raw_tbl::where('type', 'footer_social')->where('section', 'facebook')->first();
                  @endphp
                  <form class="control-group col-md-12 col-12 row" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                  {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$footer_social_dtl->id}}">
                    <label class="control-label col-md-3 col-12 text-right">
                        Social Link 1:
                    </label>
                    <div class="controls col-md-9 col-12 row">
                      <div class="col-md-12">
                        <input type="text" name="url" class="ch_in" value="{{$footer_social_dtl->url}}">
                      </div>
                      <div class="col-md-12">
                        <input type="hidden" name="image_w" value="45">
                        <input type="hidden" name="image_h" value="45">
                        <input type="file" class="form-control" name="image" id="w4-image" onchange="footer_social_fn_{{$footer_social_dtl->id}}(this);">
                        <div class="show_img_in_input_w">
                          <img id="footer_social_{{$footer_social_dtl->id}}" class="show_img_in_input" src="{{asset('public/allfiles/img/customize')}}/{{$footer_social_dtl->image}}" style="width:45px;height:45px;margin:5px 0px;">
                          <small>(recommended 45px * 45px)</small>
                        </div>
                        <script type="text/javascript">
                        function footer_social_fn_{{$footer_social_dtl->id}}(input) {
                        if (input.files && input.files[0]) {
                          var reader = new FileReader();
                          reader.onload = function (e) {
                              $('#footer_social_{{$footer_social_dtl->id}}').attr('src', e.target.result);};
                          reader.readAsDataURL(input.files[0]);}}
                        </script>
                      </div>
                    </div>
                    <div class="col-12 text-center" style="margin:8px 0px;">
                      <input type="submit" value="save" class="btn btn-primary">
                    </div>
                  </form>
                  <!-- /Facebook -->
                  <hr>
                  <!-- Youtube -->
                  @php
                    $footer_social_dtl=App\admin\raw_tbl::where('type', 'footer_social')->where('section', 'youtube')->first();
                  @endphp
                  <form class="control-group col-md-12 col-12 row" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                  {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$footer_social_dtl->id}}">
                    <label class="control-label col-md-3 col-12 text-right">
                        Social Link 2:
                    </label>
                    <div class="controls col-md-9 col-12 row">
                      <div class="col-md-12">
                        <input type="text" name="url" class="ch_in" value="{{$footer_social_dtl->url}}">
                      </div>
                      <div class="col-md-12">
                        <input type="hidden" name="image_w" value="45">
                        <input type="hidden" name="image_h" value="45">
                        <input type="file" class="form-control" name="image" id="w4-image" onchange="footer_social_fn_{{$footer_social_dtl->id}}(this);">
                        <div class="show_img_in_input_w">
                          <img id="footer_social_{{$footer_social_dtl->id}}" class="show_img_in_input" src="{{asset('public/allfiles/img/customize')}}/{{$footer_social_dtl->image}}" style="width:45px;height:45px;margin:5px 0px;">
                          <small>(recommended 45px * 45px)</small>
                        </div>
                        <script type="text/javascript">
                        function footer_social_fn_{{$footer_social_dtl->id}}(input) {
                        if (input.files && input.files[0]) {
                          var reader = new FileReader();
                          reader.onload = function (e) {
                              $('#footer_social_{{$footer_social_dtl->id}}').attr('src', e.target.result);};
                          reader.readAsDataURL(input.files[0]);}}
                        </script>
                      </div>
                    </div>
                    <div class="col-12 text-center" style="margin:0px 0px 10px 0px;">
                      <input type="submit" value="save" class="btn btn-primary">
                    </div>
                  </form>
                  <!-- /Youtube -->
                  <hr>
                  <!-- Google -->
                  @php
                    $footer_social_dtl=App\admin\raw_tbl::where('type', 'footer_social')->where('section', 'google')->first();
                  @endphp
                  <form class="control-group col-md-12 col-12 row" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                  {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$footer_social_dtl->id}}">
                    <label class="control-label col-md-3 col-12 text-right">
                        Social Link 3:
                    </label>
                    <div class="controls col-md-9 col-12 row">
                      <div class="col-md-12">
                        <input type="text" name="url" class="ch_in" value="{{$footer_social_dtl->url}}">
                      </div>
                      <div class="col-md-12">
                        <input type="hidden" name="image_w" value="45">
                        <input type="hidden" name="image_h" value="45">
                        <input type="file" class="form-control" name="image" id="w4-image" onchange="footer_social_fn_{{$footer_social_dtl->id}}(this);">
                        <div class="show_img_in_input_w">
                          <img id="footer_social_{{$footer_social_dtl->id}}" class="show_img_in_input" src="{{asset('public/allfiles/img/customize')}}/{{$footer_social_dtl->image}}" style="width:45px;height:45px;margin:5px 0px;">
                          <small>(recommended 45px * 45px)</small>
                        </div>
                        <script type="text/javascript">
                        function footer_social_fn_{{$footer_social_dtl->id}}(input) {
                        if (input.files && input.files[0]) {
                          var reader = new FileReader();
                          reader.onload = function (e) {
                              $('#footer_social_{{$footer_social_dtl->id}}').attr('src', e.target.result);};
                          reader.readAsDataURL(input.files[0]);}}
                        </script>
                      </div>
                    </div>
                    <div class="col-12 text-center" style="margin:0px 0px 10px 0px;">
                      <input type="submit" value="save" class="btn btn-primary">
                    </div>
                  </form>
                  <!-- /Google -->
                  <hr>
                  <!-- Twitter -->
                  @php
                    $footer_social_dtl=App\admin\raw_tbl::where('type', 'footer_social')->where('section', 'twitter')->first();
                  @endphp
                  <form class="control-group col-md-12 col-12 row" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                  {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$footer_social_dtl->id}}">
                    <label class="control-label col-md-3 col-12 text-right">
                        Social Link 4:
                    </label>
                    <div class="controls col-md-9 col-12 row">
                      <div class="col-md-12">
                        <input type="text" name="url" class="ch_in" value="{{$footer_social_dtl->url}}">
                      </div>
                      <div class="col-md-12">
                        <input type="hidden" name="image_w" value="45">
                        <input type="hidden" name="image_h" value="45">
                        <input type="file" class="form-control" name="image" id="w4-image" onchange="footer_social_fn_{{$footer_social_dtl->id}}(this);">
                        <div class="show_img_in_input_w">
                          <img id="footer_social_{{$footer_social_dtl->id}}" class="show_img_in_input" src="{{asset('public/allfiles/img/customize')}}/{{$footer_social_dtl->image}}" style="width:45px;height:45px;margin:5px 0px;">
                          <small>(recommended 45px * 45px)</small>
                        </div>
                        <script type="text/javascript">
                        function footer_social_fn_{{$footer_social_dtl->id}}(input) {
                        if (input.files && input.files[0]) {
                          var reader = new FileReader();
                          reader.onload = function (e) {
                              $('#footer_social_{{$footer_social_dtl->id}}').attr('src', e.target.result);};
                          reader.readAsDataURL(input.files[0]);}}
                        </script>
                      </div>
                    </div>
                    <div class="col-12 text-center" style="margin:0px 0px 10px 0px;">
                      <input type="submit" value="save" class="btn btn-primary">
                    </div>
                  </form>
                  <!-- /Twitter -->
                  <hr>
                  <!-- Linkedin -->
                  @php
                    $footer_social_dtl=App\admin\raw_tbl::where('type', 'footer_social')->where('section', 'linkedin')->first();
                  @endphp
                  <form class="control-group col-md-12 col-12 row" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                  {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$footer_social_dtl->id}}">
                    <label class="control-label col-md-3 col-12 text-right">
                        Social Link 5:
                    </label>
                    <div class="controls col-md-9 col-12 row">
                      <div class="col-md-12">
                        <input type="text" name="url" class="ch_in" value="{{$footer_social_dtl->url}}">
                      </div>
                      <div class="col-md-12">
                        <input type="hidden" name="image_w" value="45">
                        <input type="hidden" name="image_h" value="45">
                                <input type="file" class="form-control" name="image" id="w4-image" onchange="footer_social_fn_{{$footer_social_dtl->id}}(this);">
                                <div class="show_img_in_input_w">
                                  <img id="footer_social_{{$footer_social_dtl->id}}" class="show_img_in_input" src="{{asset('public/allfiles/img/customize')}}/{{$footer_social_dtl->image}}" style="width:45px;height:45px;margin:5px 0px;">
                                  <small>(recommended 45px * 45px)</small>
                                </div>
                                <script type="text/javascript">
                                function footer_social_fn_{{$footer_social_dtl->id}}(input) {
                                if (input.files && input.files[0]) {
                                  var reader = new FileReader();
                                  reader.onload = function (e) {
                                      $('#footer_social_{{$footer_social_dtl->id}}').attr('src', e.target.result);};
                                  reader.readAsDataURL(input.files[0]);}}
                                </script>
                              </div>
                            </div>
                            <div class="col-12 text-center" style="margin:0px 0px 10px 0px;">
                              <input type="submit" value="save" class="btn btn-primary">
                            </div>
                          </form>
                          <!-- /Linkedin -->
                          <hr>
                          <!-- Github -->
                          @php
                            $footer_social_dtl=App\admin\raw_tbl::where('type', 'footer_social')->where('section', 'github')->first();
                          @endphp
                          <form class="control-group col-md-12 col-12 row" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                          {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$footer_social_dtl->id}}">
                            <label class="control-label col-md-3 col-12 text-right">
                                Social Link 6:
                            </label>
                            <div class="controls col-md-9 col-12 row">
                              <div class="col-md-12">
                                <input type="text" name="url" class="ch_in" value="{{$footer_social_dtl->url}}">
                              </div>
                              <div class="col-md-12">
                                <input type="hidden" name="image_w" value="45">
                                <input type="hidden" name="image_h" value="45">
                                <input type="file" class="form-control" name="image" id="w4-image" onchange="footer_social_fn_{{$footer_social_dtl->id}}(this);">
                                <div class="show_img_in_input_w">
                                  <img id="footer_social_{{$footer_social_dtl->id}}" class="show_img_in_input" src="{{asset('public/allfiles/img/customize')}}/{{$footer_social_dtl->image}}" style="width:45px;height:45px;margin:5px 0px;">
                                  <small>(recommended 45px * 45px)</small>
                                </div>
                                <script type="text/javascript">
                                function footer_social_fn_{{$footer_social_dtl->id}}(input) {
                                if (input.files && input.files[0]) {
                                  var reader = new FileReader();
                                  reader.onload = function (e) {
                                      $('#footer_social_{{$footer_social_dtl->id}}').attr('src', e.target.result);};
                                  reader.readAsDataURL(input.files[0]);}}
                                </script>
                              </div>
                            </div>
                            <div class="col-12 text-center" style="margin:0px 0px 10px 0px;">
                              <input type="submit" value="save" class="btn btn-primary">
                            </div>
                          </form>
                          <!-- /Github -->

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
        </div>
                <!-- /Modal -->
    </div>
</div>



<div class="container">
<div class="row">


    <!-- Footer Text1 Start -->
    <div class="col-lg-4 col-sm-6">
            
        <button type="button" class="btn_footer_text1 btn btn_edit_section" data-toggle="modal" data-target=".footer_text1">
            <i class="fas fa-pen customize_icn"></i>
        </button>
        <div class="modal fade edit_modal_section footer_text1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              
                <!-- Home feature -->
                <div class="mdl_bdy_w">
                    <div class="card widget-box warning_w">
                        <div class="card-header warning">
                            <h5 class="card-title">Footer Text</h5>
                            <button type="button" class="close btn_cls_mdl" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <form autocomplete="off" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                                @php
                                  $footer_text1= DB::table('raw_tbl')->where('type', 'footer')->where('section', 'text1')->first();
                                @endphp
                                    {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$footer_text1->id}}">


                                        <label class="control-label text-center col-md-12 col-12">
                                            <h4>Footer Text</h4>
                                        </label>
                                    <div class="control-group col-md-12 col-12">
                                        <div class="controls col-md-12 col-12">
                                        <textarea id="text1" name="description" class="text1" id="editor1">{{$footer_text1->description}}</textarea>
                                        <br>
                                            <script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
                                            <script>CKEDITOR.replace( 'text1' );</script>

                                        </div>
                                    </div>

                                    <div class="control-group col-md-12 col-12 text-center">
                                        <input type="submit" name="submit" class="btn btn-success">
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Home feature -->
            </div>
          </div>
        </div>
    </div>
    <!-- /Footer text1 End -->



    <!-- /Footer Section 2 Start -->
    <div class="col-lg-4 col-sm-6">
        <a href="{{URL('makecommand/page')}}" class="btn btn_footer_section2 btn_edit_section">
            <i class="fas fa-pen customize_icn"></i>
        </a>
    </div>
    <!-- /Footer Section 2 End -->



    <!-- /Footer Section 3 Start -->
    <div class="col-lg-4 col-sm-6">
                            <!-- Customize -->
    <button type="button" class="btn btn_footer_section2 btn_edit_section" data-toggle="modal" data-target=".footer_get_us_know">
        <i class="fas fa-pen customize_icn"></i>
    </button>
    <div class="modal fade edit_modal_section footer_get_us_know" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
            <!-- Home feature -->
            <div class="mdl_bdy_w">
                <div class="card widget-box warning_w">
                    <div class="card-header warning">
                        <h5 class="card-title">Footer Text</h5>
                        <button type="button" class="close btn_cls_mdl" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="">
                                <form autocomplete="off" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                                @php
                                  $footer_text2= DB::table('raw_tbl')->where('type', 'footer')->where('section', 'text2')->first();
                                @endphp
                                    {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$footer_text2->id}}">


                                        <label class="control-label text-center col-md-12 col-12">
                                           <h4> Footer Text</h4>
                                        </label>
                                    <div class="control-group col-md-12 col-12">
                                        <div class="controls col-md-12 col-12">
                                        <textarea id="text2" name="description" class="text2" id="editor1">{{$footer_text2->description}}</textarea>
                                        <br>
                                            <script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
                                            <script>CKEDITOR.replace( 'text2' );</script>
                                        </div>
                                    </div>

                                    <div class="control-group col-md-12 col-12 text-center">
                                        <input type="submit" name="submit" class="btn btn-success">
                                    </div>

                                </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Home feature -->

        </div>
      </div>
    </div>
    <!-- /add section Customize -->
    </div>
    <!-- /Footer Section 3 End -->

</div>
</div>

@endsection