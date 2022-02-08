@extends('backend.master.backend_master')
@section('title','Dashboard')

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('resources/backend/assets/extra-libs/multicheck/multicheck.css')}}">
        <link href="{{asset('resources/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
    @endsection
@section('body')





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
            <div class="col-12">
                <div>
                    <a href="javascript:" class="btn btn-warning" data-toggle="modal" data-target="#addfnq">Add f&q on {{$section}}</a>
                    <div class="modal fade" id="addfnq" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Addd F&Q</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="post" action="{{URL('makecommand/insert_fnq')}}">
                             {{csrf_field()}}
                          <div class="modal-body">
                            <div class="form-group">
                                <span>Title</span>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <span>Description</span>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            <input type="hidden" name="section" value="{{$section}}">
                            <input type="hidden" name="type" value="fnq">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Insert</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card widget-box">
                    <div class="card-header  widget-title">
                        <h5 class="card-title">F&q {{$section}} Datatable</h5>
                    </div>
                    <div class="card-body">
                            @if( ! empty($search))                            
                            <div class="col-md-12 col-12">
                                <div class="alert alert-primary" role="alert">
                                    You Have Searched for: <b>{{$search}}</b>
                                </div>
                            </div>
                            @endif


                        <div class="table-responsive">
                            <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                                {{$raw_tbl->links()}}
                                <thead>
                                    <tr>
                                        <th>S.l</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($raw_tbl as $data)
                                    <tr>
                                        <td><b>{{$loop->iteration}}</b></td>
                                        <td>{{$data->title}}</td>
                                        <td>
                                            <!-- Edit -->
                                            <a href="javascript:" data-toggle="modal" data-target="#description{{$data->id}}" class="btn btn-warning">Show</a>
                                            <div class="modal fade" id="description{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        {{$data->title}}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">{{$data->description}}</div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Edit -->
                                            <a href="javascript:" data-toggle="modal" data-target="#edit{{$data->id}}" class="editBtn edbtn">Edit</a>
                                            <div class="modal fade" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit F&Q</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <form method="post" action="{{URL('makecommand/update_fnq')}}">
                                                     {{csrf_field()}}
                                                  <div class="modal-body">
                                                    <div class="form-group">
                                                        <span>Title</span>
                                                        <input type="text" name="title" class="form-control"value="{{$data->title}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <span>Description</span>
                                                        <textarea class="form-control" name="description">{{$data->description}}</textarea>
                                                    </div>
                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Insert</button>
                                                  </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- Delete -->
                                            <a href="javascript:" class="btn-mini deleteRecord deleteBtn edbtn" data-toggle="modal" data-target="#d{{$data->id}}">Delete</a>
                                            <div class="modal fade" id="d{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete??? {{$loop->iteration}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    Do you really want to delete {{$data->title}}???
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <a href="{{URL('makecommand/delete_fnq?id')}}={{$data->id}}" type="button" class="btn btn-danger">Delete</a>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>{{$raw_tbl->links()}}
                        </div>

                    </div>
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
          var url="{{URL('makecommand/search_order')}}";
            location.replace(url+"?dfrom=<?php echo $dfrom?>&dto=<?php echo $dto?>&search_by="+selectby+"&search="+select);
        }
        </script>
    @else                            
        <script>
        function redirectservice() {
          var selectby = document.getElementById("selectredirectserviceby").value;
          var select = document.getElementById("selectredirectservice").value;
          var url="{{URL('makecommand/search_order')}}";
            location.replace(url+"?search_by="+selectby+"&search="+select);
        }
        </script>
    @endif

@endsection