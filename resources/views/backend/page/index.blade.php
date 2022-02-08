@extends('backend.master.backend_master')
@section('title','Page')

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
                <div class="card widget-box">
                    <div class="card-header  widget-title">
                        <h5 class="card-title">Basic Datatable</h5>
                    </div>
                    <div class="card-body">
                            <div class="col-md-5 col-12 left plussrc">
                                <a href="{{URL('makecommand/add_page')}}" class="btn btn-warning">
                                    Add a new page +
                                </a>
                            </div>
                            <div class="col-md-5 col-12 left plussrc">
                                <a href="{{URL('makecommand/page')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Refresh</a>
                            </div>
                            @if( ! empty($status))                            
                            <div class="col-md-12 col-12">
                                <div class="alert alert-primary" role="alert">
                                    You Have Searched for: <b>{{$search}}</b>
                                </div>
                            </div>
                            @endif


                        <div class="table-responsive">
                            <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                                {{$page_tbl->links()}}
                                <thead>
                                    <th>S.L</th>
                                    <th>Page Name</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($page_tbl as $data)
                                    <tr>
                                        <td>
                                            <b>{{$loop->iteration}}</b>
                                        </td>
                                        <td>{{$data->name}}</td>
                                        <td>
                                            <a href="{{URL('makecommand/edit_page?id')}}={{$data->id}}" class="editBtn edbtn">Edit</a>
                                            <a href="javascript:" class="btn-mini deleteRecord deleteBtn edbtn" data-toggle="modal" data-target="#d{{$data->id}}">Delete</a>
                                        </td>

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
                                                Do you really want to delete {{$loop->iteration}}no page???
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href="{{URL('makecommand/delete_page?id')}}={{$data->id}}" type="button" class="btn btn-danger">Delete</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>


                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>{{$page_tbl->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@endsection

