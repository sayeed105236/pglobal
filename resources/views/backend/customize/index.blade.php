@extends('backend.master.backend_master')
@section('title','Dashboard')

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('resources/backend/assets/extra-libs/multicheck/multicheck.css')}}">
        <link href="{{asset('resources/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
        
    @endsection
@section('body')


<style type="text/css">
    .modal-dialog {
    max-width: 80%;
    padding: 0px !important;
}
.modal {
    padding: 0px !important;
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
            


















            <div class="card col-md-12 col-12 widget-box">
                <div class="card-header primary">
                    <h5 class="card-title">Students Placed at</h5>
                </div>
                
                            <div class="col-md-12 col-12 left plussrc">
                                <!-- <a href="javascript:" class="btn btn-warning" class="btn-mini deleteRecord deleteBtn edbtn" data-toggle="modal" data-target="#adding_shipping">Add shipping</a> -->

                                <div class="modal fade" id="adding_shipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            Add shipping
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form autocomplete="off" action="{{URL('makecommand/insert_shipping')}}" method="post" enctype='multipart/form-data'>
                                      {{csrf_field()}}
                                      <div class="modal-body">
                                        
                                        <div class="control-group col-md-12 col-12">
                                            <label class="col-md-12 col-12">
                                                Shipping zone:
                                            </label>
                                            <div class="controls col-md-12 col-12">
                                              <input type="text" required class="form-control" name="district" >
                                            </div>
                                        </div>
                                        <div class="control-group col-md-12 col-12">
                                            <label class="col-md-12 col-12">
                                               Cost:
                                            </label>
                                            <div class="controls col-md-12 col-12">
                                              <input type="number" required class="form-control" name="price" >
                                            </div>
                                        </div>
                                        <div class="control-group col-md-12 col-12">
                                            <label class="col-md-12 col-12">
                                                Time:
                                            </label>
                                            <div class="controls col-md-12 col-12">
                                              <input type="text" required class="form-control" name="time" >
                                            </div>
                                        </div>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Add</button>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.l.</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Btn</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>

@php
  $raw_tbl= App\admin\raw_tbl::where('type', "home")->where("section","home small feature")->get();
@endphp  


                            @foreach($raw_tbl as $data)
                            <tr>
                                <td>
                                    <b>{{$loop->iteration}}</b>
                                </td>
                                <td>
                                    <img id="show1" class="show_img_in_input" src="{{URL('public/allfiles/img/customize')}}/{{$data->image}}" style="width:310px;height: 444px;">
                                </td>
                                <td><?php echo "{$data->description}";?></td>
                                <td>
                                    <a href="{{$data->url}}" class="btn btn-success">{{$data->btn}}</a>
                                </td>
                                <td>
                                    <a href="javascript:" class="btn btn-primary" data-toggle="modal" data-target="#h{{$data->id}}">Edit</a>

                                    <div class="modal fade" id="h{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body row">

<!-- Home Small Feature -->
<?php $id="{$data->id}";?>
@php
    $customize_tbl= App\admin\raw_tbl::where('id', $id)->get();
    $customize_tbl_count= App\admin\raw_tbl::where('id',$id)->count();
@endphp
<div class="col-md-12 col-12">
    <div class="card widget-box">
        <div class="card-header  widget-title">
            <h5 class="card-title">Home Small Feature image </h5>
        </div>
        <div class="row hsf_w">
        @foreach($customize_tbl as $customize_tbl)
            <div class="hsf_e col-lg-12 col-md-12 col-12 card-body">
                <h3>Small Home Feature {{$loop->iteration}}</h3>
                <div class="">
                        <form autocomplete="off" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="id" value="{{$customize_tbl->id}}">
                        {{csrf_field()}}
                        <input type="hidden" name="type" value="home">
                        <input type="hidden" name="section" value="home small feature">

                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Image:
                                <input type="hidden" name="c_image" value="on">

                    <input type="hidden" name="image_w" value="310">
                    <input type="hidden" name="image_h" value="444">
                            </label>
                            <div class="controls col-md-9 col-12">
                              <input type="file" class="" name="image" id="w4-image" onchange="image1{{$customize_tbl->id}}(this);">
                              <small>recommended 310px*444px</small>
                              <div class="show_img_in_input_w">
                                   <img id="show1{{$customize_tbl->id}}" class="show_img_in_input" src="{{URL('public/allfiles/img/customize')}}/{{$customize_tbl->image}}" style="width:310px;height: 444px;">
                              </div>
                                <script type="text/javascript">
                                function image1{{$customize_tbl->id}}(input) {
                                if (input.files && input.files[0]) {
                                  var reader = new FileReader();
                                  reader.onload = function (e) {
                                      $('#show1{{$customize_tbl->id}}').attr('src', e.target.result);};
                                  reader.readAsDataURL(input.files[0]);}}
                                </script>
                            </div>
                        </div>

                        
                        <div class="control-group row">
                            <label class="control-label col-md-3 col-12">
                                Description:
                                <input type="hidden" name="c_description" value="on">
                            </label>
                            <div class="col-md-9 col-12">
                                <textarea id="editor{{$customize_tbl->id}}" name="description" class="editor{{$customize_tbl->id}}"  id="editor{{$customize_tbl->id}}">
                                    {{$customize_tbl->description}}
                                </textarea>
                            </div>
                            <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
                            <script>
                                CKEDITOR.replace( 'editor{{$customize_tbl->id}}' );
                            </script>
                        </div>
                        
                        <div class="control-group row">
                            <label class="control-label col-md-3 col-12">
                                Button Texta:
                                <input type="hidden" name="c_btn" value="on">
                            </label>
                            <div class="col-md-8 col-12">
                                <input type="text" name="btn" class="form-control" value="{{$customize_tbl->btn}}">
                            </div>
                        </div>


                        <div class="control-group row">
                            <label class="control-label col-md-3 col-12">
                                Button URL:
                                <input type="hidden" name="c_url" value="on">
                            </label>
                            <div class="col-md-8 col-12">
                                <input type="text" name="url" class="form-control" value="{{$customize_tbl->url}}">
                            </div>
                        </div>

                        <div class="control-group col-md-12 col-12 text-center">
                            <input type="submit" name="submit" class="btn btn-success">
                        </div>

                    </form>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>


                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


<br><br><br><br><br>

            <div class="card col-md-12 col-12 widget-box">
                <div class="card-header primary">
                    <h5 class="card-title">Home Feature image</h5>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.l.</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Btn</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($home_feature as $data)
                            <tr>
                                <td>
                                    <b>{{$loop->iteration}}</b>
                                </td>
                                <td>
                                    <img id="show1" class="show_img_in_input" src="{{URL('public/allfiles/img/customize')}}/{{$data->image}}">
                                </td>
                                <td><?php echo "{$data->description}";?></td>
                                <td>
                                    <a href="{{$data->url}}" class="btn btn-success">{{$data->btn}}</a>
                                </td>
                                <td>
                                    <a href="javascript:" class="btn btn-primary" data-toggle="modal" data-target="#h{{$data->id}}">Edit</a>

                                    <div class="modal fade" id="h{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body row">
<!-- Home feature -->
<div class="col-12">
    <div class="card widget-box warning_w">
        <div class="card-header warning">
            <h5 class="card-title">Home Feature image</h5>
        </div>
        <div class="card-body">
            <div class="">
                @if($customize_tbl_count == 0)
                    <form autocomplete="off" action="{{URL('makecommand/insert_customize')}}" method="post" enctype='multipart/form-data'>
                @else
                    <form autocomplete="off" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="id" value="{{$customize_tbl->id}}">
                @endif

                    {{csrf_field()}}


                    <input type="hidden" name="type" value="home">
                    <input type="hidden" name="section" value="home feature">

                    <div class="control-group col-md-12 col-12">
                        <label class="control-label col-md-3 col-12">
                            Image:
                            <input type="hidden" name="c_image" value="on">
                        </label>
                        <div class="controls col-md-9 col-12">
                          <input type="file" class="" name="image" id="w4-image" onchange="image1(this);">

                    <input type="hidden" name="image_w" value="1900">
                    <input type="hidden" name="image_h" value="700">

                          <div class="show_img_in_input_w">
                            @if($customize_tbl_count == 0)
                               <img id="show1" class="show_img_in_input" src="" alt="your image" />
                            @else
                               <img id="show1" class="show_img_in_input" src="{{URL('public/allfiles/img/customize')}}/{{$customize_tbl->image}}">
                            @endif
                          </div>
                            <script type="text/javascript">
                            function image1(input) {
                            if (input.files && input.files[0]) {
                              var reader = new FileReader();
                              reader.onload = function (e) {
                                  $('#show1').attr('src', e.target.result);};
                              reader.readAsDataURL(input.files[0]);}}
                            </script>
                        </div>
                    </div>

                    
                    <div class="control-group row">
                        <label class="control-label col-md-3 col-12">
                            Description:
                            <input type="hidden" name="c_description" value="on">
                        </label>
                        <div class="col-md-9 col-12">
                            @if($customize_tbl_count == 0)
                            <textarea id="editor1" name="description" class="editor1" id="editor1"></textarea>
                            @else
                                <textarea id="editor1" name="description" class="editor1"  id="editor1">
                                    {{$customize_tbl->description}}
                                </textarea>
                            @endif
                        </div>
                        <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace( 'editor1' );
                        </script>
                    </div>
                    
                    <div class="control-group row">
                        <label class="control-label col-md-3 col-12">
                            Button Texta:
                            <input type="hidden" name="c_btn" value="on">
                        </label>
                        <div class="col-md-8 col-12">
                            @if($customize_tbl_count == 0)
                            <input type="text" name="btn" class="form-control">
                            @else
                                <input type="text" name="btn" class="form-control" value="{{$customize_tbl->btn}}">
                            @endif
                        </div>
                    </div>


                    <div class="control-group row">
                        <label class="control-label col-md-3 col-12">
                            Button URL:
                            <input type="hidden" name="c_url" value="on">
                        </label>
                        <div class="col-md-8 col-12">
                            @if($customize_tbl_count == 0)
                            <input type="text" name="url" class="form-control">
                            @else
                                <input type="text" name="url" class="form-control" value="{{$customize_tbl->url}}">
                            @endif
                        </div>
                    </div>

                    <div class="control-group col-md-12 col-12 text-center">
                        <input type="submit" name="submit" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
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
          var url="{{URL('makecommand/search_customize')}}";
            location.replace(url+"?dfrom=<?php echo $dfrom?>&dto=<?php echo $dto?>&search_by="+selectby+"&search="+select);
        }
        </script>
    @else                            
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('makecommand/search_customize')}}";
            location.replace(url+"?search_by="+selectby+"&search="+select);
        }
        </script>
    @endif

@endsection