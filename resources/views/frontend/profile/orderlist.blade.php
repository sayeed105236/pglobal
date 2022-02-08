@extends('frontend.master.master')
    @section('css')
        <style type="text/css">
            td {
                text-align: center;
            }
            th {
                text-align: center;
            }
        </style>
    @endsection
@section('body')
@include('frontend.profile.profile_master')


@php
    $Auth_id=Auth::User()->id;
    $user=App\User::findOrFail($Auth_id);
@endphp


    <div class="row">
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
                                <a href="{{URL('profile/show_order')}}?id={{$data->id}}" class="btn btn-primary">Show</a>
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
    <!-- End of PageContent -->
</main>
<!-- End of Main -->


@endsection
