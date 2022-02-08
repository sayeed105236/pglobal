@extends('backend.master.backend_master')
@section('title','Withdraw Manage')

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
                            <li class="breadcrumb-item"><a href="{{URL('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Withdraw Manage</li>
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
                        <h5 class="card-title">Withdraw Management Datatable</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-5 col-12 left plussrc">
                            <a href="{{URL('makecommand/withdraw_manage')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Refresh</a>
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
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>

                                    @php
                                      $withdraw= DB::table('raw_tbl')->where('type', 'withdraw')->where('section', 'withdraw_charge')->orWhere('section', 'minimum_withdraw_amount')->orWhere('section', 'maximum_withdraw_amount')->orWhere('section', 'default_vendor_charge')->get();
                                    @endphp
                                    @foreach($withdraw as $data)
                                    <tr>
                                        <td><b>{{$loop->iteration}}</b></td>

                                        <td>
                                          @if($data->section=="withdraw_charge")
                                            Withdraw Charge
                                        @elseif($data->section=="maximum_withdraw_amount")
                                          Maximum Withdraw Amount
                                          @elseif($data->section=="minimum_withdraw_amount")
                                            Minimum Withdraw Amount
                                          @elseif($data->section=="default_vendor_charge")
                                            Vendor will get of their sell
                                          @endif
                                        </td>

                                        <td>
                                          @if($data->section=="withdraw_charge")
                                             {{$data->value}}%
                                          @elseif($data->section=="maximum_withdraw_amount")
                                             ৳ {{$data->value}}
                                          @elseif($data->section=="minimum_withdraw_amount")
                                             ৳ {{$data->value}}
                                          @elseif($data->section=="default_vendor_charge")
                                             {{$data->value}}%
                                          @endif
                                        </td>
                                        <td>

                                          <button type="button" class="btn btn-primary" class="editBtn edbtn" data-toggle="modal" data-target="#edit{{$data->id}}">
                                          Edit
                                          </button>
                                          <!-- Modal -->
                                          <div class="modal fade" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                  <form autocomplete="off" action="{{URL('makecommand/update_customize')}}" method="post" enctype='multipart/form-data'>
                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="type" value="{{$data->type}}">
                                                    <input type="hidden" name="section" value="{{$data->section}}">


                                                      <div class="modal-body">
                                                        <div class="control-group col-md-12 col-12">
                                                            <label class="col-md-12 col-12">
                                                               
                                                              @if($data->section=="withdraw_charge")
                                                                Withdraw Charge
                                                              @elseif($data->section=="maximum_withdraw_amount")
                                                                Maximum Withdraw Amount
                                                              @elseif($data->section=="minimum_withdraw_amount")
                                                                Minimum Withdraw Amount
                                                              @elseif($data->section=="default_vendor_charge")
                                                                Vendor will get of their sell
                                                              @endif
                                                              :
                                                            </label>
                                                            <div class="controls col-md-12 col-12">
                                                              <input type="number" required class="form-control" name="value" value="{{$data->value}}">
                                                            </div>
                                                        </div>

                                                      </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                    </form>
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
    </div>
</div>

@endsection

@section('script')
@endsection

