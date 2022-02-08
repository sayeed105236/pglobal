@extends('backend.master.backend_master')
@section('title','Pending Withdraw Manage')

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
                            <li class="breadcrumb-item active" aria-current="page">Pending Withdraw Manage</li>
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
                        <h5 class="card-title">Pending Withdraw Management Datatable</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-5 col-12 left plussrc">
                            <a href="{{URL('makecommand/pending_withdraw')}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Refresh</a>
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
                                <tr>
                                    <th>S.L</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                    <th>Edit</th>
                                </tr>
                                @foreach($payment_tbl as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->title}}</td>
                                    <td>৳ {{$data->amount}}</td>
                                    <td><span class="{{$data->status}}">{{$data->status}}</span></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" class="editBtn edbtn" data-toggle="modal" data-target="#details{{$data->id}}">Details</button>
                                          <!-- Modal -->
                                          <div class="modal fade" id="details{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                    <table class="data-table" width="100%" cellspacing="0">
                                                        @php
                                                          $user=App\User::findOrFail($data->user_id);
                                                        @endphp
                                                        <tr>
                                                            <td colspan="2">
                                                              <img src="{{URL('public/allfiles/img/pp')}}/{{$user->pp}}" class="profile_img" id="pp_img" width="100px">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>User Name:</td>
                                                            <td>{{$user->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>User Role:</td>
                                                            <td>{{$user->usertype}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>User phone:</td>
                                                            <td>{{$user->phone}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>User email:</td>
                                                            <td>{{$user->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>User contact url:</td>
                                                            <td>{{$user->contact_url}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>User address:</td>
                                                            <td>{{$user->address}}</td>
                                                        </tr>
                                                        <tr><td></td><td></td></tr>

                                                        <tr>
                                                            <td>Withdraw Title:</td>
                                                            <td>{{$data->title}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Withdraw Amount:</td>
                                                            <td>৳{{$data->amount}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Withdraw status:</td>
                                                            <td>{{$data->status}}</td>
                                                        </tr>



                                                        <tr><td></td><td></td></tr>
                                                        @php
                                                         $detai_tbl=App\admin\payment_detail_tbl::where("payment_id",$data->id)->get();
                                                        @endphp
                                                        @foreach($detai_tbl as $detai_tbl)
                                                            <tr>
                                                                <td>Withdraw gateway:</td>
                                                                <td>{{$detai_tbl->gateway}}</td>
                                                            </tr>
                                                            @if($detai_tbl->gateway == "bank")
                                                                <tr>
                                                                    <td>Withdraw Bank Account Name:</td>
                                                                    <td>{{$detai_tbl->account_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Withdraw Bank Name:</td>
                                                                    <td>{{$detai_tbl->bank_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Withdraw Bank Account Number:</td>
                                                                    <td>{{$detai_tbl->bank_number}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Withdraw Bank Bramch:</td>
                                                                    <td>{{$detai_tbl->bank_branch}}</td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td>Withdraw phone number:</td>
                                                                    <td>{{$detai_tbl->phone}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Withdraw Account Type:</td>
                                                                    <td>{{$detai_tbl->account_type}}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        <tr>
                                                            <td>Withdraw description:</td>
                                                            <td>{{$data->description}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              </div>
                                              </div>
                                            </div>
                                          </div> 
                                      </td> 



                                    <td>
                                        <button type="button" class="btn btn-primary" class="editBtn edbtn" data-toggle="modal" data-target="#edit{{$data->id}}">Edit</button>
                                    </td>
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
                                                  <form autocomplete="off" action="{{URL('makecommand/update_withdraw')}}" method="get">
                                                    <input type="hidden" name="id" value="{{$data->id}}">


                                                      <div class="modal-body">
                                                        <div class="control-group col-md-12 col-12">
                                                            <label class="col-md-12 col-12">
                                                               Status
                                                            </label>
                                                            <div class="controls col-md-12 col-12">
                                                              <select required class="form-control" name="status">
                                                                <option></option>
                                                                <option value="canceled">Canceled</option>
                                                                <option value="approved">Approved</option>
                                                              </select>
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

                                </tr>
                                @endforeach
                            </table>
                            {{ $payment_tbl->links() }}
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

