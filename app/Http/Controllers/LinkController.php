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

class LinkController extends Controller
{

public function index(){return view('frontend.index');}









public function referred_code_check(){
  
  $request_role="affiliate";
return view('auth.affiliate_vendor')->with(['request_role'=>$request_role]);
}
  

  
public function affiliate_reg(){
  $request_role="affiliate";
return view('auth.affiliate_vendor')->with(['request_role'=>$request_role]);}
public function vendor_reg(){
  $request_role="vendor";
return view('auth.affiliate_vendor')->with(['request_role'=>$request_role]);}
public function Dealer_Reg(){
  $request_role="dealer";
return view('auth.affiliate_vendor')->with(['request_role'=>$request_role]);}






public function fnq(){return view('frontend.fnq');}

public function page_show(Request $request,$name,$id){
  $page_tbl=page_tbl::findOrFail($id);  
return view('frontend.page')->with(['page_tbl'=>$page_tbl]);}


public function order_track(){return view('frontend.order_track');}

public function order_tracking(Request $request){
  $order_id=$request->input("order_id");

  $order_track=order_tbl::where('order_code',$order_id)->first();
  $order_track_count=order_tbl::where('order_code',$order_id)->count();

return view('frontend.order_track')->with(['order_track'=>$order_track, 'order_track_count'=>$order_track_count, 'order_id'=>$order_id]);}


public function all_category(){
  $category_tbl=category_tbl::orderBy('name', "ASC")->get();
return view('frontend.all_category')->with(['category_tbl'=>$category_tbl,'header'=>"on"]);}


public function shop(Request $request){
  //orderBy
  $orderBy=$request->input("orderBy");
  if($orderBy=="asc"){$orderBy="asc";}
  else{$orderBy="desc";}
  if($orderBy==NULL){$orderBy="desc";}
  //paginate
  $paginate=$request->input("paginate");
  if($paginate!== Null){$paginate=$request->input("paginate");}
  else{$paginate=24;}

  
  //shop_user
  $shop_user=$request->input("shop_user");
    if( !empty($shop_user)){
      $shop_user_p="user_id";$shop_user=$request->input("shop_user");
      $page_name="shop_user";$shop_id=$request->input("shop_user"); }
    else{$shop_user_p="status";$shop_user=1;$shop_id="1";}
    // page name
    if( empty($page_name) ){$page_name="shop";}



  //search
  $search=$request->input("search");
  $category=$request->input("category_name");
      $category=str_replace("'", '', $category);
      $category=str_replace("&", 'and', $category);

    if( !empty($search) ){
    $low_price=$request->input("low_price");$high_price=$request->input("high_price");
      if( !empty($low_price) or  !empty($high_price) ){
      if($low_price==NULL){$low_price=1;}if($high_price==NULL){$high_price=10000;}

      $product_tbl=product_tbl::orderBy('id', $orderBy)
                  ->where('status', '1')->where('approve', '1')
                  ->where('name', 'LIKE', "%{$search}%")->where('category', 'LIKE', "%{$search}%")
                  ->whereRaw("find_in_set('".$search."',category)")
                  ->whereRaw("Not find_in_set('".'Dealer'."',category)")
                  ->where($shop_user_p,$shop_user)
                  ->whereBetween('price', [$low_price, $high_price])
                  ->paginate($paginate);

    return view('frontend.shop')->with(['product_tbl'=>$product_tbl,'low_price'=>$low_price,'high_price'=>$high_price,'page_name'=>"search",'shop_id'=>$shop_id,'search'=>$shop_id]);
    } 
      else{
    $product_tbl=product_tbl::orderBy('id', $orderBy)
                  ->where('name', 'LIKE', "%{$search}%")
                  ->where('category', 'LIKE', "%{$search}%")
                  ->whereRaw("find_in_set('".$search."',category)")
                  ->whereRaw("Not find_in_set('".'Dealer'."',category)")
                  ->where($shop_user_p,$shop_user)
                  ->paginate($paginate);
    return view('frontend.shop')->with(['product_tbl'=>$product_tbl,'page_name'=>"search",'shop_id'=>$shop_id,'search'=>$search]);
    }

    }
    else if( !empty($category) ){
      if( !empty($low_price) or  !empty($high_price) ){
      if($low_price==NULL){$low_price=1;}if($high_price==NULL){$high_price=10000;}

        $product_tbl=product_tbl::orderBy('id', $orderBy)
                      ->where('status', '1')->where('approve', '1')
                      ->where($shop_user_p,$shop_user)->where('name', 'LIKE', "%{$category}%")
                      ->whereRaw("find_in_set('".$category."',category)")
                      ->whereRaw("Not find_in_set('".'Dealer'."',category)")
                      ->whereBetween('price', [$low_price, $high_price])
                      ->paginate($paginate);

    return view('frontend.shop')->with(['product_tbl'=>$product_tbl,'low_price'=>$low_price,'high_price'=>$high_price,'page_name'=>"category",'category'=>$category]);
    } 
      else{
    $product_tbl=product_tbl::orderBy('id', $orderBy)
                  ->where('status', '1')->where('approve', '1')
                  ->where($shop_user_p,$shop_user)
                  ->whereRaw("find_in_set('".$category."',category)")
                  ->whereRaw("Not find_in_set('".'Dealer'."',category)")
                  ->paginate($paginate);
    return view('frontend.shop')->with(['product_tbl'=>$product_tbl,'page_name'=>"category",'category'=>$category]);
    } 
  }

  else{
    $low_price=$request->input("low_price");$high_price=$request->input("high_price");
      if( !empty($low_price) or  !empty($high_price) ){
      if($low_price==NULL){$low_price=1;}if($high_price==NULL){$high_price=10000;}
        
        $product_tbl=product_tbl::orderBy('id', $orderBy)
                      ->where('status', '1')->where('approve', '1')
                      ->where($shop_user_p,$shop_user)
                      ->whereBetween('price', [$low_price, $high_price])
                      ->whereRaw("Not find_in_set('".'Dealer'."',category)")
                      ->paginate($paginate);

    return view('frontend.shop')->with(['product_tbl'=>$product_tbl,'low_price'=>$low_price,'high_price'=>$high_price,'page_name'=>$page_name,'shop_id'=>$shop_id]);
    } 
      else{
    $product_tbl=product_tbl::orderBy('id', $orderBy)
                ->where('status', '1')->where('approve', '1')
                ->where($shop_user_p,$shop_user)
                  ->whereRaw("Not find_in_set('".'Dealer'."',category)")
                ->paginate($paginate);
    return view('frontend.shop')->with(['product_tbl'=>$product_tbl,'page_name'=>$page_name,'shop_id'=>$shop_id]);
    }
  }






  

}



public function showproduct(Request $request,$name,$id){
    $product_tbl=product_tbl::findOrFail($id);
return view('frontend.product.showproduct')->with(['product_tbl'=>$product_tbl, 'name'=>$name]);}



public function add_to_cart(Request $request){
    $validatedData = $request->validate([
        'color' => 'max:11',
        'size' => 'max:11',
        'quantity' => 'required|max:4',
    ]);

     $color=$request->input("color");
     $size=$request->input("size");
     $quantity=$request->input("quantity");
     $product_id=$request->input("product_id");
       
        $product_tbl=product_tbl::findOrFail($product_id);
        $shop_id="{$product_tbl->user_id}";
        $product_tbl_stock="{$product_tbl->stock}";


      if ($color !== Null || $size !== Null) {
        $product_price=product_attri_tbl::where('product_id', $product_id)->where('color', $color)->where('size', $size)->first()->price;
        $product_stock=product_attri_tbl::where('product_id', $product_id)->where('color', $color)->where('size', $size)->first()->stock;

        if($quantity > $product_stock){$quantity=$product_stock;}
      }

      else{
        $product_price="{$product_tbl->price}";
        if($quantity > $product_tbl_stock){$quantity=$product_tbl_stock;}
      }


    $table_name=new cart_tbl;
    $table_name->shop_id=$shop_id;
    $table_name->color=$request->input("color");
    $table_name->size=$request->input("size");
    $table_name->product_id=$request->input("product_id");
    $table_name->user_id=Auth::user()->id;

    // quantity
    $quantity=$request->input("quantity");
    if(empty($quantity)){$table_name->quantity='1';}
    else{$table_name->quantity=$quantity;}

  $table_name->save();

  $product_cart_status="আপনার কার্টে প্রোডাক্টটি যুক্ত করা হয়েছে";
  toast("$product_cart_status",'success');
return back()->with(['product_cart_status'=>$product_cart_status]);
}





public function checkout(Request $request){
  $Auth_id=Auth::user()->id;
  $cart_tbl=cart_tbl::where('user_id',$Auth_id)->get();

  foreach ($cart_tbl as $cart_tbl) {
     $id="$cart_tbl->id";
     $color="$cart_tbl->color";
     $size="$cart_tbl->size";
     $quantity="$cart_tbl->quantity";
     $product_id="$cart_tbl->product_id";


      if( !empty($color) || !empty($size)){
        $product_attri=product_attri_tbl::where('product_id', $product_id)->where('color', $color)->where('size', $size)->first();
        $product_in_stock="{$product_attri->stock}";
      }
      else{

                  $product_details=product_tbl::find($product_id);
                      $price="{$product_details->price}";
                      $product_in_stock_to_check="{$product_details->stock}";

                      if( !empty($product_in_stock_to_check)){
                            $product_in_stock="{$product_details->stock}";
                      }
                      else{ $product_in_stock=1000; }

      }

      if($quantity > $product_in_stock){ 
        $cart_tbl=cart_tbl::find($id);
        $cart_tbl->delete();
      }
  }
return view('frontend.product.checkout')->with(['cart_product'=>'']);
}


public function cart(Request $request){
  if (!Auth::guest()){
    $Auth_user_id=Auth::user()->id;
    $cart_product=cart_tbl::orderBy('id', 'desc')->where('user_id',$Auth_user_id)->get();
  }
  else{
    $cart_product="cart_product";
  }
return view('frontend.product.cart')->with(['cart_product'=>$cart_product]);}

public function delete_from_cart(Request $request){
  $id=$request->input('id');
  $id=cart_tbl::findOrFail($id);
    $Auth_user_id=Auth::user()->id;
    $cart_user_id="$id->user_id";
    if($Auth_user_id==$cart_user_id){
    $id->delete();
    $status="প্রডাক্টটি আপনার কার্ট থেকে ডিলিট করা হয়েছে";
    toast("$status",'success');
    }
    else{
     $status="There are some error";
      alert()->Error('Error','There are some error');
    }
return back()->with('status', $status);}


public function update_cart(Request $request){
    $Auth_user_id=Auth::user()->id;
  $total_loop=$request->input('total_loop');
  for($i=1;$i<=$total_loop;$i++){
    $ids="id".$i;
    $quantities="quantity".$i;

  $id=$request->input($ids);
  $quantity=$request->input($quantities);
  $table_name=cart_tbl::find($id);
    $cart_user_id="$table_name->user_id";
      if($Auth_user_id==$cart_user_id){
         $product_id="$table_name->product_id";
         $stock_desc=product_tbl::find($product_id)->stock_desc;

              if($stock_desc == "in"){
            $table_name->quantity=$quantity;
            $table_name->update();
          }
          else{ 
           $cart_tbl=cart_tbl::find($id);
         $cart_tbl->delete();
          }

      }
  }


  $status="আপনার কার্ট আপডেট করা হয়েছে";
  toast("$status",'success');
return back()->with('status', $status);
}





public function order_place(Request $request){
if($request->input("name")==NULL){$error="you have to Input your name";alert()->Error('Error',$error);return back()->with('error', $error);}
if($request->input("email")==NULL){$error="you have to Input your email";alert()->Error('Error',$error);return back()->with('error', $error);}
if($request->input("phone")==NULL){$error="you have to Input your phone";alert()->Error('Error',$error);return back()->with('error', $error);}
if($request->input("address")==NULL){$error="you have to Input your address";alert()->Error('Error',$error);return back()->with('error', $error);}
if($request->input("police_station")==NULL){$error="you have to Input your police_station";alert()->Error('Error',$error);return back()->with('error', $error);}
if($request->input("district")==NULL){$error="you have to Input your district";alert()->Error('Error',$error);return back()->with('error', $error);}
if($request->input("payment")==NULL){$error="you have to Choose your payment method";alert()->Error('Error',$error);return back()->with('error', $error);}
// if($request->input("payment")=="Cash"){
//   if($request->input("cash_shipping_payment")==NULL){$error="ক্যাশে পেমেন্ট করার জন্যে আগে ডেলিভারি চার্জ দিতে হবে এবং তা নির্দিষ্ট স্থানে উল্লেখ করে দিতে হবে।";alert()->Error('Error',$error);return back()->with('error', $error);}
// }




$affiliate_payment_count=0;

  $Auth_id=Auth::user()->id;
  $cart_shop_count=cart_tbl::where('user_id',$Auth_id)->select('shop_id')->distinct('shop_id')->count();
  $cart_shop=cart_tbl::where('user_id',$Auth_id)->select('shop_id')->distinct('shop_id')->get();

  foreach ($cart_shop as $cart_shop) {


    // order_id_will
      $order_tbl_count=order_tbl::all()->count();
      if($order_tbl_count>0){
        $last_order_id=order_tbl::orderBy('id', 'desc')->first()->id;
      }
       else{$last_order_id=0;}
       $order_id_will=$last_order_id+1;


    //Adding to order details
      $ultimate_price=0;
      $auth_id=Auth::user()->id;
      $shop_id=$cart_shop->shop_id;
      $user_cart_tbl=cart_tbl::where('user_id',$auth_id)->where('shop_id',$cart_shop->shop_id)->get();
    foreach ($user_cart_tbl as $data) {
      $table_name=new order_detail_tbl;
      $table_name->product_id="{$data->product_id}";
      $table_name->color="{$data->color}";
      $table_name->size="{$data->size}";
      $table_name->shop_id=$shop_id;
      $table_name->order_id=$order_id_will;

        //quantity
        $product_quantity="{$data->quantity}";
        $table_name->quantity=$product_quantity;

        //Price
          $color="{$data->color}";
          $size="{$data->size}";
 
            if( !empty($color) || !empty($size)){
              $product_price=product_attri_tbl::where('product_id', $data->product_id)->where('color', $color)->where('size', $size)->first()->price;}
            else{$product_price=product_tbl::findOrFail($data->product_id)->price;}

          $table_name->price=$product_price;

        // Reffered by
          $Auth_referred_by=Auth::user()->referred_by;
          $table_name->referred_by=$Auth_referred_by;


        //affiliate_payment
          $product_affiliate_percentage=product_tbl::findOrFail($data->product_id)->affiliate_percentage;

              $product_affiliate_percentage=floatval($product_affiliate_percentage);
              $product_price=floatval($product_price);
          $exact_affiliate_payment=$product_price*($product_affiliate_percentage/100);

          $affiliate_payment_count=$affiliate_payment_count+$exact_affiliate_payment;

          $table_name->affiliate_payment=$exact_affiliate_payment;

         


        //user_id
        $product_auth_id=product_tbl::findOrFail($data->product_id)->user_id;
        $table_name->product_auth_id=$product_auth_id;

      //order_detail_tbl
      $table_name->save();



      $total_price=$product_price*$product_quantity;
      $ultimate_price=$total_price+$ultimate_price;
    }

    //Erase User cart
      $user_cart_tbl=cart_tbl::where('user_id',$auth_id)->delete();
    
      $district=$request->input("district");
      $shipping_tbl_count=shipping_tbl::where('district',$district)->count();
      if ($shipping_tbl_count>0) {
        $shipping_price=shipping_tbl::where('district',$district)->first()->price;
        $shipping_time=shipping_tbl::where('district',$district)->first()->time;}
      else {
        $shipping_price=shipping_tbl::where('district',"Other")->first()->price;
        $shipping_time=shipping_tbl::where('district',"Other")->first()->time;}

      $total_product_price=$ultimate_price;
      $product_price_with_delivary=$ultimate_price+$shipping_price;




    $order_code_will="#or".$order_id_will;
    $table_name=new order_tbl;
      $table_name->user_id=$auth_id;
      $table_name->order_code=$order_code_will;
      $table_name->product_price=$total_product_price;
      $table_name->shipping_price=$shipping_price;
      $table_name->shipping_time=$shipping_time;
      $table_name->shop_id=$cart_shop->shop_id;
      $table_name->name=$request->input("name");
      $table_name->email=$request->input("email");
      $table_name->phone=$request->input("phone");
      $table_name->address=$request->input("address");
      $table_name->police_station=$request->input("police_station");
      $table_name->district=$request->input("district");
      $table_name->description=$request->input("description");
      $table_name->payment=$request->input("payment");
      $table_name->transection_code=$request->input("transection_code");


      $Auth_referred_by=Auth::user()->referred_by;
      $table_name->referred_by=$Auth_referred_by;

      $table_name->affiliate_payment=$affiliate_payment_count;

        if($request->input("payment")=="Cash"){
        $table_name->cash_shipping_payment=$request->input("cash_shipping_payment");
        $table_name->cash_shipping_code=$request->input("cash_shipping_code");
      }
    $table_name->save();

  }

$added_cart="আপনার অর্ডারটি নেয়া হয়েছে";
alert()->success('success',"$added_cart");
return redirect('profile/orderlist')->with(['added_cart'=>$added_cart]);

}













}
