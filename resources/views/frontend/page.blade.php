@extends('frontend.master.master')
@section('title',"$page_tbl->name")
@section('body')


<main class="main">

            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">{{$page_tbl->name}}s</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-10 pb-8">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{URL('')}}">Home</a></li>
                        <li>{{$page_tbl->name}}</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            

            <!-- Start of Page Content -->
            <div class="page-content">

                <div class="container" style="margin-top:50px;margin-bottom:50px;">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <h3 class="text-center">{{$page_tbl->name}}</h3>
                            <div>
                                <?php echo $page_desc="{$page_tbl->description}";?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- End of Main -->

@endsection