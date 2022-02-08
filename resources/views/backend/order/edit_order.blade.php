@extends('backend.master.backend_master')
@section('title','Dashboard')


    @section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('resources/backend/assets/extra-libs/multicheck/multicheck.css')}}">
        <link href="{{asset('resources/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
        <style type="text/css">
            table {
                background: #fff !important;
                border: 3px solid #d8d8d8;
            }
        </style>
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
                            <li class="breadcrumb-item active" aria-current="page">Add order</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if (session('status'))
            <div class="col-md-12 col-12">
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            </div>
            @endif
            <div class="col-md-8 col-12">
                <div class="card widget-box">
                    <div class="card-header  widget-title">
                        <h5 class="card-title">Order {{$id->order_code}} details</h5>
                    </div>
                    <div class="card-body">
                        @if($id->gift == false)
                        <div class="col-md-6 col-12 inblc">
                        @elseif($id->gift == true)
                        <div class="col-md-4 col-12 inblc">
                        @endif
                            <p class="title2 m-t20">
                                Customer Details
                                @if($id->gift == false)
                                    / Billing Address
                                @endif
                            </p>
                            <p>Name: {{$id->name}}</p>
                            <p>
                                Email: <a href="mailto:{{$id->email}}">{{$id->email}}</a>
                            </p>
                            <p>
                                Phone: <a href="tel:{{$id->phone}}">{{$id->phone}}</a>
                            </p>
                            <p>
                                Alt Phone: <a href="tel:{{$id->alt_phone}}">{{$id->alt_phone}}</a>
                            </p>
                            <p>Address: {{$id->address}}</p>
                            <p>Police Station: {{$id->police_station}}</p>
                            <p>District: {{$id->district}}</p>
                        </div>

                        <!-- Gift Address -->
                        @if($id->gift == true)
                        <div class="col-md-4 col-12 inblc">
                            <p class="title2 m-t20">
                                Gift Details / Billing Address
                            </p>
                            <p>Address: {{$id->gift_address}}</p>
                            <p>Police Station: {{$id->gift_police_station}}</p>
                            <p>District: {{$id->gift_district}}</p>
                        </div>
                        @endif


                        <!-- Shipping Address -->
                        @if($id->gift == false)
                        <div class="col-md-6 col-12 inblc">
                        @elseif($id->gift == true)
                        <div class="col-md-4 col-12 inblc">
                        @endif
                            <p class="title2 m-t20">
                                Shipping Address
                            </p>
                            @php
                                $shipping_tbl=App\admin\shipping_tbl::find($id->shipping_id);
                            @endphp

                            <p>Shipping District: {{$id->address}}</p>
                            <p>Price: {{$id->shipping_price}} ৳</p>
                            <p>Time: {{$id->shipping_time}} days</p>

                            @if($id->gift == false)
                                <p>
                                    Full Address: {{$id->address}}, {{$id->police_station}}, {{$id->district}}
                                </p>
                            @elseif($id->gift == true)
                                <p>
                                    Full Address: {{$id->gift_address}}, {{$id->gift_police_station}}, {{$id->gift_district}}
                                </p>
                            @endif
                            
                            <p>
                                Phone: <a href="tel:{{$id->phone}}">{{$id->phone}}</a>
                            </p>
                            <p>
                                Alt Phone: <a href="tel:{{$id->alt_phone}}">{{$id->alt_phone}}</a>
                            </p>
                        </div>


                        <div class="col-md-4 col-12 inblc">
                            <p class="title2 m-t20">
                                User details
                            </p>
                            @php
                                $customer=App\User::findorFail($id->user_id);
                            @endphp
                            <p>Name: {{$customer->name}}</p>
                            <p>
                                Email: <a href="mailto:{{$customer->email}}">{{$customer->email}}</a>
                            </p>
                            <p>User role: {{$customer->usertype}}</p>
                            <p>User id: {{$customer->id}}</p>
                            <p>Registered date: 
                            </p>
                        </div>


                    <div class="col-md-4 col-12 inblc">
                        <p class="title2 m-t20">
                            কাস্টমার নোট
                        </p>
                        <p><?php echo $des="{$id->description}";?></p>
                    </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card widget-box">
                    <div class="card-header  widget-title">Order Action</div>
                    <div class="card-body">
                        <p>Currently this order is on </p>
                        <p><span class="btn_cos {{$id->status}}">{{$id->status}}</span></p>
                        @if($id->status=="Complete" || $id->status=="Cancel")
                        @else
                        <form method="post" action="update_order">
                            {{csrf_field()}}
                            <input type="hidden" name="order_id" value="{{$id->id}}">
                            <input type="hidden" name="id" value="{{$id->id}}">
                            <label class="m-t40">Order Action</label>
                            <select name="status" class="form-control" required>
                                <option></option>
                                <option value="Pending order">Pending order</option>
                                <option value="Processing order">Processing order</option>
                                <option value="Picked by courier">Picked by courier</option>
                                <option value="On the way">On the way</option>
                                <option value="Complete">Complete</option>
                                <option value="Cancel">Cancel</option>
                            </select>
                            <input type="submit" value="update" class="btn btn-success m-t20">
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <div class="card widget-box">
                    <div class="card-header  widget-title">
                        <div class="cs_card_title">
                            পণ্য
                        </div>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table">
                          <tbody>

                            <?php 
                              $total_loop=0; 
                              $t_g_price=0;
                              $order_detail_tbl=App\admin\order_detail_tbl::where('order_id',$id->id)->get();
                            ?>

                            @foreach($order_detail_tbl as $data)
                            <?php 
                              $total_loop=$total_loop+1;
                              $loop="{$loop->iteration}";
                              $product_id="{$data->product_id}";
                              $color="{$data->color}";
                              $size="{$data->size}";
                              $quantity="{$data->quantity}";
                                $product_details=App\admin\product_tbl::find($product_id);
                                $product_attri_image=$product_details->image;






                                if( !empty($color) && !empty($size)){

                                    $product_attri_price=App\admin\product_attri_tbl::where('product_id', $product_id)->where('color', $color)->where('size', $size)->first()->price;
                                }
                                else{
                                    $product_attri_price="{$product_details->price}";
                                }

                            ?>

                                <tr>
                                  <th scope="row"><?php echo $loop;?></th>
                                  
                                  <td>
                                    <?php $name="{$product_details->name}";$name = str_replace(' ', '-', $name);?>

                                    <a href="{{URL('')}}/product/<?php echo $name?>/{{$product_details->id}}">
                                        <div class="cart_img_w">
                                            <img class="eo_image" src="{{URL('public/allfiles/img/product/thumb')}}/<?php echo $product_attri_image;?>">
                                        </div>
                                     </a>
                                  </td>
                                  <td>
                                    <div class="cart_name_w">
                                        <a href="{{URL('')}}/product/<?php echo $name?>/{{$product_details->id}}">
                                        <p class="cart_pname">
                                            {{$product_details->name}}
                                        </p>
                                        </a>
                                        <p class="cart_p_attr">
                                            <b>size:</b>{{$data->size}}, 
                                            <b>color:</b>
                                            {{$data->color}}
                                            <span class="swatch" style="background-color:{{$data->color}}">
                                            </span>
                                        </p>
                                    </div>
                                  </td>

                                  <td>
                                    <h4 class="product-price">
                                        <?php
                                            echo $product_attri_price;
                                        ?>

                                        <del class="product-old-price">
                                            ৳{{$product_details->before_discount}}
                                        </del>
                                    </h4>
                                  </td>

                                  <td>{{$data->quantity}}</td>

                                  <td>
                                    <?php 
                                        echo $sum_price=$quantity*$product_attri_price;
                                        $t_g_price=$t_g_price+$sum_price;
                                    ?>
                                        
                                    </td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>Total</h5>
                                    </td>
                                    <td>
                                        <h4 id="total_sumup_taka">
                                            ৳<?php echo $t_g_price?>
                                        </h4>
                                    </td>
                                    <td></td>
                                </tr>
                          </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection

@section('script')

                <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>

@endsection

