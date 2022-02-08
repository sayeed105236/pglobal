<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Image;
use App\User;
use App\admin\raw_tbl;
use App\admin\tag_tbl;
use App\admin\post_tbl;
use App\admin\page_tbl;
use App\admin\comment_tbl;
use App\admin\payment_tbl;
use App\admin\category_tbl;
use App\admin\notification_tbl;
use App\admin\cart_tbl;
use App\admin\order_tbl;
use App\admin\product_tbl;
use App\admin\shipping_tbl;
use App\admin\order_detail_tbl;
use App\admin\product_attri_tbl;
use Illuminate\Http\Request;

class DealerController extends Controller
{

public function index(){return view('dealer.index');}

public function orderlist(Request $request){
    $Auth_id=Auth::User()->id;
    $order_tbl=order_tbl::orderBy('id', 'desc')->where('user_id',$Auth_id)->paginate(30);
return view('dealer.orderlist')->with(['order_tbl'=>$order_tbl]);}


public function show_order(Request $request){
    $id=$request->input("id");
    $order_tbl=order_tbl::findorFail($id);
    $order_user_id="{$order_tbl->user_id}";
    $Auth_id=Auth::User()->id;

    if ($order_user_id == $Auth_id) {
        return view('dealer.show_order')->with(['order_tbl'=>$order_tbl]);
    }
    else{
        toast("There are some problem. Please connect with admin panel",'error');
        return back()->with('status', 'There are some problem. Please connect with admin panel');
    }
}




public function dealer_product(Request $request){
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $product_tbl=product_tbl::orderBy('id', 'desc')->where('status', '1')->where('approve', '1')->whereRaw("find_in_set('".'Dealer'."',category)")->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{$product_tbl=product_tbl::orderBy('id', 'desc')->where('status', '1')->where('approve', '1')->whereRaw("find_in_set('".'Dealer'."',category)")->paginate(30);}
return view('dealer.product')->with(['product_tbl'=>$product_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_dealer_product(Request $request){
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
         $product_tbl = product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->whereRaw("find_in_set('".'Dealer'."',category)")->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{
         $product_tbl = product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->whereRaw("find_in_set('".'Dealer'."',category)")->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
return view('backend.product')->with(['product_tbl'=>$product_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $product_tbl=product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->whereRaw("find_in_set('".'Dealer'."',category)")->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$product_tbl=product_tbl::orderBy($orderby, $ordertype)->paginate(30);}
  return view('dealer.product')->with(['product_tbl'=>$product_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_dealer_product(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $product_tbl = product_tbl::orderBy('id', 'DESC')->where('status', '1')->where('approve', '1')->whereRaw("find_in_set('".'Dealer'."',category)")->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $product_tbl = product_tbl::orderBy('id', 'DESC')->where('status', '1')->where('approve', '1')->whereRaw("find_in_set('".'Dealer'."',category)")->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('dealer.product')->with(['product_tbl'=>$product_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}




}
