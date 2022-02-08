@extends('frontend.master.master')
    @section('css')
    @endsection
@section('body')



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
@include('frontend.profile.profile_master')

@php
    $Auth_id=Auth::User()->id;
    $user=App\User::findOrFail($Auth_id);
@endphp



            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        <form autocomplete="off" action="{{URL('profile/update_product')}}" method="post" enctype='multipart/form-data'>
            {{csrf_field()}}
        <input class="ch_in"type="hidden" name="id" value="{{$id->id}}">

        <div class="row">
            <div class="col-md-8 col-sm-12 col-12 fit_inblc">
                <div class="card widget-box">
                    <div class="card_main_heading">
                        <h5 class="card-title">Edit product</h5>
                    </div>
                    <div class="card-body">

                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">
                                product Name :
                            </label>
                            <div class="controls col-md-12 col-12">
                                <input class="ch_in"type="text" name="name" id="name" class="" required value="{{$id->name}}">
                            </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">
                                Description:
                            </label>
                            <div class="col-md-9 col-12">
                                <textarea id="editor" name="description" class="editor1">{{$id->description}}</textarea>
                            </div>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="control-group col-md-6 col-6 fit_inblc">
                            <label class="control-label col-md-12 col-12">
                                Main Price:
                            </label>
                            <div class="controls col-md-12 col-12">
                                <input class="ch_in"type="number" name="price" id="name" class="" value="{{$id->price}}" required>
                            </div>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="control-group col-md-6 col-6 fit_inblc">
                            <label class="control-label col-md-12 col-12">
                                Before Discount Price:
                            </label>
                            <div class="controls col-md-12 col-12">
                                <input class="ch_in"type="number" name="before_discount" value="{{$id->before_discount}}" id="name" class="">
                            </div>
                                @error('before_discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">
                                Product Code:
                            </label>
                            <div class="controls col-md-12 col-12">
                                @php 
                                    $last_product=App\admin\product_tbl::latest()->first();
                                @endphp
                                <?php 
                                    if(!empty($last_product)){
                                        $last_product_id="{$last_product->id}";
                                        $last_product_id_plus_one=$last_product_id+1;
                                    }
                                    else{
                                        $last_product_id_plus_one=1;
                                    }
                                ?>
                                <input class="ch_in"type="text" placeholder="{{$last_product_id_plus_one}}" name="code" id="name" class="" value="{{$id->code}}">
                            </div>
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">
                                Stock Management :<small style="color: red;">(if you want to manage your stock fill this box otherwise leave it empty)</small>
                            </label>
                            <div class="controls col-md-12 col-12">
                                <input class="ch_in"type="text"  name="stock" value="{{$id->stock}}" id="name" class="">
                            </div>
                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <hr>


                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">

                                Publish This Product: &nbsp 
                                @if( $id->status == 1)
                                    <input class="" type="checkbox" checked name="status" value="true">
                                @else
                                    <input class="" type="checkbox" name="status" value="false">
                                @endif
                            </label>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                    </div>
                </div>


                <div class="card widget-box">
                    <div class="card_main_heading">
                        <h5 class="card-title">SEO part</h5>
                    </div>
                    <div class="card-body">

                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">
                                Meta Title:
                            </label>
                            <div class="controls col-md-12 col-12">
                                <input class="ch_in"type="text" value="{{$id->meta_title}}" name="meta_title" >
                            </div>
                                @error('meta_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">
                                Meta Tags:
                            </label>
                            <div class="controls col-md-12 col-12">
                                <input class="ch_in"type="text" name="meta_tag" value="{{$id->meta_tag}}" placeholder="tag1,tag2,tag3">
                            </div>
                                @error('meta_tag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">
                                Meta Description:
                            </label>
                            <div class="controls col-md-12 col-12">
                                <textarea name="meta_description" class="form-control"> {{$id->meta_description}}</textarea>
                            </div>
                                @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                </div>


            </div>




            <div class="col-md-4 col-sm-12 col-12 fit_inblc">
                <div class="card widget-box">
                    <div class="card_main_heading">
                        <h5 class="card-title">Editproduct</h5>
                    </div>
                    <div class="card-body">

                        
                        <div class="big_height control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">
                                Category:
                            </label>
                            <div class="controls col-md-12 col-12">
                                <select name="category[]" required class="select2 fltr_sel form-control m-t-15" multiple="multiple">
                                    <optgroup label="Category">

                                    <?php $category="{$id->category}"; $category= explode(",",$category);?>
                                      @foreach($category as $category)
                                        <option selected value="<?php echo "$category";?>">
                                            <?php echo "$category";?>
                                        </option>
                                      @endforeach

                                    @foreach($d_category as $data)
                                        <option value="{{$data->name}}">
                                            {{$data->name}}
                                        </option>
                                    @endforeach
                                    </optgroup>
                                </select>
                            </div>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>



                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-12 col-12">
                                Main Image:
                            </label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="customFile" name="main_image"  onchange="main_image_url(this);">
                            </div>
                            <img id="main_image" class="show_img_in_input" src="{{URL('public/allfiles/img/product')}}/{{$id->main_image}}"  alt="your image" />
                                @error('main_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>



                        <div class="control-group col-md-12 col-12 pb_40">
                            <label class="control-label col-md-12 col-12">
                                Image:
                            </label>
                            <div class="custom-file">
                                <input type="file" class="form-control" name="image[]" multiple id="gallery-photo-add">
                                <div class="gallery"></div>
                            </div>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="other_pr_img">
                                    <?php $image="{$id->image}"; $image= explode(",",$image);?>
                                      @foreach($image as $image)
                                        <img src="{{URL('public/allfiles/img/product/thumb')}}/<?php echo $image;?>">
                                      @endforeach
                                </div>
                        </div>

                       
                    </div>
                </div>
                     <div class="control-group col-md-12 col-12 text-center">
                          <div class="show_img_in_input_w">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                          </div>
                    </div>
            </div>


        </div>
        </form>
    </div>

</div>



        <script type="text/javascript">
            function main_image_url(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#main_image').attr('src', e.target.result);};
              reader.readAsDataURL(input.files[0]);}}
            $(function() {
                // Multiple images preview in browser
                var imagesPreview = function(input, placeToInsertImagePreview) {

                    if (input.files) {
                        var filesAmount = input.files.length;

                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                            }

                            reader.readAsDataURL(input.files[i]);
                        }
                    }

                };

                $('#gallery-photo-add').on('change', function() {
                    $('.other_pr_img').hide();
                    imagesPreview(this, 'div.gallery');
                });
            });
        </script>
        <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>

        <script src="{{asset('resources/backend/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="{{asset('resources/backend/select2/dist/js/select2.min.js')}}"></script>
        <script>
            $(".select2").select2();
        </script>

@endsection
