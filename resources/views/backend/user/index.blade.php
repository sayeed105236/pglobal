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
                            <li class="breadcrumb-item"><a href="{{URL('makecommand')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                        <h5 class="card-title">Users Datatable</h5>
                    </div>
                    <div class="card-body">
                            <div class="col-md-12 col-12 text-center plussrc">
                                <a href="{{URL('makecommand/user')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Refresh</a>
                            </div>
                            <br>
                            <br>


                            <form autocomplete="off" method="get" action="{{URL('makecommand/user')}}">
                                <div class="col-md-12 col-12 text-center">
                                <b class="text-center">Search Users by registration Date</b>
                                    <div class="col-md-4 col-5 fromto fromtoA">
                                        <label>From</label>
                                        <input type="date" name="dfrom" class="form-" value="{{$dfrom}}">
                                    </div>
                                    <div class="col-md-4 col-5 fromto fromtoA">
                                        <label>To</label>
                                        <input type="date" name="dto" class="form-" value="{{$dto}}">
                                    </div>
                                    <div class="col-md-4 col-5 fromto fromtoA">
                                    <button class="col-md-2 col-4 btn btn-primary fromto">
                                        filter
                                    </button>
                                    </div>
                                </div>
                            </form>
                            <br>

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
                                {{$User->links()}}
                                <thead>
                                    <tr>
<!-- Sorting -->
<th class="sort_th">
    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

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

    <b>ID</b>

    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

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
<th><b>Icon</b></th>
<th class="sort_th">
    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

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

    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

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
    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif

        @if( !empty($search))
        <input type="hidden" name="search_by" value="{{$search_by}}">
        <input type="hidden" name="search" value="{{$search}}">
        @endif

        <input type="hidden" name="orderby" value="usertype">
        <input type="hidden" name="ordertype" value="ASC">
        <button class="sort_btn" type="submit">
                        <i class="fas fa-sort-amount-up-alt"></i>
        </button>
    </form>

    <b>Usertype</b>

    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif

        @if( !empty($search))
        <input type="hidden" name="search_by" value="{{$search_by}}">
        <input type="hidden" name="search" value="{{$search}}">
        @endif
        <input type="hidden" name="orderby" value="usertype">
        <input type="hidden" name="ordertype" value="DESC">
        <button class="sort_btn" type="submit">
            <i class="fas fa-sort-amount-down"></i>
        </button>
    </form>
</th>
<th class="sort_th">
    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

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

    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

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
    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif

        @if( !empty($search))
        <input type="hidden" name="search_by" value="{{$search_by}}">
        <input type="hidden" name="search" value="{{$search}}">
        @endif

        <input type="hidden" name="orderby" value="referral_code">
        <input type="hidden" name="ordertype" value="ASC">
        <button class="sort_btn" type="submit">
                        <i class="fas fa-sort-amount-up-alt"></i>
        </button>
    </form>

    <b>Referral_code</b>

    <form autocomplete="off" method="get" action="{{URL('makecommand/sort_user')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif

        @if( !empty($search))
        <input type="hidden" name="search_by" value="{{$search_by}}">
        <input type="hidden" name="search" value="{{$search}}">
        @endif
        <input type="hidden" name="orderby" value="referral_code">
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
    <form autocomplete="off" method="get" action="{{URL('makecommand/search_user')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif
        <input type="hidden" name="search_by" value="id">
        <input type="number" name="search" class="small_src_in">
    </form>
</th>
<th></th>
<th>
    <form autocomplete="off" method="get" action="{{URL('makecommand/search_user')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif
        <input type="hidden" name="search_by" value="name">
        <input type="text" name="search" class="small_src_in">
    </form>
</th>
<th>
    <form autocomplete="off" method="get" action="{{URL('makecommand/search_user')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif
        <input type="hidden" name="search_by"  id="selectredirectserviceby" value="usertype">
        <select name="search" class="small_src_in" id="selectredirectservice" onchange="redirectservice()">
            <option></option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="vendor">Vendor</option>
            <option value="affiliate">Affiliate</option>
            <option value="dealer">Dealer</option>
        </select>
    </form>
</th>
<th>
    <a href="{{URL('makecommand/search_user?search_by=status&search=1')}}" class="enable">Active</a>
    <a href="{{URL('makecommand/search_user?search_by=status&search=0')}}" class="disable">Deactive</a>
</th>
<th>
    <form autocomplete="off" method="get" action="{{URL('makecommand/search_user')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif
        <input type="hidden" name="search_by" value="referral_code">
        <input type="text" name="search" class="small_src_in">
    </form>
</th>
<th>-------</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{$User}}
                                    @foreach($User as $data)
                                    <tr>
                                        <td>
                                            <b>{{$data->id}}</b>
                                        </td>
                                        <td>
                                            <img src="{{URL('public/allfiles/img/pp')}}/{{$data->pp}}" class="tbl_icn">
                                        </td>
                                        <td>{{$data->name}}</td>
                                        <td>
                                            @if($data->usertype == "admin")
                                                <option value="admin">Admin</option>
                                            @elseif($data->usertype == "affiliate")
                                                <option value="affiliate">Affiliate</option>
                                            @elseif($data->usertype == "vendor")
                                                <option value="vendor">Vendor</option>
                                            @elseif($data->usertype == "dealer")
                                                <option value="dealer">Dealer</option>
                                            @elseif($data->usertype == "user")
                                                <option value="user">User</option>
                                            @endif
                                        </td>
                                        <td>
                                            <?php $status="{$data->status}";?>
                                            @if($status=="1")
                                                <span class="enable">Activate</span>
                                            @elseif($status=="0")
                                                <span class="disable">Deactivate</span>
                                            @endif

                                            @if($data->approve == 0)
                                                &nbsp && &nbsp
                                                <span class="pending">Pending</span>
                                            @endif

                                        </td>
                                        <td>
                                            <b>{{$data->referral_code}}</b>
                                        </td>
                                        <td>
                                            <a href="{{URL('makecommand/edit_user?user_code')}}={{$data->id}}" class="btn btn-primary">Edit</a>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>{{$User->links()}}
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
          var url="{{URL('makecommand/search_user')}}";
            location.replace(url+"?dfrom=<?php echo $dfrom?>&dto=<?php echo $dto?>&search_by="+selectby+"&search="+select);
        }
        function redirectservice2() {
          var selectby = document.getElementById("selectredirectserviceby2").value;
          var select = document.getElementById("selectredirectservice2").value;
          var url="{{URL('makecommand/search_user')}}";
            location.replace(url+"?dfrom=<?php echo $dfrom?>&dto=<?php echo $dto?>&search_by="+selectby+"&search="+select);
        }
        </script>
    @else                            
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('makecommand/search_user')}}";
            location.replace(url+"?search_by="+selectby+"&search="+select);
        }
        function redirectservice2() {
          var selectby = document.getElementById("selectredirectserviceby2").value;
          var select = document.getElementById("selectredirectservice2").value;
          var url="{{URL('makecommand/search_user')}}";
            location.replace(url+"?search_by="+selectby+"&search="+select);
        }
        </script>
    @endif

@endsection