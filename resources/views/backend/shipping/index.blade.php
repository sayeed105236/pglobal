@extends('backend.master.backend_master')
@section('title','shipping')

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
                            <li class="breadcrumb-item active" aria-current="page">shipping</li>
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
                        <h5 class="card-title">shIPPING Datatable</h5>
                    </div>
                    <div class="card-body">
                            <div class="col-md-5 col-12 left plussrc">
                                <a href="javascript:" class="btn btn-warning" class="btn-mini deleteRecord deleteBtn edbtn" data-toggle="modal" data-target="#adding_shipping">Add shipping</a>

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
                            </div>
                            <div class="col-md-5 col-12 left plussrc">
                                <a href="{{URL('makecommand/shipping')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Refresh</a>
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
                                <thead>
                                    <th>S.L</th>
                                    <th>District</th>
                                    <th>Price</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($shipping_tbl as $data)
                                    <tr>
                                        <td>
                                            <b>{{$loop->iteration}}</b>
                                        </td>
                                        <td>
                                          {{$data->district}}

                                          @if($data->district=="Other")
                                            <small>
                                              (অন্যান্য সব জায়গা)
                                            </small>
                                          @endif
                                        </td>
                                        <td>{{$data->price}}</td>
                                        <td>{{$data->time}}</td>
                                        <td>

                                          <button type="button" class="btn btn-primary" class="editBtn edbtn" data-toggle="modal" data-target="#edit{{$data->id}}">
                                          Edit
                                          </button>
                                          <!-- Modal -->
                                          <div class="modal fade" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <form autocomplete="off" action="{{URL('makecommand/update_shipping')}}" method="post" enctype='multipart/form-data'>
                                                      <input type="hidden" name="id" value="{{$data->id}}">
                                                      {{csrf_field()}}
                                                      <div class="modal-body">
                                                        @if($data->district=="Other")
                                                        <div class="control-group col-md-12 col-12">
                                                            <div class="controls col-md-12 col-12">
                                                              <input type="hidden" required class="form-control" name="district" value="{{$data->district}}">
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="control-group col-md-12 col-12">
                                                            <label class="col-md-12 col-12">
                                                                Shipping zone:
                                                            </label>
                                                            <div class="controls col-md-12 col-12">
                                                              <input type="text" required class="form-control" name="district" value="{{$data->district}}">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="control-group col-md-12 col-12">
                                                            <label class="col-md-12 col-12">
                                                               Cost:
                                                            </label>
                                                            <div class="controls col-md-12 col-12">
                                                              <input type="number" required class="form-control" name="price" value="{{$data->price}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group col-md-12 col-12">
                                                            <label class="col-md-12 col-12">
                                                                Time:
                                                            </label>
                                                            <div class="controls col-md-12 col-12">
                                                              <input type="text" required class="form-control" name="time" value="{{$data->time}}">
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
                                          @if($data->district=="Other")
                                          @else
                                          <a href="javascript:" class="btn btn-danger" data-toggle="modal" data-target="#d{{$data->id}}">Delete</a>
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
                                                  Do you really want to delete {{$loop->iteration}}no SHipping???
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <a href="{{URL('makecommand/delete_shipping?id')}}={{$data->id}}" type="button" class="btn btn-danger">Delete</a>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          @endif

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
    </div>
</div>

@endsection

@section('script')
@endsection

