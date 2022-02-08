@extends('frontend.master.master')
@section('body')



        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav"  style="margin-bottom:20px;">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                        <li><a href="{{URL('')}}">Home</a></li>
                        <li><a href="">Shop</a></li>
                    </ul>

            <hr>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content mb-10">

                <div class="container-fluid">
                    <!-- Start of Shop Content -->
                    <div class="shop-content row gutter-lg">
                        <!-- Start of Sidebar, Shop Sidebar -->
                        <aside class="sidebar shop-sidebar left-sidebar sticky-sidebar-wrapper sidebar-fixed">
                            <!-- Start of Sidebar Overlay -->
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                            <!-- Start of Sidebar Content -->
                            <div class="sidebar-content scrollable">
                                <!-- Start of Sticky Sidebar -->
                                <div class="sticky-sidebar">
                                    <div class="filter-actions">
                                        <label>Filter :</label>
                                        <a href="#" class="btn btn-dark btn-link filter-clean">Clean All</a>
                                    </div>
                                    <!-- Start of Collapsible widget -->
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><label>All Categories</label></h3>
                                        <ul class="widget-body filter-items search-ul">

                                            @php
                                                $cat=App\admin\category_tbl::inRandomOrder()->limit(12)->get();
                                            @endphp
                                            @foreach($cat as $cat)
                                            <li>
                                                <a href="{{URL('shop')}}?category_name={{$cat->name}}">
                                                    {{$cat->name}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- End of Collapsible Widget -->

                                    <!-- Start of Collapsible Widget -->
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><label>Price</label></h3>
                                        <div class="widget-body">

                                            <ul class="filter-items search-ul">
                                                <li>
                                                    <a href="{{URL('shop?low_price=0&high_price=100')}}">
                                                        $0.00 - $100.00
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{URL('shop?low_price=100&high_price=500')}}">
                                                        $100.00 - $500.00
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{URL('shop?low_price=500&high_price=1000')}}">
                                                        $500.00 - $1000.00
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{URL('shop?low_price=1000&high_price=3000')}}">
                                                        $1000.00 - $3000.00
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{URL('shop?low_price=3000')}}">
                                                        $3000.00+
                                                    </a>
                                                </li>
                                            </ul>

                                            <b>Range:</b>
                                            <form action="{{URL('shop')}}" method="get" class="price-range">
                                                @if( !empty($low_price) or  !empty($high_price))
                                                <input type="number" name="low_price" class="min_price text-center" placeholder="$min"  value="{{$low_price}}" >
                                                
                                                <span class="delimiter">-</span>

                                                <input type="number" name="high_price" class="max_price text-center" placeholder="$max" value="{{$high_price}}" />

                                                @else

                                                <input type="number" name="low_price" class="min_price text-center" placeholder="$min">
                                                
                                                <span class="delimiter">-</span>

                                                <input type="number" name="high_price" class="max_price text-center" placeholder="$max">

                                                @endif
                                                <button class="btn btn-primary btn-rounded">Go</button>
                                            </form>

                                        </div>
                                    </div>
                                    <!-- End of Collapsible Widget -->

                                    
                                </div>
                                <!-- End of Sidebar Content -->
                            </div>
                            <!-- End of Sidebar Content -->
                        </aside>
                        <!-- End of Shop Sidebar -->

                        <!-- Start of Shop Main Content -->
                        <div class="main-content">
                            <nav class="toolbox">
                                <div class="toolbox-left">
                                    <div class="toolbox-item toolbox-sort select-box text-dark">
                                        <label>Sort By :</label>
                                        <select class="form-control cs_select_filter" name="orderBy" id="orderby_value" onchange="orderby_value_service()">
                                            <option selected="selected">Order By</option>
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="toolbox-right">
                                    <div class="toolbox-item toolbox-show select-box">
                                        <label>Show Products :</label>
                                        <select class="form-control cs_select_filter"  name="paginate" id="paginate_value" onchange="paginate_value_service()">
                                            <option selected="selected">show</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="40">40</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div> -->
                            </nav>

                            <div class="product-wrapper row cols-xl-5 cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                                
                                @foreach($product_tbl as $data)
                                <div class="product-wrap">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="{{URL('product')}}/{{$data->name}}/{{$data->id}}">
                                                <img src="{{asset('public/allfiles/img/product')}}/{{$data->main_image}}" alt="Product" width="300"
                                                    height="338" />
                                            </a>
                                            <div class="product-action-horizontal">

                                                <a href="{{URL('product')}}/{{$data->name}}/{{$data->id}}" class="btn-quickview hvr_view">
                                                    <span class="w-icon-zoom"></span>
                                                    &nbsp View
                                                </a>

                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <div class="product-cat">
                                                <a href="{{URL('product')}}/{{$data->name}}/{{$data->id}}"> 
                                                    <?php 
                                                      $category="{$data->category}";
                                                      $category= explode(",",$category);?>
                                                      @foreach($category as $category)
                                                        @if($loop->index==0)
                                                            <?php echo "$category";?>
                                                        @endif
                                                      @endforeach
                                                </a>
                                            </div>
                                            <h3 class="product-name">
                                                <a href="{{URL('product')}}/{{$data->name}}/{{$data->id}}">{{$data->name}}</a>
                                            </h3>
                                            <div class="ratings-container">
                                                <!--  <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div> -->
                                                <!-- <a href="{{URL('product')}}/{{$data->name}}/{{$data->id}}" class="rating-reviews">(10 reviews)</a> -->
                                            </div>
                                            <div class="product-pa-wrapper">
                                                <div class="product-price">
                                                    
                                                    <ins class="new-price">৳ {{$data->price}}</ins>

                                                    @if(!empty($before_discount))
                                                        <del class="old-price">
                                                            ৳{{$data->before_discount}}
                                                        </del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>

                            <div class="toolbox toolbox-pagination justify-content-between">
                                <!-- <p class="showing-info mb-2 mb-sm-0">
                                    Showing<span>1-12 of 60</span>Products
                                </p> -->
                                <ul class="pagination">
                                    {{$product_tbl->links()}}
                                </ul>
                            </div>
                        </div>
                        <!-- End of Shop Main Content -->

                        <!-- Start of Sidebar, Right-sidebar -->
                        <aside class="shop-sidebar right-sidebar sticky-sidebar-wrapper">
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                            <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-left"></i></a>
                            <div class="sidebar-content">
                                
                            </div>
                        </aside>
                    </div>
                    <!-- End of Shop Content -->
                </div>

    
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->



    <script>
        function paginate_value_service() {
          var select = document.getElementById("paginate_value").value;
          var url="{{URL('shop')}}";
            location.replace(url+"?paginate="+select);
        }
        function orderby_value_service() {
          var select = document.getElementById("orderby_value").value;
          var url="{{URL('shop')}}";
            location.replace(url+"?orderBy="+select);
        }
    </script>
@endsection
