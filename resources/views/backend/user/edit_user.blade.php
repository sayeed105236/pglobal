@extends('backend.master.backend_master')
@section('title','Edit User')

    @section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <style>
        td.pp_td {
    padding: 6px 0px;
}

.sl_no {
    min-height: 36px;
}
        </style>
    </style>
    @endsection
@section('body')




<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12">
                <div class="ml-auto text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{URL('makecommand')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit user</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger col-md-12" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-12">
                <div class="card widget-box">
                    <div class="card-header  widget-title">
                        <h5 class="card-title">Edit user</h5>
                    </div>
                    <div class="card-body">
                    <form autocomplete="off" action="{{URL('makecommand/update_user')}}" method="get">
                      
                      <input type="hidden" name="id" value="{{$id->id}}">
                      
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                <img src="{{URL('public/allfiles/img/pp')}}/{{$id->pp}}" width='50px'>
                            </label>
                            <div class="controls col-md-9 col-12">
                                {{$id->name}}
                            </div>
                        </div>
                        
                        
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Email:
                            </label>
                            <div class="controls col-md-9 col-12">{{$id->email}}</div>
                        </div>
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Phone:
                            </label>
                            <div class="controls col-md-9 col-12">{{$id->phone}}</div>
                        </div>
                        
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                User Type:
                            </label>
                            @php
                              $Auth_id=Auth::user()->id;
                            @endphp

                            @if($id->id==$Auth_id)

                                @if($id->usertype == "admin")
                                    <option value="admin">Admin</option>
                                    <input type="hidden" name="usertype" value="admin">
                                @elseif($id->usertype == "affiliate")
                                    <option value="affiliate">Affiliate</option>
                                    <input type="hidden" name="usertype" value="affiliate">
                                @elseif($id->usertype == "vendor")
                                    <option value="vendor">Vendor</option>
                                    <input type="hidden" name="usertype" value="vendor">
                                @elseif($id->usertype == "dealer")
                                    <option value="dealer">Dealer</option>
                                    <input type="hidden" name="usertype" value="dealer">
                                @elseif($id->usertype == "user")
                                    <option value="user">User</option>
                                    <input type="hidden" name="usertype" value="user">
                                @endif
                            @else

                                <select name="usertype" class="form-control sl_no controls col-md-8 col-12">
                                    @if($id->usertype == "admin")
                                        <option value="admin">Admin</option>
                                    @elseif($id->usertype == "affiliate")
                                        <option value="affiliate">Affiliate</option>
                                    @elseif($id->usertype == "vendor")
                                        <option value="vendor">Vendor</option>
                                    @elseif($id->usertype == "dealer")
                                        <option value="dealer">Dealer</option>
                                    @elseif($id->usertype == "user")
                                        <option value="user">User</option>
                                    @endif
                                    <option value="user">User</option>
                                    <option value="affiliate">Affiliate</option>
                                    <option value="vendor">Vendor</option>
                                    <option value="dealer">Dealer</option>
                                    <option value="admin">Admin</option>
                                </select>
                            @endif
                        </div>
                        
                        
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                               Status:
                            </label>
                            
                            <select name="status" class="form-control sl_no controls col-md-8 col-12">
                                @if($id->status == "1")
                                    <option value="1">Active</option>
                                @elseif($id->status == "0")
                                    <option value="0">Deactivate</option>
                                @endif
                                    <option value="1">Active</option>
                                    <option value="0">Deactivate</option>
                            </select>
                            
                        </div>
                        

                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Occupation:
                            </label>
                            <div class="controls col-md-9 col-12">{{$id->occupation}}</div>
                        </div>
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Birth Day:
                            </label>
                            <div class="controls col-md-9 col-12">
                                <?php
                                $birth="{$id->birth}";
        
                                $date=date_create("$birth");
                                echo date_format($date,"d F Y");
                                ?>
                            </div>
                        </div>
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Member Since:
                            </label>
                            <div class="controls col-md-9 col-12">
                                <?php
                                $created_at="{$id->created_at}";
        
                                $date=date_create("$created_at");
                                echo date_format($date,"d F Y");
                                ?>
                            </div>
                        </div>


                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Referral Code:
                            </label>
                            <div class="controls col-md-9 col-12">{{$id->referral_code}}</div>
                        </div>

                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Referred By:
                            </label>
                            <div class="controls col-md-9 col-12">{{$id->referred_by}}</div>
                        </div>


                        <div class="control-group col-md-12 col-12"></div>

                        @if($id->approve == 0)
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Request Role for:
                            </label>
                            {{$id->request_role}}
                        </div>
                        @endif

                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                User current approval status:
                            </label>
                            @if($id->approve == 3)
                                Rejected
                            @elseif($id->approve == 1)
                                Approved
                            @else
                                Pending
                            @endif
                        </div>

                        @if($id->approve == 0 || $id->approve == 3)
                        <div class="control-group col-md-12 col-12">
                            <label class="control-label col-md-3 col-12">
                                Approve:
                            </label>
                            <select name="approve" class="form-control sl_no controls col-md-8 col-12">
                                <option value></option>
                                <option value="1">Approve</option>
                                <option value="3">Reject</option>
                            </select>
                        </div>
                        @endif
                        


                        <div class="control-group col-md-12 col-12"> 
                          <div class="show_img_in_input_w">
                            <input type="submit" value="Update" class="btn btn-primary">
                          </div>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

                <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>

@endsection

