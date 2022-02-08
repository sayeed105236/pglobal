@extends('frontend.master.master')
@section('body')



<div class="container">
    <div class="row">

        @foreach($category_tbl as $category_tbl)
        <div class="col-md-2 col-sm-3 col-4 sc_in">
            <div class="category-wrap">
                <div class="category category-ellipse">
                    <figure class="category-media">
                        <a href="shop-banner-sidebar.html">
                            <img src="{{URL('public/allfiles/img')}}/{{$category_tbl->icon}}" alt="Categroy" width="150" height="150" style="background-color: #B8BDC1;" />
                        </a>
                    </figure>
                    <div class="category-content">
                        <h4 class="category-name">
                            <a href="shop-banner-sidebar.html">
                                {{$category_tbl->name}}
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>


@endsection