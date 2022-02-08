@extends('dealer.master.dealer_master')
@section('title','Dealer Order List')
    @section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('resources/backend/assets/extra-libs/multicheck/multicheck.css')}}">
        <link href="{{asset('resources/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
    @endsection
@section('body')



<style type="text/css">
    .cs_card {
    background: white;
    padding: 61px 51px;
    }

    table {
        border: 2px solid #ddd;
    }
</style>

<div class="page-wrapper">
    
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="ml-auto text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dealer Order List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success col-md-12" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            

@php
    $Auth_id=Auth::User()->id;
    $user=App\User::findOrFail($Auth_id);
@endphp


    <div class="row col-md-12">
        <div class="col-md-12 order_prf_w">

            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="cs_card">
                <div class="cs_card_body table-responsive">
                    <table class="table table-striped shopping-summery">
                        <tr class="main-hading text-center">
                            <th colspan="5" class="text-center">
                                <i class="w-icon-orders"></i> Orders History
                            </th>
                        </tr>
                        <tr class="main-hading2">
                            <th>Order Id</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>

                        @foreach($order_tbl as $data)
                        <tr>
                            <td>{{$data->order_code}}</td>
                            <td>{{$data->created_at->format('d-M-Y')}}</td>
                            <td><span class="{{$data->status}}">{{$data->status}}</span></td>
                            <td>
                                <?php //echo $total_price=$data->product_price+$data->shipping_price;?>
                                {{$data->product_price}}
                            </td>
                            <td>
                                <a href="{{URL('dealer-dashboard/show_order')}}?id={{$data->id}}" class="btn btn-primary">Show</a>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                    {{$order_tbl->links()}}
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

