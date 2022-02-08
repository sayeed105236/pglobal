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
            background: #39bb39;
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
        .ch_in {
            line-height: 50px;
            padding: 0 20px !important;
            color: #333 !important;
            border: none;
            background: #F6F7FB !important;
            color: #666;
            border-radius: 0px !important;
            margin: 0px 0px 26px 0px;
            width: 100%;
        }
        .checkout-form {
            padding: 20px 20px;
        }

        .cti {
            margin: 30px 0px 0px 0px;
            background: #f5f5f5;
            width: 100%;
            border: 1px solid #ddd;
            padding: 20px 21px;
            font-size: 25px;
            font-weight: bold;
        }

        section.shop.checkout.section {
            border: 1px solid #ddd;
        }
        .textee {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
        }
        .gateway_w1 img {
            width: 80px;
            height: 80px;
        }

        p.gateway_name {
            font-size: 20px;
            font-weight: bold;
            margin: 0px;
        }
        .gateway_w {
            padding: 10px 30px;
            height: auto;
            border: 1px solid #ddd;
            cursor: pointer;
            margin-top: 15px;
        }


        .gateway_w:hover {
            box-shadow: 0px 0px 6px 4px #cce7f1eb;
        }
    </style>
  </head>
  <body>


@include('sweetalert::alert')



@php
  $raw_tbl= DB::table('raw_tbl')->where('type', 'withdraw')->where('section', 'minimum_withdraw_amount')->first();
    $Auth_taka_amount=Auth::user()->taka_amount;
    $Auth_taka_amount=(float)$Auth_taka_amount;
@endphp
@if($Auth_taka_amount<$raw_tbl->value)
<?php 
     header("Location: https://pioneerglobal.shop/");
     exit();
?>
@endif

    <div class="container" style="margin-top:30px;">



@php
  $Auth_id=Auth::user()->id;
  $auth_payment_method= App\admin\payment_detail_tbl::where('user_id', $Auth_id)->distinct()->get();
@endphp
<div class="container" style="margin:30px 0px;">
    <div class="row">
        @foreach($auth_payment_method as $data)
        <a class="col-md-6 row gateway_w" href="{{URL('withdraw')}}?gateway={{$data->gateway}}&account_name={{$data->account_name}}&bank_number={{$data->bank_number}}&account_type={{$data->account_type}}&bank_name={{$data->bank_name}}&bank_branch={{$data->bank_branch}}&phone={{$data->phone}}">
            <div class="col-md-5 gateway_w1">
                <img src="{{URL('resources/assets/images')}}/{{$data->gateway}}.png">
            </div>
            <div class="col-md-7 gateway_w2">
                <p class="gateway_name">{{$data->gateway}}</p>
                @if($data->gateway == "Bank")
                    <p class="with_des">{{$data->bank_number}}, {{$data->account_name}}, {{$data->account_type}}, {{$data->bank_name}}, {{$data->bank_branch}}, </p>
                @else
                    <p class="with_des">{{$data->phone}}, {{$data->account_type}}</p>
                @endif
            </div>
        </a>
        @endforeach
    </div>
</div>




        <div class="row">
            @if (session('status'))
                <div class="alert alert-warning col-md-12" role="alert">
                    {{ session('status') }}
                </div>
            @endif



                    @php
                        $Auth_id=Auth::User()->id;
                        $user=App\User::findOrFail($Auth_id);
                    @endphp
                <!-- Start Checkout -->
                <section class="shop checkout section">
                  <form class="container" action="{{URL('withdraw_request')}}" method="post">
                  {{csrf_field()}}
                    <div class="row"> 

                          <div class="cti">Withdraw Information</div>
                      <div class="col-lg-12 col-12">
                        <div class="checkout-form col-lg-12 col-12 row">
                          <p></p>
                          <!-- Form -->
                            <div class="col-lg-12 col-12 row">

                              <div class="col-lg-12 col-12">
                                <div class="form-group">
                                  <label>Withdraw Method<span>*</span></label>
                                  <select class="ch_in ch_in2" id="gateway" name="gateway" required="required" style="height:50px;">

                                    @if($gateway !== Null) 
                                      <option value="{{$gateway}}">{{$gateway}}</option>
                                    @else
                                      <option></option>
                                    @endif
                                      <option value="Bkash">Bkash</option>
                                      <option value="Bkash">Bkash</option>
                                      <option value="Rocket">Rocket</option>
                                      <option value="Nagad">Nagad</option>
                                      <option value="Bank">Bank</option>
                                  </select>
                                </div>
                              </div>


                                @if($gateway !== Null) 
                                    @if ($gateway == "Bkash" || $gateway == "Rocket" || $gateway == "Nagad") 
                                      <div class='col-md-12 col-12 row' id='Mobile_banking'>
                                    @else
                                      <div class='col-md-12 col-12 row' id='Mobile_banking' style='display: none;'>
                                    @endif
                                @else
                                  <div class='col-md-12 col-12 row' id='Mobile_banking' style='display: none;'>
                                @endif

                                <div class="col-md-12">
                                    <span id="Mobile_banking_text" class="textee"></span>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                  <label>Your Phone Number<span>*</span></label>

                                    @if($phone !== Null) 
                                      <input class="ch_in ch_in2" type="text" name="phone" value="{{$phone}}">
                                    @else
                                      <input class="ch_in ch_in2" type="text" name="phone">
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-12">
                                  <label>Account Type<span>*</span></label>
                                  <select class="ch_in ch_in2" name="phone_account_type"  style="height:50px;">
                                    @if($account_type !== Null) 
                                      <option value="{{$account_type}}">{{$account_type}}</option>
                                    @else
                                      <option></option>
                                    @endif
                                      <option value="Personal">Personal</option>
                                      <option value="Agent">Agent</option>
                                  </select>
                                </div>
                              </div>

                                @if($gateway !== Null) 
                                    @if ($gateway == "Bank") 
                                      <div class="col-md-12 col-12 row" id="Banking">
                                    @else
                                      <div class="col-md-12 col-12 row" id="Banking" style="display: none;">
                                    @endif
                                @else
                                  <div class="col-md-12 col-12 row" id="Banking" style="display: none;">
                                @endif

                                    <div class="col-md-12 col-12 textee">Give information about your bank account</div>
                                    <div class="form-group col-md-6 col-12">
                                      <label>A/c Name<span>*</span></label>
                                        @if($account_name !== Null) 
                                          <input class="ch_in ch_in2" type="text" name="account_name" value="{{$account_name}}">
                                        @else
                                          <input class="ch_in ch_in2" type="text" name="account_name">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                      <label>Bank Name<span>*</span></label>
                                        @if($bank_name !== Null) 
                                          <input class="ch_in ch_in2" type="text" name="bank_name" value="{{$bank_name}}">
                                        @else
                                          <input class="ch_in ch_in2" type="text" name="bank_name">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                      <label>A/C Type<span>*</span></label>
                                      <select class="ch_in ch_in2" name="bank_account_type"  style="height:50px;">
                                            @if($account_type !== Null) 
                                              <option value="{{$account_type}}">{{$account_type}}</option>
                                            @else
                                              <option></option>
                                            @endif
                                          <option value="Savings">Savings</option>
                                          <option value="Current">Current</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                      <label>A/C Number<span>*</span></label>
                                        @if($bank_number !== Null) 
                                          <input class="ch_in ch_in2" type="text" name="bank_number" value="{{$bank_number}}">
                                        @else
                                          <input class="ch_in ch_in2" type="text" name="bank_number">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                      <label>Branch Name<span>*</span></label>
                                        @if($bank_branch !== Null) 
                                          <input class="ch_in ch_in2" type="text" name="bank_branch" value="{{$bank_branch}}">
                                        @else
                                          <input class="ch_in ch_in2" type="text" name="bank_branch">
                                        @endif
                                    </div>
                              </div>


                              <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                <script>
                                $(document).ready(function(){
                                    $("#gateway").change(function(){
                                        $(this).find("option:selected").each(function(){
                                            var optionValue = $(this).attr("value");
                                            if(optionValue == "Bkash" || optionValue == "Rocket" || optionValue == "Nagad"){

                                                $("#Mobile_banking").show();
                                                $("#Banking").hide();
                                                $("#Mobile_banking_text").text("Give information about your "+ optionValue);

                                            } 
                                            else if(optionValue == "Bank"){

                                                $("#Mobile_banking").hide();
                                                $("#Banking").show();
                                            } 
                                        });
                                    }).change();
                                });
                                </script>


                              <br>

@php
  $min_w= DB::table('raw_tbl')->where('type', 'withdraw')->where('section', 'minimum_withdraw_amount')->first()->value;
  $max_w= DB::table('raw_tbl')->where('type', 'withdraw')->where('section', 'maximum_withdraw_amount')->first()->value;
  $withdraw_charge= DB::table('raw_tbl')->where('type', 'withdraw')->where('section', 'withdraw_charge')->first()->value;
@endphp
                                <div class="form-group col-md-6 col-12">
                                  <label>
                                    Amount of Withdraw<span>*</span>
                                    <small>(Withdrawal charge is {{$withdraw_charge}}%)</small>
                                </label>
                                      <input class="ch_in ch_in2" type="number" name="amount" min="<?php echo $min_w;?>" max="<?php echo $max_w;?>">
                                </div>

                              <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                  <label>Description</label>
                                  <textarea name="description" class="ch_in ch_in2"></textarea>
                                </div>
                              </div>

                              <div class="col-md-12 col-12 row text-center div_center">
                                  <div class="col-md-3 col-12"></div>
                                  <div class="col-md-6 col-12">
                                      <button type="submit" class="btn" style="width: 100%; background: black; color: #fff; font-weight: bold; font-size: 16px;">
                                        Withdraw
                                      </button>
                                  </div>
                                  <div class="col-md-3 col-12"></div>
                              </div>
                            </div>
                          <!--/ End Form -->
                        </div>
                      </div>
                    </div>
                  </form>
                </section>






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
