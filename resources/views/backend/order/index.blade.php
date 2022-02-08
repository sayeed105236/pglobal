@extends('backend.master.backend_master')
@section('title','Dashboard')

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('resources/backend/assets/extra-libs/multicheck/multicheck.css')}}">
        <link href="{{asset('resources/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
    @endsection
@section('body')





<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="ml-auto text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
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
                        <h5 class="card-title">Basic Datatable</h5>
                    </div>
                    <div class="card-body">
                            <form method="get" autocomplete="off" action="{{URL('makecommand/order')}}">
                            <div class="col-md-12 col-12">
                                <div class="col-md-4 col-5 fromto">
                                    <label>From</label>
                                    <input type="date" name="dfrom" class="form-" value="{{$dfrom}}">
                                </div>
                                <div class="col-md-4 col-5 fromto">
                                    <label>To</label>
                                    <input type="date" name="dto" class="form-" value="{{$dto}}">
                                </div>
                                <button class="col-md-2 col-4 btn btn-primary fromto">
                                    filter
                                </button>
                            </div>
                        </form>
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
                            <div class="col-md-5 col-12 left plussrc">
                                <a href="{{URL('makecommand/order')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Refresh</a>
                            </div>
                            @if( ! empty($search))                            
                            <div class="col-md-12 col-12">
                                <div class="alert alert-primary" role="alert">
                                    You Have Searched for: <b>{{$search}}</b>
                                </div>
                            </div>
                            @endif


                        <div class="table-responsive">
                            <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                                {{$order_tbl->links()}}
                                <thead>
                                    <tr>
                                        <!-- Sorting -->
                                        <th class="sort_th">
                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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

                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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
                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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

                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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
                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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

                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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
                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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

                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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
                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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

                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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
                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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

                                            <form method="get" autocomplete="off" action="{{URL('makecommand/sort_order')}}" class="sort_form">

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
                                        <th><b>Action</b></th>
                                    </tr>

                                <!-- Searching -->
                                <tr>

                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('makecommand/search_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="id">
                                            <input type="number" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('makecommand/search_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="order_code">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('makecommand/search_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="name">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('makecommand/search_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="status">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('makecommand/search_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="created_at">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" autocomplete="off" action="{{URL('makecommand/search_order')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="product_price">
                                            <input type="number" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>-------</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_tbl as $data)
                                    <tr>
                                        <td><b>{{$loop->iteration}}-{{$data->id}}</b></td>
                                        <td>
                                            <a href="{{URL('makecommand/edit_order?id')}}={{$data->id}}">{{$data->order_code}}</a>
                                        </td>
                                        <td>
                                            <a href="{{URL('makecommand/edit_order?id')}}={{$data->id}}">{{$data->name}}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="{{$data->status}}">{{$data->status}}</span>
                                        </td>
                                        <td>{{$data->created_at}}</td>
                                        <td><b>{{$data->product_price}}</b></td>
                                        <td>
                                            <a href="{{URL('makecommand/show_order?id')}}={{$data->id}}" class="btn btn-warning">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{URL('makecommand/edit_order?id')}}={{$data->id}}" class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>{{$order_tbl->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    @if( !empty($dfrom) or  !empty($dto))               
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('makecommand/search_order')}}";
            location.replace(url+"?dfrom=<?php echo $dfrom?>&dto=<?php echo $dto?>&search_by="+selectby+"&search="+select);
        }
        </script>
    @else                            
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('makecommand/search_order')}}";
            location.replace(url+"?search_by="+selectby+"&search="+select);
        }
        </script>
    @endif

@endsection