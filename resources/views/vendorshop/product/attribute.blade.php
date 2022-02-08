@extends('vendorshop.master.vendorshop_master')
@section('title','add product')
@section('body')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/backend/select2/dist/css/select2.min.css')}}">
    <style type="text/css">
    .select2-container--default .select2-selection--multiple {
        line-height: 27px;
        border-color: #e9ecef;
        height: 40px;
        color: #3e5569;
        background-color: white;
        border: 1px solid #aaa;
        border-radius: 4px;
        cursor: text;
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        min-height: 32px;
        user-select: none;
        -webkit-user-select: none;
        }
        .select2-container--classic .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        background-color: #2255a4;
        border-color: #2255a4;
        color: #fff;
    }.select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #e4e4e4;
        border: 1px solid #aaa;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
    li.select2-selection__choice {
        background: #2255a4 !important;
    }
    .control-label {
        text-align: left;
    }
    .controls input {
        width: 100%;
    }
</style>
@endsection

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="ml-auto text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{URL('vendor-dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Attribute</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger col-md-12" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col-md-5 col-sm-12 col-12 fit_inblc">
                <div class="card widget-box">
                    <div class="card-header  widget-title">
                        <h5 class="card-title">Product name: {{$product_tbl->name}}</h5>
                    </div>
                    <div class="card-body">

                        <div class="control-group col-md-12 col-12">
                            <div class="fit_inblc">
                                <img src="{{URL('public/allfiles/img/product')}}/{{$product_tbl->main_image}}" class="prdct_img">
                            </div>
                            <div class="fit_inblc">
                                <p class="attr_pd">Product id: 
                                    <b>{{$product_tbl->id}}</b>
                                </p>
                                <p class="attr_pd">Product code: 
                                    <b>{{$product_tbl->code}}</b>
                                </p>
                            </div>
                        </div>

                        <hr><hr>

                    <form autocomplete="off" action="{{URL('vendor-dashboard/insert_attribute')}}" method="post" enctype='multipart/form-data'>
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$product_tbl->id}}">
                        <div class="control-group col-md-12 col-12">
                            <h3 class="control-label col-md-12 col-12">
                                Add Attribute:
                            </h3>
                        </div>

                        <div class="control-group col-md-6 col-6 fit_inblc">
                            <input type="text" name="color" class="" placeholder="color">
                        </div>

                        <div class="control-group col-md-6 col-6 fit_inblc">
                            <input type="text" name="size" class="" placeholder="size">
                        </div>

                        <div class="control-group col-md-6 col-6 fit_inblc">
                            <input type="number" name="price" class="" placeholder="price">
                        </div>

                        <div class="control-group col-md-6 col-6 fit_inblc">
                            <input type="number" name="stock" class="" placeholder="stock">
                        </div>

                         <div class="control-group col-md-12 col-12">
                              <div class="show_img_in_input_w">
                                <input type="submit" value="save" class="btn btn-success">
                              </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>




            <div class="col-md-7 col-sm-12 col-12 fit_inblc">
                <div class="card widget-box">
                    <div class="card-header  widget-title">
                        <h5 class="card-title">Add product</h5>
                    </div>
                    <div class="card-body table-responsive">

                        
                        <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                            <thead>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($product_attri_tbl as $data)
                                <tr>
                                <form autocomplete="off" action="{{URL('vendor-dashboard/update_attribute')}}" method="post" enctype='multipart/form-data'>
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input type="hidden" name="product_id" value="{{$data->product_id}}">

                                    <td>
                                        <input type="text" name="color" value="{{$data->color}}" class="in_min_w">
                                    </td>
                                    <td>
                                        <input type="text" name="size" value="{{$data->size}}" class="in_min_w">
                                    </td>
                                    <td>
                                        <input type="text" name="price" value="{{$data->price}}" class="in_min_w">
                                    </td>
                                    <td>
                                        <input type="text" name="stock" value="{{$data->stock}}" class="in_min_w">
                                    </td>
                                    <td>
                                       <input type="submit" class="btn btn-success" value="Update" placeholder=""> 

                                       <a class="btn btn-danger" href="{{URL('vendor-dashboard/delete_attribute?id=')}}{{$data->id}}">
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


    @section('script')
        <script type="text/javascript">
            function main_image_url(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#main_image').attr('src', e.target.result);};
              reader.readAsDataURL(input.files[0]);}}


            function edit_image_url(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#edit_image').attr('src', e.target.result);};
              reader.readAsDataURL(input.files[0]);}}
        </script>
    @endsection

@endsection

