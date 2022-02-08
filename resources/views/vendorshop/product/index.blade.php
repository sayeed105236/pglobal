@extends('vendorshop.master.vendorshop_master')
@section('title','Product')

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
                        <h5 class="card-title">Product Datatable</h5>
                    </div>
                    <div class="card-body">
                            <div class="col-md-5 col-12 left plussrc">
                                <a href="{{URL('vendor-dashboard/add_product')}}" class="btn btn-warning">
                                    Add a new product +
                                </a>
                            </div>
                            <div class="col-md-5 col-12 left plussrc">
                                <a href="{{URL('vendor-dashboard/product')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Refresh</a>
                            </div>

                            <form method="get" action="{{URL('vendor-dashboard/product')}}">
                                <div class="col-md-4 col-5 fromto fromtoA">
                                    <label>From</label>
                                    <input type="date" name="dfrom" class="form-" value="{{$dfrom}}">
                                </div>
                                <div class="col-md-4 col-5 fromto fromtoA">
                                    <label>To</label>
                                    <input type="date" name="dto" class="form-" value="{{$dto}}">
                                </div>
                                <div class="col-md-2 col-5 fromtoA">
                                    <button class="btn btn-primary fromto">
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
                            <table id="zero_config" class="table table-bordered table-striped text-center dataTable" width="100%" cellspacing="0">
                                {{$product_tbl->links()}}
                                <thead>
                                    <tr>
                                        <!-- Sorting -->
                                        <th class="sort_th"><b>S.L</b></th>
                                        <th><b>Image</b></th>
                                        <th class="sort_th">
                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

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

                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

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
                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">
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

                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

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
                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

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

                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

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

                                        <th><b>attribute</b></th>
                                        <th class="sort_th">
                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

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

                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

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
                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif

                                                <input type="hidden" name="orderby" value="approve">
                                                <input type="hidden" name="ordertype" value="ASC">
                                                <button class="sort_btn" type="submit">
                                                    <i class="fas fa-sort-amount-up-alt"></i>
                                                </button>
                                            </form>

                                            <b>Approve</b>

                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

                                                @if( !empty($dfrom) or  !empty($dto))
                                                <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                                <input type="hidden" name="dto" value="{{$dto}}">
                                                @endif

                                                @if( !empty($search))
                                                <input type="hidden" name="search_by" value="{{$search_by}}">
                                                <input type="hidden" name="search" value="{{$search}}">
                                                @endif
                                                <input type="hidden" name="orderby" value="approve">
                                                <input type="hidden" name="ordertype" value="DESC">
                                                <button class="sort_btn" type="submit">
                                                    <i class="fas fa-sort-amount-down"></i>
                                                </button>
                                            </form>
                                        </th>



                                        <th class="sort_th">
                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

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

                                            <form method="get" action="{{URL('vendor-dashboard/sort_product')}}" class="sort_form">

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
                                        <th><b>Action</b></th>
                                    </tr>

                                    <!-- Searching -->
                                <tr>
                                    <th></th>
                                    <th>-------</th>
                                    <th>
                                        <form method="get" action="{{URL('vendor-dashboard/search_product')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="code">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" action="{{URL('vendor-dashboard/search_product')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="name">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>
                                        <form method="get" action="{{URL('vendor-dashboard/search_product')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="price">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>-------</th>
                                    <th>-------</th>
                                    <th>-------</th>
                                    <th>
                                        <form method="get" action="{{URL('vendor-dashboard/search_product')}}" class="sort_form">

                                            @if( !empty($dfrom) or  !empty($dto))
                                            <input type="hidden" name="dfrom" value="{{$dfrom}}">
                                            <input type="hidden" name="dto" value="{{$dto}}">
                                            @endif
                                            <input type="hidden" name="search_by" value="category">
                                            <input type="text" name="search" class="small_src_in">
                                        </form>
                                    </th>
                                    <th>-------</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($product_tbl as $data)
                                    <tr>
                                        <td>
                                            <b>
                                                {{$loop->iteration}}
                                            </b>
                                        </td>
                                        <td>
                                            <img src="{{URL('public/allfiles/img/product/thumb')}}/{{$data->main_image}}" class="prdct_img">
                                        </td>
                                        <td>
                                            <b>
                                                {{$data->code}}
                                            </b>
                                        </td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->price}}</td>

                                        <td class="txt_c">
                                            <a href="{{URL('vendor-dashboard/attribute?id=')}}{{$data->id}}" class="cs_attribute">
                                                Attribute
                                            </a>
                                        </td>
                                        <td class="txt_c">
                                            <?php $status="{$data->status}";?>
                                            @if($status==true)
                                                <p class="cs_success_p">
                                                    <span class="cs_success">
                                                        Publish
                                                    </span>
                                                </p>
                                            @else
                                                <p class="cs_unsucces_p">
                                                    <span class="cs_unsucces">
                                                        Hidden
                                                    </span>
                                                </p>
                                            @endif
                                        </td>
                                        <td class="txt_c">
                                            <?php $approve="{$data->approve}";?>
                                            @if($approve==true)
                                                <p class="cs_success_p">
                                                    <span class="cs_success">
                                                        Approved
                                                    </span>
                                                </p>
                                            @else
                                                <p class="cs_unsucces_p">
                                                    <span class="cs_unsucces">
                                                        Not approved
                                                    </span>
                                                </p>
                                            @endif
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
                                            <a href="{{URL('vendor-dashboard/edit_product?id')}}={{$data->id}}" class="btn btn-primary">Edit</a>


                                            <a href="javascript:" class="btn btn-danger" data-toggle="modal" data-target="#d{{$data->id}}">Delete</a>

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
                                                    Do you really want to delete {{$loop->iteration}}no product???
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <a href="{{URL('vendor-dashboard/delete_product?id')}}={{$data->id}}" type="button" class="btn btn-danger">Delete</a>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>{{$product_tbl->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@endsection

