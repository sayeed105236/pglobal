<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL('resources/backend/assets/images/favicon.png')}}">
    <title>My All Transection</title>
    <link href="{{asset('resources/backend/assets/libs/flot/css/float-chart.css')}}" rel="stylesheet">
    <link href="{{asset('resources/backend/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/backend/css.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7e9cbdcf79.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .Credited {
            background: #39bb39;
            color: #fff;
            padding: 2px 6px;
            font-weight: bold;
        }
        .Debited {
            background: #fb1717;
            color: #fff;
            padding: 2px 6px;
            font-weight: bold;
        }

        .approved {
            background: #39bb39;
            color: #fff;
            padding: 2px 6px;
            font-weight: bold;
            }
        .pending {
            background: #FFEB3B;
            color: #fff;
            padding: 2px 6px;
            font-weight: bold;
        }
        .canceled {
            background: #e5241b;
            color: #fff;
            padding: 2px 6px;
            font-weight: bold;
        }
    </style>
  </head>
  <body>




            
            <div class="container-fluid">
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success col-md-12" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="card widget-box">
                            <div class="card-header  widget-title">
                                <h5 class="card-title">Trasention Datatable</h5>
                            </div>
                            <div class="card-body">
                                    @if( ! empty($search))                            
                                    <div class="col-md-12 col-12">
                                        <div class="alert alert-primary" role="alert">
                                            You Have Searched for: <b>{{$search}}</b>
                                        </div>
                                    </div>
                                    @endif


                                <div class="row">
                                    <div class="col-md-6 col-12 text-left">
                                        <h3>
                                            My balance: ৳
                                            @php
                                                $Auth_usertype=Auth::user()->usertype;
                                                $Auth_taka_amount=Auth::user()->taka_amount;
                                                echo $Auth_taka_amount=(float)$Auth_taka_amount;
                                            @endphp
                                        </h3>
                                    </div>
                                    <div class="col-md-6 col-12 text-right">
                                        @php
                                          $raw_tbl= DB::table('raw_tbl')->where('type', 'withdraw')->where('section', 'minimum_withdraw_amount')->first();
                                        @endphp


                                        @if($Auth_taka_amount>=$raw_tbl->value)
                                            <a href="{{URL('withdraw')}}" class="btn btn-primary withdraw_btn">
                                              Withdraw
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-primary withdraw_btn" data-toggle="modal" data-target="#sorry_withdraw_modal">
                                              Withdraw
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="sorry_withdraw_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-body text-left">
                                                    <h5>Sorry minimun withdraw require ৳{{$raw_tbl->value}}</h5>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                         @endif
                                    </div>
                                </div>
                                <br>


                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-bordered data-table" width="100%" cellspacing="0">
                                        <tr>
                                            <th>S.L</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                        @foreach($payment_tbl as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->title}}</td>
                                            <td>
                                                <span class="{{$data->type}}">{{$data->type}}</span>
                                            </td>
                                            <td>৳ {{$data->amount}}</td>
                                            <td>{{$data->description}}</td>
                                            <td>
                                                <span class="{{$data->status}}">{{$data->status}}</span>
                                            </td>
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



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{asset('resources/backend/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('resources/backend/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('resources/backend/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/7e9cbdcf79.js" crossorigin="anonymous"></script>
    <script src="{{asset('resources/backend/dist/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('resources/backend/dist/js/custom.min.js')}}"></script>
  </body>
</html>
