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
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AffiliateController extends Controller
{



public function index(){return view('affiliate.index');}
public function code(){return view('affiliate.code');}





//reff_user
public function reff_user(Request $request){

    $referral_code=Auth::User()->referral_code;

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");

    if( !empty($dfrom) or  !empty($dto) ){
    $reff_user=User::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
    $reff_user_count=User::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
    } 
    else{
      $reff_user=User::orderBy('id', 'desc')->where('referred_by',$referral_code)->paginate(30);
      $reff_user_count=User::orderBy('id', 'desc')->where('referred_by',$referral_code)->count();
    }

return view('affiliate.reff_user')->with(['reff_user'=>$reff_user, 'reff_user_count'=>$reff_user_count, 'dfrom'=>$dfrom, 'dto'=>$dto]);}






public function sort_reff_user(Request $request){
    $referral_code=Auth::User()->referral_code;

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
           $reff_user = User::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
           $reff_user_count = User::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
         } 
        else{
           $reff_user = User::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where($search_by, 'like', '%'.$search.'%')->paginate(30);
           $reff_user_count = User::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where($search_by, 'like', '%'.$search.'%')->count();
         }
    return view('affiliate.reff_user')->with(['reff_user'=>$reff_user,'reff_user_count'=>$reff_user_count, 'search_by'=>$search_by,'search'=>$search, 'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $reff_user=User::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
      $reff_user_count=User::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
    } 
      else{
        $reff_user=User::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->paginate(30);
        $reff_user_count=User::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->count();
      }
  return view('affiliate.reff_user')->with(['reff_user'=>$reff_user,'reff_user_count'=>$reff_user_count,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_reff_user(Request $request){
    $referral_code=Auth::User()->referral_code;
    
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $reff_user = User::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
       $reff_user_count = User::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
     } 
    else{
       $reff_user = User::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where($search_by, 'like', '%'.$search.'%')->paginate(30);
       $reff_user_count = User::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where($search_by, 'like', '%'.$search.'%')->count();
     }

return view('affiliate.reff_user')->with(['reff_user'=>$reff_user,'reff_user_count'=>$reff_user_count, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}





public function create_affiliate_dashboard(){

    $Auth_id=Auth::User()->id;
    $table_name=User::find($Auth_id);
        $request_role=$table_name->request_role;
        if($request_role="affiliate"){
            $table_name->usertype="affiliate";
            $table_name->referral_code="#AFF0".$Auth_id;
            $table_name->request_role="complete affiliate";
        }
        else{
            alert()->error('Error','Error');
            return back();
        }
    $table_name->update();


return view('affiliate.create_affiliate_dashboard');}
























//pending_my_affiliate_order
public function pending_my_affiliate_order(Request $request){

    $referral_code=Auth::User()->referral_code;

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");

    if( !empty($dfrom) or  !empty($dto) ){
    $pending_my_affiliate_order=order_tbl::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
    $pending_my_affiliate_order_count=order_tbl::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
    } 
    else{
      $pending_my_affiliate_order=order_tbl::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->paginate(30);
      $pending_my_affiliate_order_count=order_tbl::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->count();
    }

return view('affiliate.pending_my_affiliate_order')->with(['pending_my_affiliate_order'=>$pending_my_affiliate_order, 'pending_my_affiliate_order_count'=>$pending_my_affiliate_order_count, 'dfrom'=>$dfrom, 'dto'=>$dto]);}






public function sort_pending_my_affiliate_order(Request $request){
    $referral_code=Auth::User()->referral_code;

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
           $pending_my_affiliate_order = order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
           $pending_my_affiliate_order_count = order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
         } 
        else{
           $pending_my_affiliate_order = order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where($search_by, 'like', '%'.$search.'%')->paginate(30);
           $pending_my_affiliate_order_count = order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where($search_by, 'like', '%'.$search.'%')->count();
         }
    return view('affiliate.pending_my_affiliate_order')->with(['pending_my_affiliate_order'=>$pending_my_affiliate_order,'pending_my_affiliate_order_count'=>$pending_my_affiliate_order_count, 'search_by'=>$search_by,'search'=>$search, 'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $pending_my_affiliate_order=order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
      $pending_my_affiliate_order_count=order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
    } 
      else{
        $pending_my_affiliate_order=order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->paginate(30);
        $pending_my_affiliate_order_count=order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->count();
      }
  return view('affiliate.pending_my_affiliate_order')->with(['pending_my_affiliate_order'=>$pending_my_affiliate_order,'pending_my_affiliate_order_count'=>$pending_my_affiliate_order_count,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_pending_my_affiliate_order(Request $request){
    $referral_code=Auth::User()->referral_code;
    
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $pending_my_affiliate_order = order_tbl::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
       $pending_my_affiliate_order_count = order_tbl::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
     } 
    else{
       $pending_my_affiliate_order = order_tbl::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where($search_by, 'like', '%'.$search.'%')->paginate(30);
       $pending_my_affiliate_order_count = order_tbl::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where('status', '=', 'pending')->orWhere('status', '=', 'Pending order')->orWhere('status', '=', 'Processing order')->orWhere('status', '=', 'Picked by courier')->orWhere('status', '=', 'On the way')->where($search_by, 'like', '%'.$search.'%')->count();
     }

return view('affiliate.pending_my_affiliate_order')->with(['pending_my_affiliate_order'=>$pending_my_affiliate_order,'pending_my_affiliate_order_count'=>$pending_my_affiliate_order_count, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}































//complete_my_affiliate_order
public function complete_my_affiliate_order(Request $request){

    $referral_code=Auth::User()->referral_code;

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");

    if( !empty($dfrom) or  !empty($dto) ){
    $complete_my_affiliate_order=order_tbl::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
    $complete_my_affiliate_order_count=order_tbl::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
    } 
    else{
      $complete_my_affiliate_order=order_tbl::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('status', '=', 'Complete')->paginate(30);
      $complete_my_affiliate_order_count=order_tbl::orderBy('id', 'desc')->where('referred_by',$referral_code)->where('status', '=', 'Complete')->count();
    }

return view('affiliate.complete_my_affiliate_order')->with(['complete_my_affiliate_order'=>$complete_my_affiliate_order, 'complete_my_affiliate_order_count'=>$complete_my_affiliate_order_count, 'dfrom'=>$dfrom, 'dto'=>$dto]);}






public function sort_complete_my_affiliate_order(Request $request){
    $referral_code=Auth::User()->referral_code;

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
           $complete_my_affiliate_order = order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
           $complete_my_affiliate_order_count = order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
         } 
        else{
           $complete_my_affiliate_order = order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where($search_by, 'like', '%'.$search.'%')->paginate(30);
           $complete_my_affiliate_order_count = order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where($search_by, 'like', '%'.$search.'%')->count();
         }
    return view('affiliate.complete_my_affiliate_order')->with(['complete_my_affiliate_order'=>$complete_my_affiliate_order,'complete_my_affiliate_order_count'=>$complete_my_affiliate_order_count, 'search_by'=>$search_by,'search'=>$search, 'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $complete_my_affiliate_order=order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
      $complete_my_affiliate_order_count=order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
    } 
      else{
        $complete_my_affiliate_order=order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'Complete')->paginate(30);
        $complete_my_affiliate_order_count=order_tbl::orderBy($orderby, $ordertype)->where('referred_by',$referral_code)->where('status', '=', 'Complete')->count();
      }
  return view('affiliate.complete_my_affiliate_order')->with(['complete_my_affiliate_order'=>$complete_my_affiliate_order,'complete_my_affiliate_order_count'=>$complete_my_affiliate_order_count,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_complete_my_affiliate_order(Request $request){
    $referral_code=Auth::User()->referral_code;
    
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $complete_my_affiliate_order = order_tbl::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
       $complete_my_affiliate_order_count = order_tbl::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
     } 
    else{
       $complete_my_affiliate_order = order_tbl::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where($search_by, 'like', '%'.$search.'%')->paginate(30);
       $complete_my_affiliate_order_count = order_tbl::orderBy('id', 'DESC')->where('referred_by',$referral_code)->where('status', '=', 'Complete')->where($search_by, 'like', '%'.$search.'%')->count();
     }

return view('affiliate.complete_my_affiliate_order')->with(['complete_my_affiliate_order'=>$complete_my_affiliate_order,'complete_my_affiliate_order_count'=>$complete_my_affiliate_order_count, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}







































//products
public function products(Request $request){

    $referral_code=Auth::User()->referral_code;

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");

    if( !empty($dfrom) or  !empty($dto) ){
    $products=product_tbl::orderBy('id', 'desc')->where('status', '1')->where('approve', '1')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
    $products_count=product_tbl::orderBy('id', 'desc')->where('status', '1')->where('approve', '1')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
    } 
    else{
      $products=product_tbl::orderBy('id', 'desc')->where('status', '1')->where('approve', '1')->paginate(30);
      $products_count=product_tbl::orderBy('id', 'desc')->where('status', '1')->where('approve', '1')->count();
    }

return view('affiliate.products')->with(['products'=>$products, 'products_count'=>$products_count, 'dfrom'=>$dfrom, 'dto'=>$dto]);}






public function sort_products(Request $request){
    $referral_code=Auth::User()->referral_code;

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
           $products = product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
           $products_count = product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
         } 
        else{
           $products = product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->where($search_by, 'like', '%'.$search.'%')->paginate(30);
           $products_count = product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->where($search_by, 'like', '%'.$search.'%')->count();
         }
    return view('affiliate.products')->with(['products'=>$products,'products_count'=>$products_count, 'search_by'=>$search_by,'search'=>$search, 'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $products=product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
      $products_count=product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
    } 
      else{
        $products=product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->paginate(30);
        $products_count=product_tbl::orderBy($orderby, $ordertype)->where('status', '1')->where('approve', '1')->count();
      }
  return view('affiliate.products')->with(['products'=>$products,'products_count'=>$products_count,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_products(Request $request){
    $referral_code=Auth::User()->referral_code;
    
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $products = product_tbl::orderBy('id', 'DESC')->where('status', '1')->where('approve', '1')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
       $products_count = product_tbl::orderBy('id', 'DESC')->where('status', '1')->where('approve', '1')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->count();
     } 
    else{
       $products = product_tbl::orderBy('id', 'DESC')->where('status', '1')->where('approve', '1')->where($search_by, 'like', '%'.$search.'%')->paginate(30);
       $products_count = product_tbl::orderBy('id', 'DESC')->where('status', '1')->where('approve', '1')->where($search_by, 'like', '%'.$search.'%')->count();
     }

return view('affiliate.products')->with(['products'=>$products,'products_count'=>$products_count, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}

























}
