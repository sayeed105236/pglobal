@extends('affiliate.master.affiliate_master')
@section('title','My Pending Affiliate Orders')
@section('body')





//MAIL_DRIVER=smtp
//MAIL_HOST=smtp.gmail.com
//MAIL_PORT=587
//MAIL_USERNAME=workedbikroy@gmail.com
//MAIL_PASSWORD=fzzijoscehfdcxza
//MAIL_ENCRYPTION=tls
//MAIL_FROM_ADDRESS=noreply@workedbd.com

<div class="page-wrapper">
    
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="ml-auto text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Pending Affiliate Orders</li>
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
                        <h5 class="card-title">Reffered Pending Product Order datatable</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-2 col-12"></div>
                            <div class="col-md-8 col-12 text-center">
                                <a href="{{URL('affiliate-dashboard/pending_my_affiliate_order')}}" class="btn btn-primary">
                                    <i class="fas fa-sync-alt" aria-hidden="true"></i> Refresh
                                </a>
                            </div>
                            <div class="col-md-2 col-12"></div>
                        </div>

<br>
                        <div class="row">
                            <div class="col-md-2 col-12"></div>
                            <div class="col-md-8 col-12 alert alert-info text-center" role="alert">
                                Total Pending orders of mine <b>{{$pending_my_affiliate_order_count}}</b>
                            </div>
                            <div class="col-md-2 col-12"></div>
                        </div>


<br><br><br>
                        <div class="">
                            <form method="get" action="{{URL('affiliate-dashboard/pending_my_affiliate_pending_my_affiliate_order')}}" class="">
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
                            <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                                {{$pending_my_affiliate_order->links()}}
                                <thead>
                                    <tr>
                                        <!-- Sorting -->
                                        <th class="sort_th">
                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif

                                                <input type="hidden" name="orderby" value="id">
                                                <input type="hidden" name="ordertype" value="ASC">
                                                <button class="sort_btn" type="submit">
                                                                <i class="fas fa-sort-amount-up-alt"></i>
                                                </button>
                                            </form>

                                            <b>S.L-ID</b>

                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif
                                                <input type="hidden" name="orderby" value="id">
                                                <input type="hidden" name="ordertype" value="DESC">
                                                <button class="sort_btn" type="submit">
                                                    <i class="fas fa-sort-amount-down"></i>
                                                </button>
                                            </form>
                                        </th>
                                        <th class="sort_th">
                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif

                                                <input type="hidden" name="orderby" value="order_code">
                                                <input type="hidden" name="ordertype" value="ASC">
                                                <button class="sort_btn" type="submit">
                                                                <i class="fas fa-sort-amount-up-alt"></i>
                                                </button>
                                            </form>

                                            <b>Order Code</b>

                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif
                                                <input type="hidden" name="orderby" value="order_code">
                                                <input type="hidden" name="ordertype" value="DESC">
                                                <button class="sort_btn" type="submit">
                                                    <i class="fas fa-sort-amount-down"></i>
                                                </button>
                                            </form>
                                        </th>
                                        <th class="sort_th">
                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

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

                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

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
                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif

                                                <input type="hidden" name="orderby" value="status">
                                                <input type="hidden" name="ordertype" value="ASC">
                                                <button class="sort_btn" type="submit">
                                                                <i class="fas fa-sort-amount-up-alt"></i>
                                                </button>
                                            </form>

                                            <b>Status</b>

                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif
                                                <input type="hidden" name="orderby" value="status">
                                                <input type="hidden" name="ordertype" value="DESC">
                                                <button class="sort_btn" type="submit">
                                                    <i class="fas fa-sort-amount-down"></i>
                                                </button>
                                            </form>
                                        </th>

                                        <th class="sort_th">
                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

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

                                            <b>Time</b>

                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

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

                                        <th class="sort_th">
                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif

                                                <input type="hidden" name="orderby" value="product_price">
                                                <input type="hidden" name="ordertype" value="ASC">
                                                <button class="sort_btn" type="submit">
                                                    <i class="fas fa-sort-amount-up-alt"></i>
                                                </button>
                                            </form>

                                            <b>Total Price</b>

                                            <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/sort_pending_my_affiliate_order')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif
                                                <input type="hidden" name="orderby" value="product_price">
                                                <input type="hidden" name="ordertype" value="DESC">
                                                <button class="sort_btn" type="submit">
                                                    <i class="fas fa-sort-amount-down"></i>
                                                </button>
                                            </form>
                                        </th>
                                    </tr>

                                <!-- Searching -->
                                <!-- <tr>

                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/search_pending_my_affiliate_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="id">
                                            <input type="number" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/search_pending_my_affiliate_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="order_code">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/search_pending_my_affiliate_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="name">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/search_pending_my_affiliate_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="status">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/search_pending_my_affiliate_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="created_at">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('affiliate-dashboard/search_pending_my_affiliate_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="product_price">
                                            <input type="number" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                -->
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($pending_my_affiliate_order as $data)
                                    <tr>
                                        <td><b>{{$loop->iteration}}-{{$data->id}}</b></td>
                                        <td>{{$data->order_code}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>
                                            <span class="{{$data->status}}">{{$data->status}}</span>
                                        </td>
                                        <td>{{$data->created_at->diffForHumans()}}</td>
                                        <td><b>{{$data->product_price}}</b></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>{{$pending_my_affiliate_order->links()}}
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
          var url="{{URL('affiliate-dashboard/search_pending_my_affiliate_pending_my_affiliate_order')}}";
            location.replace(url+"?dfrom=<?php echo $dfrom?>&dto=<?php echo $dto?>&search_by="+selectby+"&search="+select);
        }
        </script>
    @else                            
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('affiliate-dashboard/search_pending_my_affiliate_pending_my_affiliate_order')}}";
            location.replace(url+"?search_by="+selectby+"&search="+select);
        }
        </script>
    @endif


@endsection
