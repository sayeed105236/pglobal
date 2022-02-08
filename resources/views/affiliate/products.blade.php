@extends('affiliate.master.affiliate_master')
@section('title','Products Table')
@section('body')





<div class="page-wrapper">
    
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="ml-auto text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-12">
                <div class="card widget-box">
                    <div class="card-header  widget-title">
                        <h5 class="card-title">Products datatable</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-2 col-12"></div>
                            <div class="col-md-8 col-12 text-center">
                                <a href="{{URL('affiliate-dashboard/products')}}" class="btn btn-primary">
                                    <i class="fas fa-sync-alt" aria-hidden="true"></i> Refresh
                                </a>
                            </div>
                            <div class="col-md-2 col-12"></div>
                        </div>

<br>
                        <div class="row">
                            <div class="col-md-2 col-12"></div>
                            <div class="col-md-8 col-12 alert alert-info text-center" role="alert">
                                Total complete orders of mine <b>{{$products_count}}</b>
                            </div>
                            <div class="col-md-2 col-12"></div>
                        </div>


<br><br><br>
                        <div class="">
                            <form method="get" action="{{URL('affiliate-dashboard/products')}}" class="">
                                <div class="col-md-12 col-12 row text-center">
                                    <div class="col-md-3 col-12"></div>
                                    <div class="col-md-2 col-5 fromto">
                                        <label>From</label>
                                        <input type="date" name="dfrom" class="form-" value="{{$dfrom}}">
                                    </div>
                                    <div class="col-md-2 col-5 fromto">
                                        <label>To</label>
                                        <input type="date" name="dto" class="form-" value="{{$dto}}">
                                    </div>
                                    <button class="col-md-2 col-4 btn btn-primary fromto">
                                        filter
                                    </button>
                                    <div class="col-md-3 col-12"></div>
                                </div>
                            </form>
                        </div>
<br><br>
                            @if( !empty($dfrom) or  !empty($dto))                            
                            <div class="col-md-12 col-12">
                                <div class="alert alert-warning" role="alert">
                                    Result are showing 
                                    from  <b>
                                            <?php
                                            $dfrom = "{$dfrom}";
                                            echo $newDate = date("d-M-Y", strtotime($dfrom));?>
                                        </b>

                                    to  <b>
                                            <?php
                                            $dto = "{$dto}";

                                            $dtoMainDate = date("d", strtotime($dto));
                                            $dtoShowDate=$dtoMainDate-1;

                                            echo "$dtoShowDate-";
                                            echo $newDate = date("M-Y", strtotime($dto));?>
                                        </b>
                                </div>
                            </div>
                            @endif
<br><br>
                            @if( ! empty($search))                            
                            <div class="col-md-12 col-12">
                                <div class="alert alert-primary" role="alert">
                                    You Have Searched for: <b>{{$search}}</b>
                                </div>
                            </div>
                            @endif


                        <div class="table-responsive">
                               <table id="zero_config" class="table table-bordered table-striped text-center dataTable" width="100%" cellspacing="0">
                                    {{$products->links()}}
                                    <thead>
                                        <tr>
                                            <!-- Sorting -->
                                            <th class="sort_th"><b>S.L</b></th>
                                            <th><b>Image</b></th>
                                            <th class="sort_th">
                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif

                                                    <input type="hidden" name="orderby" value="code">
                                                    <input type="hidden" name="ordertype" value="ASC">
                                                    <button class="sort_btn" type="submit">
                                                                    <i class="fas fa-sort-amount-up-alt"></i>
                                                    </button>
                                                </form>

                                                <b>Code</b>

                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif
                                                    <input type="hidden" name="orderby" value="code">
                                                    <input type="hidden" name="ordertype" value="DESC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-down"></i>
                                                    </button>
                                                </form>
                                            </th>
                                            <th class="sort_th">
                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">
                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif

                                                    <input type="hidden" name="orderby" value="name">
                                                    <input type="hidden" name="ordertype" value="ASC">
                                                    <button class="sort_btn" type="submit">
                                                                    <i class="fas fa-sort-amount-up-alt"></i>
                                                    </button>
                                                </form>

                                                <b>Name</b>

                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif
                                                    <input type="hidden" name="orderby" value="name">
                                                    <input type="hidden" name="ordertype" value="DESC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-down"></i>
                                                    </button>
                                                </form>
                                            </th>

                                            <th class="sort_th">
                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif

                                                    <input type="hidden" name="orderby" value="price">
                                                    <input type="hidden" name="ordertype" value="ASC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-up-alt"></i>
                                                    </button>
                                                </form>

                                                <b>Price</b>

                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif
                                                    <input type="hidden" name="orderby" value="price">
                                                    <input type="hidden" name="ordertype" value="DESC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-down"></i>
                                                    </button>
                                                </form>
                                            </th>

                                            <th class="sort_th">
                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif

                                                    <input type="hidden" name="orderby" value="affiliate_percentage">
                                                    <input type="hidden" name="ordertype" value="ASC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-up-alt"></i>
                                                    </button>
                                                </form>

                                                <b>Affiliate Percentage</b>

                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif
                                                    <input type="hidden" name="orderby" value="affiliate_percentage">
                                                    <input type="hidden" name="ordertype" value="DESC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-down"></i>
                                                    </button>
                                                </form>
                                            </th>

                                            <th class="sort_th">
                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif

                                                    <input type="hidden" name="orderby" value="category">
                                                    <input type="hidden" name="ordertype" value="ASC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-up-alt"></i>
                                                    </button>
                                                </form>

                                                <b>Category</b>

                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif
                                                    <input type="hidden" name="orderby" value="category">
                                                    <input type="hidden" name="ordertype" value="DESC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-down"></i>
                                                    </button>
                                                </form>
                                            </th>


                                            <th class="sort_th">
                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif

                                                    <input type="hidden" name="orderby" value="created_at">
                                                    <input type="hidden" name="ordertype" value="ASC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-up-alt"></i>
                                                    </button>
                                                </form>

                                                <b>Publish date</b>

                                                <form method="get" action="{{URL('affiliate-dashboard/sort_products')}}" class="sort_form">

                                                    @if( !empty($dfrom) or  !empty($dto))
                                                    <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                    <input type="hidden" name="dto" value="{{$dto}}">
                                                    @endif

                                                    @if( !empty($search))
                                                    <input type="hidden" name="search_by" value="{{$search_by}}">
                                                    <input type="hidden" name="search" value="{{$search}}">
                                                    @endif
                                                    <input type="hidden" name="orderby" value="created_at">
                                                    <input type="hidden" name="ordertype" value="DESC">
                                                    <button class="sort_btn" type="submit">
                                                        <i class="fas fa-sort-amount-down"></i>
                                                    </button>
                                                </form>
                                            </th>
                                        </tr>

                                        <!-- Searching -->
                                    <tr>
                                        <th></th>
                                        <th>-----</th>
                                        <th>
                                            <form method="get" action="{{URL('affiliate-dashboard/search_products')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif
                                                <input type="hidden" name="search_by" value="code">
                                                <input type="text" name="search" class="small_src_in">
                                            </form>
                                        </th>
                                        <th>
                                            <form method="get" action="{{URL('affiliate-dashboard/search_products')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif
                                                <input type="hidden" name="search_by" value="name">
                                                <input type="text" name="search" class="small_src_in">
                                            </form>
                                        </th>
                                        <th>
                                            <form method="get" action="{{URL('affiliate-dashboard/search_products')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif
                                                <input type="hidden" name="search_by" value="price">
                                                <input type="text" name="search" class="small_src_in">
                                            </form>
                                        </th>
                                        <th>
                                            <form method="get" action="{{URL('affiliate-dashboard/search_products')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif
                                                <input type="hidden" name="search_by" value="affiliate_percentage">
                                                <input type="number" step="any"  name="search" class="small_src_in">
                                            </form>
                                        </th>
                                        <th>
                                            <form method="get" action="{{URL('affiliate-dashboard/search_products')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif
                                                <input type="hidden" name="search_by" value="category">
                                                <input type="text" name="search" class="small_src_in">
                                            </form>
                                        </th>
                                        <th>
                                            <form method="get" action="{{URL('affiliate-dashboard/search_products')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif
                                                <input type="hidden" name="search_by" value="created_at">
                                                <input type="text" name="search" class="small_src_in">
                                            </form>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $data)
                                        <tr>
                                            <td>
                                                <b>
                                                    {{$loop->iteration}}
                                                </b>
                                            </td>
                                            <td>
                                                <a href="{{URL('product')}}/{{$data->name}}/{{$data->id}}" target="_blank">
                                                    <img src="{{URL('public/allfiles/img/product/thumb')}}/{{$data->main_image}}" class="prdct_img">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{URL('product')}}/{{$data->name}}/{{$data->id}}" target="_blank">
                                                    <b>{{$data->code}}</b>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{URL('product')}}/{{$data->name}}/{{$data->id}}" target="_blank">
                                                    {{$data->name}}
                                                </a>
                                            </td>
                                            <td>{{$data->price}}</td>

                                            <td class="txt_c">
                                                {{$data->affiliate_percentage}}%
                                            </td>
                                            <td>
                                                <?php 
                                                  $category="{$data->category}";
                                                  $category= explode(",",$category);?>
                                                  @foreach($category as $category)
                                                    <span class="cs_category">
                                                        <?php echo "$category";?>
                                                    </span>
                                                  @endforeach
                                            </td>
                                            <td>
                                                {{$data->created_at}}

                                                   <!--  <?php
                                                    $created_at="{$data->created_at}";
                            
                                                    $date=date_create("$created_at");
                                                    echo date_format($date,"d F Y");
                                                    ?> -->
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>{{$products->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @if( !empty($dfrom) or  !empty($dto))               
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('affiliate-dashboard/search_complete_my_affiliate_products')}}";
            location.replace(url+"?dfrom=<?php echo $dfrom?>&dto=<?php echo $dto?>&search_by="+selectby+"&search="+select);
        }
        </script>
    @else                            
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('affiliate-dashboard/search_complete_my_affiliate_products')}}";
            location.replace(url+"?search_by="+selectby+"&search="+select);
        }
        </script>
    @endif


@endsection
