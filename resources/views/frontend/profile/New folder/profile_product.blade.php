@extends('frontend.master.master')
    @section('css')
    @endsection
@section('body')



@include('frontend.profile.profile_master')

@php
    $Auth_id=Auth::User()->id;
    $user=App\User::findOrFail($Auth_id);
@endphp



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
                                <a href="{{URL('profile/add_product')}}" class="btn btn-primary">
                                    Add a new product +
                                </a>
                            </div>
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
                                    <tr class="main_heading">
                                        <!-- Sorting -->
                                        <th class="sort_th"><b>S.L</b></th>
                                        <th><b>Image</b></th>
                                        <th class="sort_th"><b>Code</b></th>
                                        <th class="sort_th"><b>Name</b></th>
                                        <th class="sort_th"><b>Price</b></th>
                                        <th><b>attribute</b></th>
                                        <th class="sort_th"><b>Status</b></th>
                                        <th class="sort_th"><b>Approve</b></th>
                                        <th><b>Action</b></th>
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
                                        <td><b>{{$data->code}}</b></td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->price}}</td>

                                        <td class="txt_c">
                                            <a href="{{URL('profile/product_attribute?id=')}}{{$data->id}}" class="cs_attribute">
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
                                            <a href="{{URL('profile/edit_product?id')}}={{$data->id}}" class="btn btn-primary">Edit</a>
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
