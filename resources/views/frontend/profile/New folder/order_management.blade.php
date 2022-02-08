@extends('frontend.master.master')
    @section('css')
    @endsection
@section('body')




@include('frontend.profile.profile_master')

@php $Auth_id=Auth::User()->id;$user=App\User::findOrFail($Auth_id); @endphp


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
                            <th colspan="5" class="text-center">আপনার পণ্যের জন্য অর্ডারগুলো</th>
                        </tr>
                        <tr class="main-hading2">
                            <th>Order Id</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        @foreach($order_tbl as $auth_order)
                        <tr>
                            <td>{{$auth_order->order_code}}</td>
                            <td>{{$auth_order->created_at->format('d-M-Y')}}</td>
                            <td><span class="{{$auth_order->status}}">{{$auth_order->status}}</span></td>
                            <td>{{$auth_order->product_price}}</td>
                            <td>
                                <a href="{{URL('profile/edit_order_management')}}?id={{$auth_order->id}}" class="btn btn-primary">edit</a>
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

@endsection
