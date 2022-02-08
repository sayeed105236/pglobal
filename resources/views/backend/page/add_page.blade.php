@extends('backend.master.backend_master')
@section('title','add page')
@section('body')




<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="ml-auto text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{URL('makecommand')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-12">
                <div class="card widget-box">
                    <div class="card-header  widget-title">
                        <h5 class="card-title">Add page</h5>
                    </div>
                    <div class="card-body">
                    <form autocomplete="off" action="{{URL('makecommand/insert_page')}}" method="post" enctype='multipart/form-data'>
                      {{csrf_field()}}

                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Page Name :
                            </label>
                            <div class="controls col-md-9 col-12">
                                <input type="text" name="name" id="name" class="" required>
                            </div>
                        </div>
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Description:
                            </label>
                            <div class="col-md-12 col-12">
                                <textarea id="editor" name="description" class="editor1"></textarea>
                            </div>
                        </div>

                        <div class="control-group col-md-12 col-12">
                              <div class="show_img_in_input_w">
                                <input type="submit" value="save" class="btn btn-primary">
                              </div>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: "{{URL('laravel-filemanager?type=Images')}}",
    filebrowserImageUploadUrl: "{{URL('laravel-filemanager/upload?type=Images&_token=')}}",
    filebrowserBrowseUrl: "{{URL('laravel-filemanager?type=Files')}}",
    filebrowserUploadUrl: "{{URL('laravel-filemanager/upload?type=Files&_token=')}}"
  };
</script>
<script>CKEDITOR.replace('editor', options);</script>




@endsection

