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
                            <div class="col-md-5 col-12 left plussrc">
                                <a href="{{URL('makecommand/add_category')}}" class="btn btn-warning">
                                    Add a new Category +
                                </a>
                            </div>

                            <form method="get" action="{{URL('makecommand/category')}}">
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
                            @if( ! empty($search))                            
                            <div class="col-md-12 col-12">
                                <div class="alert alert-primary" role="alert">
                                    You Have Searched for: <b>{{$search}}</b>
                                </div>
                            </div>
                            @endif


                        <div class="table-responsive">
                            <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                                {{$category_tbl->links()}}
                                <thead>
                                    <tr>
<!-- Sorting -->
<th class="sort_th">
    <form method="get" action="{{URL('makecommand/sort_category')}}" class="sort_form">

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

    <form method="get" action="{{URL('makecommand/sort_category')}}" class="sort_form">

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
<th><b>Icon</b></th><th class="sort_th">
    <form method="get" action="{{URL('makecommand/sort_category')}}" class="sort_form">

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

    <form method="get" action="{{URL('makecommand/sort_category')}}" class="sort_form">

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

<th><b>Parent_id</b></th>
<th class="sort_th">
    <form method="get" action="{{URL('makecommand/sort_category')}}" class="sort_form">

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

    <form method="get" action="{{URL('makecommand/sort_category')}}" class="sort_form">

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
<th><b>Action</b></th>
                                    </tr>

<!-- Searching -->
                                <tr>

<th>
    <form method="get" action="{{URL('makecommand/search_category')}}" class="sort_form">

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
    <form method="get" action="{{URL('makecommand/search_category')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif
        <input type="hidden" name="search_by" value="name">
        <input type="text" name="search" class="small_src_in">
    </form>
</th>
<th>
    <form method="get" action="{{URL('makecommand/search_category')}}" class="sort_form">

        @if( !empty($dfrom) or  !empty($dto))
        <input type="hidden" name="dfrom" value="{{$dfrom}}">
        <input type="hidden" name="dto" value="{{$dto}}">
        @endif
        <input type="hidden" name="search_by"  id="selectredirectserviceby" value="parent_id">
        <select name="search" class="small_src_in" id="selectredirectservice" onchange="redirectservice()">
            <option></option>
            <option value="0">root</option>
            @foreach($d_parent_id as $d_parent_id)
                    <?php $parent_id="{$d_parent_id->parent_id}";?>
                    @php
                        $parent_name=App\admin\category_tbl::all()->where("id",$parent_id);
                    @endphp


                        @foreach($parent_name as $parent_name)
                            <option value="<?php echo $parent_id?>">
                                {{$parent_name->name}}
                            </option>
                        @endforeach
            @endforeach
        </select>
    </form>
</th>
<th>-------</th>
<th>-------</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($category_tbl as $data)
                                    <tr>
                                        <td>
                                            <b>{{$loop->iteration}}-{{$data->id}}</b>
                                        </td>
                                        <td>
                                            <img src="{{URL('public/allfiles/img')}}/{{$data->icon}}" class="tbl_icn">
                                        </td>
                                        <td>{{$data->name}}</td>
                                        <td>
                                        <?php $parent_id="{$data->parent_id}";?>
                                        @if($parent_id==0)
                                            root
                                        @else
                                            @php 
                                             $pi= DB::table('category_tbl')->select('name','parent_id')->where("id",$parent_id)->get();
                                            @endphp

                                            @foreach($pi as $data2)
                                                {{$data2->name}}
                                            @endforeach

                                        @endif


                                        </td>
                                        <td>
                                            <?php $status="{$data->status}";?>
                                            @if($status==1)
                                                <span class="enable">Enable</span>
                                            @elseif($status==0)
                                                <span class="disable">Disable</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{URL('makecommand/edit_category?id')}}={{$data->id}}" class="editBtn edbtn">Edit</a>
                                            <a href="javascript:" class="btn-mini deleteRecord deleteBtn edbtn" data-toggle="modal" data-target="#d{{$data->id}}">Delete</a>
                                        </td>

<div class="modal fade" id="d{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete??? {{$loop->iteration}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete {{$loop->iteration}}no Category???
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{URL('makecommand/delete_category?id')}}={{$data->id}}" type="button" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>


                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>{{$category_tbl->links()}}
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
          var url="{{URL('makecommand/search_category')}}";
            location.replace(url+"?dfrom=<?php echo $dfrom?>&dto=<?php echo $dto?>&search_by="+selectby+"&search="+select);
        }
        </script>
    @else                            
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('makecommand/search_category')}}";
            location.replace(url+"?search_by="+selectby+"&search="+select);
        }
        </script>
    @endif

@endsection