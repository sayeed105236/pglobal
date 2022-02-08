<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
      


    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('resources/assets/images/icons/favicon.png')}}">

    <!-- WebFont.js')}} -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '{{asset('resources/assets/js/webfont.js')}}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="{{asset('resources/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('resources/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2')}}"
        crossorigin="anonymous">
    <link rel="preload" href="{{asset('resources/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2')}}"
            crossorigin="anonymous">
    <link rel="preload" href="{{asset('resources/assets/fonts/wolmart87d5.ttf?png09e')}}" as="font" type="font/ttf" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/vendor/fontawesome-free/css/all.min.css')}}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/vendor/owl-carousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/vendor/animate/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/vendor/magnific-popup/magnific-popup.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/frontend/master/css.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/css/demo1.min.css')}}">

      <title>@yield('title')</title>
      @yield('css')

    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="">

</head>

<body class="home">
    <div class="page-wrapper">
        <!-- Start of Header -->
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <p class="welcome-msg">Welcome to Pioneer Global Shop!</p>
                    </div>
                    <div class="header-right">

                        <span class="divider d-lg-show"></span>
                        <!--<a href="contact-us.html" class="d-lg-show">Contact Us</a>-->
                        @guest
                        <a href="{{URL('login')}}">
                            <i class="w-icon-account"></i>Sign In
                        </a>
                        <span class="delimiter d-lg-show">/</span>
                        <a href="{{URL('login')}}" class="ml-0 d-lg-show ">
                            Register
                        </a>
                        @else
                        <a href="{{URL('login')}}" class="d-lg-show">My Account</a>

                        <a class="d-lg-show" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <!-- <i class="fa fa-power-off m-r-5 m-l-5"></i> --> Log out
                        </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        @endguest
                    </div>
                </div>
            </div>
            <!-- End of Header Top -->



            <div class="header-middle">
                <div class="container">
                    <div class="header-left mr-md-4">
                        <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
                        </a>
                        <a href="{{URL('')}}" class="logo ml-lg-0">

                                @php
                                  $footer_logo= DB::table('raw_tbl')->where('type', 'logo')->where('section', 'footer')->first();
                                @endphp

                            <img src="{{asset('public/allfiles/img/customize')}}/{{$footer_logo->image}}" alt="logo" width="144" height="45" />
                        </a>
                        <form class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper" action="{{URL('shop')}}" method="get">
                            <div class="select-box">
                                <select id="category" name="category">
                                    <option value="">All Categories</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" name="search" id="search"
                                placeholder="Search in..." required />
                            <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="header-right ml-4">
                        <div class="header-call d-xs-show d-lg-flex align-items-center">
                        </div>
                        <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">

                            <a href="{{URL('cart')}}" class="single-icon">
                                @guest
                                <i class="w-icon-cart">
                                    <span class="cart-count">0</span>
                                </i>
                                @else
                                <i class="w-icon-cart">
                                    <span class="cart-count">
                                        @php
                                            $Auth_id=Auth::user()->id;
                                            echo $cart_tbl=App\admin\cart_tbl::where('user_id',$Auth_id)->count();
                                        @endphp
                                    </span>
                                </i>
                                <span class="total-count">
                                </span>
                                @endguest
                            </a>
                            <!-- End of Dropdown Box -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Header Middle -->











            <div class="header-bottom_2 sticky-content fix-top sticky-header">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left">
                            <div class="dropdown category-dropdown has-border" data-visible="true">
                                <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true" data-display="static"
                                    title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>

                                <div class="dropdown-box">
                                    <ul class="menu vertical-menu category-menu">

<style type="text/css">
    ul.menu.vertical-menu.category-menu {
    padding:4px;
    height: 540px;
    overflow-x: hidden;
    overflow-y: auto;
    text-align:justify;
}
</style>

                                    @php
                                        $category_tbl= App\admin\category_tbl::where('parent_id', "0")->take("11")->get(); 
                                        $category_tbl= App\admin\category_tbl::orderBy('name', 'asc')->get(); 
                                    @endphp

                                    @foreach($category_tbl as $category_tbl)
                                      @php 
                                        $id="{$category_tbl->id}";
                                        $child_category_count= App\admin\category_tbl::where('parent_id',$id)->count();
                                      @endphp


                                          @if($category_tbl->name=="Dealer")
                                          @else
                                          <li>
                                            <a href="{{URL('shop?category_name')}}={{$category_tbl->name}}">
                                              <img src="{{URL('public/allfiles/img/category')}}/{{$category_tbl->icon}}" class="bc_img">
                                              {{$category_tbl->name}}
                                            </a>
                                          </li>
                                          @endif


                                        <!-- @if($child_category_count == 0)
                                          <li>
                                            <a href="{{URL('shop?category_name')}}={{$category_tbl->name}}">
                                              <img src="{{URL('public/allfiles/img/category')}}/{{$category_tbl->icon}}" class="bc_img">
                                              {{$category_tbl->name}}
                                            </a>
                                          </li>
                                        @else
                                          <li>
                                            <a href="{{URL('shop?category_name')}}={{$category_tbl->name}}">
                                              <img src="{{URL('public/allfiles/img/category')}}/{{$category_tbl->icon}}" class="bc_img">
                                               {{$category_tbl->name}}
                                            </a>
                                            @php
                                              $child_category=App\admin\category_tbl::where('parent_id',$id)->take("9")->get();
                                            @endphp
                                            <ul class="megamenu">
                                              <li>
                                                @foreach($child_category as $child_category)
                                                  @php
                                                    $iteration="$child_category->iteration";
                                                  @endphp
                                                  <ul>
                                                    <li>
                                                      <a href="{{URL('shop?category_name')}}={{$child_category->name}}">
                                                        <img src="{{URL('public/allfiles/img/category')}}/{{$child_category->icon}}" class="bc_img">
                                                        {{$child_category->name}}
                                                      </a>
                                                    </li>
                                                   </ul>
                                                @endforeach
                                              </li>
                                            </ul>
                                        @endif -->
                                    @endforeach
                                    
                                       <!--  <li>
                                            <a href="{{URL('show_category')}}"
                                                class="font-weight-bold text-primary text-uppercase ls-25">
                                                View All Categories<i class="w-icon-angle-right"></i>
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                            <nav class="main-nav">
                                <ul class="menu active-underline">
                                    <li class="active">
                                        <a href="{{URL('/')}}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{URL('shop')}}">Shop</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-right">
                            <a href="{{URL('order_track')}}" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                        </div>
                    </div>
                </div>
            </div>





        </header>
        <!-- End of Header -->




@yield('body')

@include('sweetalert::alert')



        <!-- Start of Footer -->
        <footer class="footer appear-animate">
            <div class="footer-newsletter bg-primary">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-5 col-lg-6">
                            <div class="icon-box icon-box-side text-white">
                                <div class="icon-box-icon d-inline-flex">
                                    <i class="w-icon-envelop3"></i>
                                </div>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-white text-uppercase font-weight-bold">Subscribe To
                                        Our Newsletter</h4>
                                    <p class="text-white">Get all the latest information on Events, Sales and Offers.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                            <form action="#" method="get"
                                class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                                <input type="email" class="form-control mr-2 bg-white" name="email" id="email"
                                    placeholder="Your E-mail Address" />
                                <button class="btn btn-dark btn-rounded" type="submit">Subscribe<i
                                        class="w-icon-long-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="widget widget-about">
                                <a href="{{URL('')}}" class="logo-footer">
                                    <img src="{{asset('public/allfiles/img/customize')}}/{{$footer_logo->image}}" alt="logo-footer" />
                                </a>
                                <div class="widget-body">


                                @php
                                  $footer_text1= DB::table('raw_tbl')->where('type', 'footer')->where('section', 'text1')->first();
                                @endphp
                                <p class="text" style="color: #fff;">
                                    <?php echo "{$footer_text1->description}";?>
                                </p>

                                    <div class="social-icons social-icons-colored">


                                        <ul class="social_link_ul">
                                            @php
                                              $footer_social=App\admin\raw_tbl::where('type', 'footer_social')->get();
                                            @endphp
                                            @foreach($footer_social as $footer_social)
                                              @if($footer_social->url==NULL || $footer_social->url=="none")
                                              @else
                                              <li class="social_link_li">
                                                <a href="{{$footer_social->url}}" target="_blank">
                                                  <img src="{{asset('public/allfiles/img/customize')}}/{{$footer_social->image}}" style="width: 45px;height: 45px;">
                                                </a>
                                              </li>
                                              @endif
                                            @endforeach
                                          </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="widget">
                                <h3 class="widget-title">Information</h3>
                                    @php
                                        $page=App\admin\page_tbl::orderBy('id', 'desc')->get();
                                    @endphp
                                    <ul>
                                        <li><a href="{{URL('fnq')}}">F&Q</a></li>
                                        @foreach($page as $page)
                                        <li>
                                            <a href="{{URL('page')}}/{{$page->name}}/{{$page->id}}">
                                                {{$page->name}}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Get Us Know</h4>

                            @php
                              $footer_text2= DB::table('raw_tbl')->where('type', 'footer')->where('section', 'text2')->first();
                            @endphp
                                <ul class="widget-body">

                                    <div class="contact">
                                        <?php echo "{$footer_text2->description}";?>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="footer-middle">
                    <div class="widget widget-category">
                        <div class="category-box">
                            <h6 class="category-name">Consumer Electric:</h6>
                            <a href="#">TV Television</a>
                            <a href="#">Air Condition</a>
                            <a href="#">Refrigerator</a>
                            <a href="#">Washing Machine</a>
                            <a href="#">Audio Speaker</a>
                            <a href="#">Security Camera</a>
                            <a href="#">View All</a>
                        </div>
                        <div class="category-box">
                            <h6 class="category-name">Clothing & Apparel:</h6>
                            <a href="#">Men's T-shirt</a>
                            <a href="#">Dresses</a>
                            <a href="#">Men's Sneacker</a>
                            <a href="#">Leather Backpack</a>
                            <a href="#">Watches</a>
                            <a href="#">Jeans</a>
                            <a href="#">Sunglasses</a>
                            <a href="#">Boots</a>
                            <a href="#">Rayban</a>
                            <a href="#">Acccessories</a>
                        </div>
                        <div class="category-box">
                            <h6 class="category-name">Home, Garden & Kitchen:</h6>
                            <a href="#">Sofa</a>
                            <a href="#">Chair</a>
                            <a href="#">Bed Room</a>
                            <a href="#">Living Room</a>
                            <a href="#">Cookware</a>
                            <a href="#">Utensil</a>
                            <a href="#">Blender</a>
                            <a href="#">Garden Equipments</a>
                            <a href="#">Decor</a>
                            <a href="#">Library</a>
                        </div>
                        <div class="category-box">
                            <h6 class="category-name">Health & Beauty:</h6>
                            <a href="#">Skin Care</a>
                            <a href="#">Body Shower</a>
                            <a href="#">Makeup</a>
                            <a href="#">Hair Care</a>
                            <a href="#">Lipstick</a>
                            <a href="#">Perfume</a>
                            <a href="#">View all</a>
                        </div>
                        <div class="category-box">
                            <h6 class="category-name">Jewelry & Watches:</h6>
                            <a href="#">Necklace</a>
                            <a href="#">Pendant</a>
                            <a href="#">Diamond Ring</a>
                            <a href="#">Silver Earing</a>
                            <a href="#">Leather Watcher</a>
                            <a href="#">Rolex</a>
                            <a href="#">Gucci</a>
                            <a href="#">Australian Opal</a>
                            <a href="#">Ammolite</a>
                            <a href="#">Sun Pyrite</a>
                        </div>
                        <div class="category-box">
                            <h6 class="category-name">Computer & Technologies:</h6>
                            <a href="#">Laptop</a>
                            <a href="#">iMac</a>
                            <a href="#">Smartphone</a>
                            <a href="#">Tablet</a>
                            <a href="#">Apple</a>
                            <a href="#">Asus</a>
                            <a href="#">Drone</a>
                            <a href="#">Wireless Speaker</a>
                            <a href="#">Game Controller</a>
                            <a href="#">View all</a>
                        </div>
                    </div>
                </div> -->
                <div class="footer-bottom">
                    <div class="footer-left">
                        <p class="copyright">Copyright © 2021 Pioneer Global Shop. All Rights Reserved.</p>
                    </div>
                    <div class="footer-right">
                        <span class="payment-label mr-lg-8">We're using safe payment for</span>
                        <figure class="payment">
                            <img src="{{asset('resources/assets/images/payment.png')}}" alt="payment" width="159" height="25" />
                        </figure>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Page-wrapper-->

    <!-- Start of Sticky Footer -->
    <div class="sticky-footer sticky-content fix-bottom">
        <a href="{{URL('')}}" class="sticky-link active">
            <i class="w-icon-home"></i>
            <p>Home</p>
        </a>
        <a href="{{URL('shop')}}" class="sticky-link">
            <i class="w-icon-category"></i>
            <p>Shop</p>
        </a>
        <a href="{{URL('login')}}" class="sticky-link">
            <i class="w-icon-account"></i>
            <p>Account</p>
        </a>
        <a href="{{URL('cart')}}" class="sticky-link">
            <i class="w-icon-cart"></i>
            <p>Cart</p>
        </a>
        <div class="header-search hs-toggle dir-up">
            <a href="#" class="search-toggle sticky-link">
                <i class="w-icon-search"></i>
                <p>Search</p>
            </a>
            <form class="input-wrapper" action="{{URL('shop')}}" method="get">
                <input type="text" class="form-control" name="search" autocomplete="off" required placeholder="Search"
                    required />
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form>


        </div>
    </div>
    <!-- End of Sticky Footer -->

    <!-- Start of Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="fas fa-chevron-up"></i></a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay"></div>
        <!-- End of .mobile-menu-overlay -->

        <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
        <!-- End of .mobile-menu-close -->

        <div class="mobile-menu-container scrollable">
            <form action="#" method="get" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                    required />
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form>
            <!-- End of Search Form -->
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#main-menu" class="nav-link active">Main Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="#categories" class="nav-link">Categories</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="main-menu">
                    <ul class="mobile-menu">

                        <li>
                            <a href="{{URL('')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{URL('shop')}}">Shop</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="categories">
                    <ul class="mobile-menu">
                        
                        @php
                            //$category_tbl= App\admin\category_tbl::where('parent_id', "0")->take("11")->get();
                            $category_tbl= App\admin\category_tbl::orderBy('name', 'asc')->get();
                        @endphp

                        @foreach($category_tbl as $category_tbl)
                          @php 
                            $id="{$category_tbl->id}";
                            $child_category_count= App\admin\category_tbl::where('parent_id',$id)->count();
                          @endphp



                              <li>
                                <a href="{{URL('shop?category_name')}}={{$category_tbl->name}}">
                                  {{$category_tbl->name}}
                                </a>
                              </li>

                            <!-- @if($child_category_count == 0)
                              <li>
                                <a href="{{URL('shop?category_name')}}={{$category_tbl->name}}">
                                  {{$category_tbl->name}}
                                </a>
                              </li>
                            @else
                              <li>
                                <a href="{{URL('shop?category_name')}}={{$category_tbl->name}}">
                                   {{$category_tbl->name}}
                                </a>
                                @php
                                  $child_category=App\admin\category_tbl::where('parent_id',$id)->take("9")->get();
                                @endphp
                                <ul class="megamenu">
                                  <li>
                                    @foreach($child_category as $child_category)
                                      @php
                                        $iteration="$child_category->iteration";
                                      @endphp
                                      <ul>
                                        <li>
                                          <a href="{{URL('shop?category_name')}}={{$child_category->name}}">
                                            {{$child_category->name}}
                                          </a>
                                        </li>
                                       </ul>
                                    @endforeach
                                  </li>
                                </ul>
                            @endif -->
                        @endforeach
                        
                            <!-- <li>
                                <a href="{{URL('show_category')}}"
                                    class="font-weight-bold text-primary text-uppercase ls-25">
                                    View All Categories<i class="w-icon-angle-right"></i>
                                </a>
                            </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Mobile Menu -->

    <!-- Start of Quick View -->
    <div class="product product-single product-popup">
        <div class="row gutter-lg">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="product-gallery product-gallery-sticky mb-0">
                    <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                        <figure class="product-image">
                            <img src="{{asset('resources/assets/images/products/popup/1-440x494.jpg')}}"
                                data-zoom-image="{{asset('resources/assets/images/products/popup/1-800x900.jpg')}}"
                                alt="Water Boil Black Utensil" width="800" height="900">
                        </figure>
                        <figure class="product-image">
                            <img src="{{asset('resources/assets/images/products/popup/2-440x494.jpg')}}"
                                data-zoom-image="{{asset('resources/assets/images/products/popup/2-800x900.jpg')}}"
                                alt="Water Boil Black Utensil" width="800" height="900">
                        </figure>
                        <figure class="product-image">
                            <img src="{{asset('resources/assets/images/products/popup/3-440x494.jpg')}}"
                                data-zoom-image="{{asset('resources/assets/images/products/popup/3-800x900.jpg')}}"
                                alt="Water Boil Black Utensil" width="800" height="900">
                        </figure>
                        <figure class="product-image">
                            <img src="{{asset('resources/assets/images/products/popup/4-440x494.jpg')}}"
                                data-zoom-image="{{asset('resources/assets/images/products/popup/4-800x900.jpg')}}"
                                alt="Water Boil Black Utensil" width="800" height="900">
                        </figure>
                    </div>
                    <div class="product-thumbs-wrap">
                        <div class="product-thumbs">
                            <div class="product-thumb active">
                                <img src="{{asset('resources/assets/images/products/popup/1-103x116.jpg')}}" alt="Product Thumb" width="103"
                                    height="116">
                            </div>
                            <div class="product-thumb">
                                <img src="{{asset('resources/assets/images/products/popup/2-103x116.jpg')}}" alt="Product Thumb" width="103"
                                    height="116">
                            </div>
                            <div class="product-thumb">
                                <img src="{{asset('resources/assets/images/products/popup/3-103x116.jpg')}}" alt="Product Thumb" width="103"
                                    height="116">
                            </div>
                            <div class="product-thumb">
                                <img src="{{asset('resources/assets/images/products/popup/4-103x116.jpg')}}" alt="Product Thumb" width="103"
                                    height="116">
                            </div>
                        </div>
                        <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                        <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 overflow-hidden p-relative">
                <div class="product-details scrollable pl-0">
                    <h2 class="product-title">Electronics Black Wrist Watch</h2>
                    <div class="product-bm-wrapper">
                        <figure class="brand">
                            <img src="{{asset('resources/assets/images/products/brand/brand-1.jpg')}}" alt="Brand" width="102" height="48" />
                        </figure>
                        <div class="product-meta">
                            <div class="product-categories">
                                Category:
                                <span class="product-category"><a href="#">Electronics</a></span>
                            </div>
                            <div class="product-sku">
                                SKU: <span>MS46891340</span>
                            </div>
                        </div>
                    </div>

                    <hr class="product-divider">

                    <div class="product-price">$40.00</div>

                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 80%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="#" class="rating-reviews">(3 Reviews)</a>
                    </div>

                    <div class="product-short-desc">
                        <ul class="list-type-check list-style-none">
                            <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                            <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                            <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                        </ul>
                    </div>

                    <hr class="product-divider">

                    <div class="product-form product-variation-form product-color-swatch">
                        <label>Color:</label>
                        <div class="d-flex align-items-center product-variations">
                            <a href="#" class="color" style="background-color: #ffcc01"></a>
                            <a href="#" class="color" style="background-color: #ca6d00;"></a>
                            <a href="#" class="color" style="background-color: #1c93cb;"></a>
                            <a href="#" class="color" style="background-color: #ccc;"></a>
                            <a href="#" class="color" style="background-color: #333;"></a>
                        </div>
                    </div>
                    <div class="product-form product-variation-form product-size-swatch">
                        <label class="mb-1">Size:</label>
                        <div class="flex-wrap d-flex align-items-center product-variations">
                            <a href="#" class="size">Small</a>
                            <a href="#" class="size">Medium</a>
                            <a href="#" class="size">Large</a>
                            <a href="#" class="size">Extra Large</a>
                        </div>
                        <a href="#" class="product-variation-clean">Clean All</a>
                    </div>

                    <div class="product-variation-price">
                        <span></span>
                    </div>

                    <div class="product-form">
                        <div class="product-qty-form">
                            <div class="input-group">
                                <input class="quantity form-control" type="number" min="1" max="10000000">
                                <button class="quantity-plus w-icon-plus"></button>
                                <button class="quantity-minus w-icon-minus"></button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-cart">
                            <i class="w-icon-cart"></i>
                            <span>Add to Cart</span>
                        </button>
                    </div>

                    <div class="social-links-wrapper">
                        <div class="social-links">
                            <div class="social-icons social-no-color border-thin">
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                            </div>
                        </div>
                        <span class="divider d-xs-show"></span>
                        <div class="product-link-wrapper d-flex">
                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                            <a href="#"
                                class="btn-product-icon btn-compare btn-icon-left w-icon-compare"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Quick view -->

    <!-- Plugin JS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/js/bootstrap.min.js')}}">
    
    <script src="{{asset('resources/assets/js/jquery-3.2.1.slim.min.js')}}" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="{{asset('resources/assets/js/bootstrap.min.js')}}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{asset('resources/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('resources/assets/vendor/jquery.plugin/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('resources/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('resources/assets/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('resources/assets/vendor/zoom/jquery.zoom.min.js')}}"></script>
    <!-- <script src="{{asset('resources/assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script> -->
    <script src="{{asset('resources/assets/vendor/skrollr/skrollr.min.js')}}"></script>
    <script src="{{asset('resources/assets/vendor/jquery.countdown/jquery.countdown.min.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('resources/assets/js/main.min.js')}}"></script>
</body>

</html>
