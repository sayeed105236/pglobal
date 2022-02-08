<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use DB;
use Auth;
use Image;
use App\User;
use App\admin\raw_tbl;
use App\admin\payment_tbl;
use App\admin\product_tbl;
use App\admin\category_tbl;
use App\admin\shipping_tbl;
use App\admin\order_tbl;
use App\admin\order_detail_tbl;
use App\admin\product_attri_tbl;
use App\Http\Controllers\Controller;
class orderController extends Controller
{


//order
public function order(Request $request){
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $order_tbl=order_tbl::orderBy('id', 'desc')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{$order_tbl=order_tbl::orderBy('id', 'desc')->paginate(30);}

return view('backend.order.index')->with(['order_tbl'=>$order_tbl,'dfrom'=>$dfrom,'dto'=>$dto]);}



public function show_order(Request $request){
  $id=$request->input("id");
    $order_tbl=order_tbl::findorFail($id);
    $order_user_id="{$order_tbl->user_id}";
  $Auth_id=Auth::User()->id;

    return view('backend.order.show_order')->with(['order_tbl'=>$order_tbl]);
}


public function sort_order(Request $request){
    $orderby=$request->input("orderby");
    $ordertype=$request->input("ordertype");
    $search=$request->input("search");
    $search_by=$request->input("search_by");

    //have search
  if( !empty($search)){
      // Date
        $dfrom=$request->input("dfrom");
        $dto=$request->input("dto");
        if( !empty($dfrom) or  !empty($dto) ){
           $order_tbl = order_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
        else{
           $order_tbl = order_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
    return view('backend.order.index')->with(['order_tbl'=>$order_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $order_tbl=order_tbl::orderBy($orderby, $ordertype)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$order_tbl=order_tbl::orderBy($orderby, $ordertype)->paginate(30);}
  return view('backend.order.index')->with(['order_tbl'=>$order_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_order(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $order_tbl = order_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $order_tbl = order_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend..order.index')->with(['order_tbl'=>$order_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}


public function edit_order(Request $request){
  $id=$request->input("id");
  $id=order_tbl::findOrFail($id);
return view('backend.order.edit_order')->with(['id'=>$id]);} 





public function update_order(Request $request){
  $order_id=$request->input('order_id');
  $table_name=order_tbl::find($order_id);
    $current_status=$table_name->status;


    if($current_status=="Complete"){}
    elseif($current_status=="Cancel"){
      $table_name->status=$request->input("status");
      $table_name->update();}


    else{

    $input_status=$request->input("status");
    if($input_status=="Complete"){
        //affiliate_payment
        $total_affiliate_payment=0;
        $referred_by=$table_name->referred_by;
        $total_affiliate_payment=$table_name->affiliate_payment;

        $referred_by_user=User::where('referral_code',$referred_by)->first();
        $referred_by_user_count=User::where('referral_code',$referred_by)->count();

          if($referred_by_user_count == 0){
              $referred_by=str_replace('#', '', $referred_by);
              $referred_by_user=User::where('referral_code',$referred_by)->first();
              $referred_by_user_count=User::where('referral_code', $referred_by)->count();
              if($referred_by_user_count == 0){
                $referred_by_user=User::where('referral_code',"#AFF01")->first();
              }
          }


            $referred_by_user_id=$referred_by_user->id;
            $taka_amount=$referred_by_user->taka_amount;
            $total_affiliate_taka_amount=$taka_amount+$total_affiliate_payment;
          $referred_by_user->taka_amount=$total_affiliate_taka_amount;
        $referred_by_user->update();

        $payment_tbl=new payment_tbl;
          $payment_tbl->user_id=$referred_by_user_id;
          $payment_tbl->type="Credited";
          $payment_tbl->amount=$total_affiliate_payment;
          $payment_tbl->order_id=$order_id;
          $payment_tbl->title="From Affiliation";
          $payment_tbl->status="approved";
        $payment_tbl->save();



        //Vendor
          $default_vendor_charge= raw_tbl::where('type', 'withdraw')->where('section', 'default_vendor_charge')->first()->value;
          $product_price=$table_name->product_price;
          $vendor_will_get=$product_price*($default_vendor_charge/100);


          $vendor_user_id=$table_name->user_id;
          $vendor_user=User::find($vendor_user_id);
            $taka_amount_of_vendor=$vendor_user->taka_amount;
            $total_taka_amount_after_sell=$taka_amount_of_vendor+$vendor_will_get;
          $referred_by_user->taka_amount=$total_taka_amount_after_sell;
        $referred_by_user->update();


        $payment_tbl=new payment_tbl;
          $payment_tbl->user_id=$vendor_user_id;
          $payment_tbl->type="Credited";
          $payment_tbl->amount=$vendor_will_get;
          $payment_tbl->order_id=$order_id;
          $payment_tbl->title="From Selling Product";
          $payment_tbl->status="approved";
        $payment_tbl->save();


      }


      $table_name->status=$request->input("status");
      $table_name->update();
    }

  $status=$request->input("status");

  // if($status=='cancel'){
  //   //Adding ro the stock of product_attri_tbl
  //   $order_detail_tbl=order_detail_tbl::where('order_id',$order_id)->get();
  //   foreach ($order_detail_tbl as $data) {
  //     $quantity="{$data->quantity}";
  //     $product_id="{$data->product_id}";
  //       $product_attri_tbl=product_attri_tbl::findOrFail($product_id);
  //         $stock="{$product_attri_tbl->stock}";
  //         $up_stock=$stock+$quantity;
  //         $product_attri_tbl->stock=$up_stock;
  //       $product_attri_tbl->update();
  //   }
  // }
alert()->success('Updated','Well done! order Updated Successfully!');
return back()->with('status', 'Well done! Updated Success!');
}

}
