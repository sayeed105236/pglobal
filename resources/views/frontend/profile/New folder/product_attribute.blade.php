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
                <div class="alert alert-danger col-md-12" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col-md-5 col-sm-12 col-12 fit_inblc">
                <div class="card widget-box att_card">
                    <div class="card_main_heading">
                        <h5 class="card-title">Product name: {{$product_tbl->name}}</h5>
                    </div>
                    <div class="card-body">

                        <div class="control-group row att_p_img_w">
                            <div class="col-md-7 col-12">
                                <img src="{{URL('public/allfiles/img/product/thumb')}}//{{$product_tbl->main_image}}" class="att_p_img">
                            </div>
                            <div class="col-md-5 col-12">
                                <p class="attr_pd">Product id: 
                                    <b>{{$product_tbl->id}}</b>
                                </p>
                                <p class="attr_pd">Product code: 
                                    <b>{{$product_tbl->code}}</b>
                                </p>
                            </div>
                        </div>

                    <form autocomplete="off" action="{{URL('profile/insert_attribute')}}" method="post" enctype='multipart/form-data' class="row att_frm">
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$product_tbl->id}}">
                        <div class="control-group col-md-12 col-12">
                            <h3 class="control-label">
                                Add Attribute:
                            </h3>
                        </div>

                        <div class="control-group col-md-6 col-12 fit_inblc">
                            <input type="text" name="color" class="" placeholder="color">
                        </div>

                        <div class="control-group col-md-6 col-12 fit_inblc">
                            <input type="text" name="size" class="" placeholder="size">
                        </div>

                         <div class="col-md-12 col-12 text-center">
                            <button type="submit" class="btn btn-danger">Save</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>




            <div class="col-md-7 col-sm-12 col-12 fit_inblc">
                <div class="card widget-box att_card">
                    <div class="card_main_heading">
                        <h5 class="card-title">Product Attribute</h5>
                    </div>
                    <div class="card-body table-responsive">

                        
                        <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                            <thead>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($product_attri_tbl as $data)
                                <tr>
                                <form autocomplete="off" action="{{URL('profile/update_attribute')}}" method="post" enctype='multipart/form-data'>
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input type="hidden" name="product_id" value="{{$data->product_id}}">

                                    <td>
                                        <input type="text" name="color" value="{{$data->color}}" class="in_min_w">
                                    </td>
                                    <td>
                                        <input type="text" name="size" value="{{$data->size}}" class="in_min_w">
                                    </td>
                                    <td class="row">
                                        <button type="submit" class="btn-success col-md-6 col-6" >
                                            Update
                                        </button>

                                       <a class="btn-danger col-md-6 col-6" href="{{URL('profile/delete_attribute?id=')}}{{$data->id}}">
                                           Delete
                                       </a>
                                    </td>
                                </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


@endsection
