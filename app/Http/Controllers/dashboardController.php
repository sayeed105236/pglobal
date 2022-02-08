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
use App\admin\payment_tbl;
use App\admin\category_tbl;
use Illuminate\Http\Request;
use App\admin\notification_tbl;
use App\admin\payment_detail_tbl;
use Illuminate\Support\Facades\Validator;

class dashboardController extends Controller
{

    public function index(){
    return view('backend.index')->with(['users'=>"hi"]);}





public function withdraw_manage(){
return view('backend.withdraw.withdraw_manage')->with(['users'=>"hi"]);}

public function pending_withdraw(Request $request){
  $payment_tbl=payment_tbl::orderBy('id', 'desc')->where("status","pending")->paginate(30);
return view('backend.withdraw.pending_withdraw')->with(['payment_tbl'=>$payment_tbl]);}


public function update_withdraw(Request $request){
  $id=$request->input('id');
  $table_name=payment_tbl::find($id);

    $status=$request->input('status');
    // On Cancel
    if($status=="canceled"){
      $amount=$table_name->amount;
      $withdraw_charge= raw_tbl::where('type', 'withdraw')->where('section', 'withdraw_charge')->first()->value;
      $charge=100/(100-$withdraw_charge);
      $final_amount=$amount*$charge;
      $final_amount=(int)$final_amount;



      $user_id=$table_name->user_id;
      $Auth_user=User::findOrFail($user_id);
          $Auth_taka_amount=$Auth_user->taka_amount;
         echo $user_final_amount=$Auth_taka_amount+$final_amount;
        $Auth_user->taka_amount=$user_final_amount;
      $Auth_user->update();


      $main_status="canceled";
    }
    // On Approve
    else{
      $main_status="approved";
    }


    $table_name->status=$main_status;
  $table_name->update();
alert()->success('Updated','Well done! Updated Successfully!');
return back()->with('status', 'Well done! Updated Success!');
}




public function transaction(Request $request){
  $Auth_id=Auth::User()->id;
  $payment_tbl=payment_tbl::orderBy('id', 'desc')->where("user_id",$Auth_id)->paginate(30);
return view('transaction')->with(['payment_tbl'=>$payment_tbl]);}


// in one page
public function withdraw(Request $request){
    //dd($request);
    $gateway=$request->input("gateway");
    $account_name=$request->input("account_name");
    $bank_number=$request->input("bank_number");
    $account_type=$request->input("account_type");
    $bank_name=$request->input("bank_name");
    $bank_branch=$request->input("bank_branch");
    $phone=$request->input("phone");

return view('withdraw')->with(['gateway'=>$gateway, 'account_name'=>$account_name, 'bank_number'=>$bank_number, 'account_type'=>$account_type, 'bank_name'=>$bank_name, 'bank_branch'=>$bank_branch, 'phone'=>$phone]);
}


public function withdraw_request(Request $request){
    //dd($request);
  $gateway=$request->input("gateway");

  if($gateway == "Bkash" || $gateway == "Rocket" || $gateway == "Nagad"){

    $phone=$request->input("phone");
    if ($phone == Null) { 
      $status="You need to give phone number to proceed your withdraw by Bkash, Nagad or Rocket!";
      alert()->error('Error',$status);
      return back()->with('status', $status);}

    $phone_account_type=$request->input("phone_account_type");
    if ($phone_account_type == Null) {
      $status="You need to give your account type to proceed your withdraw by Bkash, Nagad or Rocket!";
      alert()->error('Error',$status);
      return back()->with('status', $status);}

      $last_account_type=$phone_account_type;
  }

  else{
    $bank_name=$request->input("bank_name");
    if ($bank_name == Null) { 
      $status="You need to give Bank nameto proceed your withdraw by Bank!";
      alert()->error('Error',$status);
      return back()->with('status', $status);}

    $bank_account_type=$request->input("bank_account_type");
    if ($bank_account_type == Null) {
      $status="You need to give your account type to proceed your withdraw by Bank!";
      alert()->error('Error',$status);
      return back()->with('status', $status);}

    $bank_number=$request->input("bank_number");
    if ($bank_number == Null) { 
      $status="You must give Bank Account number to proceed your withdraw by Bank!";
      alert()->error('Error',$status);
      return back()->with('status', $status);}

    $bank_branch=$request->input("bank_branch");
    if ($bank_branch == Null) {
      $status="You need to give your bank branch type to proceed your withdraw by Bank!";
      alert()->error('Error',$status);
      return back()->with('status', $status);}

      $last_account_type=$bank_account_type;
  }

    //Amount
    $min_w= raw_tbl::where('type', 'withdraw')->where('section', 'minimum_withdraw_amount')->first()->value;
    $max_w= raw_tbl::where('type', 'withdraw')->where('section', 'maximum_withdraw_amount')->first()->value;
    $amount=$request->input("amount");

      $Auth_taka_amount=Auth::user()->taka_amount;

    if($amount>$Auth_taka_amount){
        $status="You do not have ৳$amount balance";
        alert()->error('Error',$status);
        return back()->with('status', $status);}

    if($amount<$min_w){
        $status="Your mimimum withdraw limit is $min_w";
        alert()->error('Error',$status);
        return back()->with('status', $status);}
    if($amount>$max_w){
        $status="Your maximum withdraw limit is $max_w";
        alert()->error('Error',$status);
        return back()->with('status', $status);}


    $withdraw_charge= raw_tbl::where('type', 'withdraw')->where('section', 'withdraw_charge')->first()->value;
    $charge=$amount*($withdraw_charge/100);
    $final_amount=$amount-$charge;

      // Payment Id
      $count_payment_id=payment_tbl::count();
      if($count_payment_id == 0){
        $next_payment_id=1;
      }
      else{
        $last_payment_id=payment_tbl::orderBy('id', 'desc')->first()->id;
        $next_payment_id=$last_payment_id+1;
      }
      $next_payment_id;

  $payment_tbl=new payment_tbl;
    $payment_tbl->user_id=Auth::User()->id;
    $payment_tbl->title="Withdraw";
    $payment_tbl->type="Debited";
    $payment_tbl->amount=$final_amount;
    $payment_tbl->description=$request->input("description");
  $payment_tbl->save();



  $payment_detail_tbl=new payment_detail_tbl;
    $payment_detail_tbl->payment_id=$next_payment_id;
    $payment_detail_tbl->user_id=Auth::User()->id;
    $payment_detail_tbl->gateway=$request->input("gateway");
    $payment_detail_tbl->phone=$request->input("phone");
    $payment_detail_tbl->account_type=$last_account_type;
    $payment_detail_tbl->account_name=$request->input("account_name");
    $payment_detail_tbl->bank_name=$request->input("bank_name");
    $payment_detail_tbl->bank_number=$request->input("bank_number");
    $payment_detail_tbl->bank_branch=$request->input("bank_branch");
  $payment_detail_tbl->save();


  $Auth_id=Auth::User()->id;;
  $Auth_user=User::findOrFail($Auth_id);
      $Auth_taka_amount=$Auth_user->taka_amount;
      $user_final_amount=$Auth_taka_amount-$amount;
    $Auth_user->taka_amount=$user_final_amount;
  $Auth_user->update();

$status="Well done! withdraw has been submitted";
alert()->success('Added',$status);
return redirect('transaction')->with('status', $status);
}


//fnq
public function fnq(Request $request){
  $section=$request->input("section");
  $raw_tbl=raw_tbl::where("type","fnq")->where("section",$section)->paginate(30);;
return view('backend.fnq.index')->with(['raw_tbl'=>$raw_tbl, 'section'=>$section]);}

public function insert_fnq(Request $request){
  $table_name=new raw_tbl;
    $table_name->type=$request->input("type");
    $table_name->section=$request->input("section");
    $table_name->title=$request->input("title");
    $table_name->description=$request->input("description");
  $table_name->save();
alert()->success('Added','Well done! F&Q Added Successfully!');
return back()->with('status', 'Well done! Added Success!');}

public function delete_fnq(Request $request){
  $id=$request->input('id');
  $id=raw_tbl::findOrFail($id);
  $id->delete();
  alert()->error('Deleted','The that F&Q has been Deleted');
return back()->with('status', 'Data Deleted');}

public function update_fnq(Request $request){
  $id=$request->input('id');
  $table_name=raw_tbl::find($id);
    $table_name->title=$request->input("title");
    $table_name->description=$request->input("description");
  $table_name->update();
  $id=$request->input('id');
alert()->success('Updated','Well done! F&Q Updated Successfully!');
return back()->with('status', 'Well done! Updated Success!');}


//page
public function page(Request $request){
  $page_tbl=page_tbl::orderBy('id', 'desc')->paginate(30);
return view('backend.page.index')->with(['page_tbl'=>$page_tbl]);}

public function add_page(){
  $d_parent_id= DB::table('page_tbl')->select('name','id')->get();
return view('backend.page.add_page')->with(['d_parent_id'=>$d_parent_id]);}

public function insert_page(Request $request){
    $validatedData = $request->validate([
        'name' => 'required|max:191',
        'description' => 'required|max:16777200',]);

  $table_name=new page_tbl;
    $table_name->name=$request->input("name");
    $table_name->description=$request->input("description");
  $table_name->save();
alert()->success('Added','Well done! page Added Successfully!');
return redirect('makecommand/page')->with('status', 'Well done! Added Success!');}

public function edit_page(Request $request){
  $id=$request->input("id");
  $id=page_tbl::findOrFail($id);
return view('backend.page.edit_page')->with(['id'=>$id]);} 

public function update_page(Request $request){
    $validatedData = $request->validate([
      'name' => 'required|max:191',
      'description' => 'required|max:16777200',]);
    
    $id=$request->input('id');
    $table_name=page_tbl::find($id);
      $table_name->name=$request->input("name");
      $table_name->description=$request->input("description");
    $table_name->update();
    $id=$request->input('id');
alert()->success('Updated','Well done! page Updated Successfully!');
return back()->with('status', 'Well done! Updated Success!');}

public function delete_page(Request $request){
  $id=$request->input('id');
  $id=page_tbl::findOrFail($id);
  $id->delete();
alert()->error('Deleted','The page has been Deleted');
return back()->with('status', 'Data Deleted');}




//Category
public function category(Request $request){
  $d_parent_id= DB::table('category_tbl')->select('parent_id')->distinct()->get();

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $category_tbl=category_tbl::orderBy('id', 'desc')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{$category_tbl=category_tbl::orderBy('id', 'desc')->paginate(30);}

return view('backend.category.index')->with(['category_tbl'=>$category_tbl, 'd_parent_id'=>$d_parent_id,'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_category(Request $request){
    $orderby=$request->input("orderby");
    $ordertype=$request->input("ordertype");
  $d_parent_id= DB::table('category_tbl')->select('parent_id')->distinct()->get();

    $search=$request->input("search");
    $search_by=$request->input("search_by");

    //have search
  if( !empty($search)){
      // Date
        $dfrom=$request->input("dfrom");
        $dto=$request->input("dto");
        if( !empty($dfrom) or  !empty($dto) ){
           $category_tbl = category_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
        else{
           $category_tbl = category_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
    return view('backend.category.index')->with(['category_tbl'=>$category_tbl, 'search_by'=>$search_by,'search'=>$search, 'd_parent_id'=>$d_parent_id,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $category_tbl=category_tbl::orderBy($orderby, $ordertype)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$category_tbl=category_tbl::orderBy($orderby, $ordertype)->paginate(30);}
  return view('backend.category.index')->with(['category_tbl'=>$category_tbl, 'd_parent_id'=>$d_parent_id,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_category(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");
  $d_parent_id= DB::table('category_tbl')->select('parent_id')->distinct()->get();

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $category_tbl = category_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $category_tbl = category_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend..category.index')->with(['category_tbl'=>$category_tbl, 'search_by'=>$search_by,'search'=>$search, 'd_parent_id'=>$d_parent_id,'dfrom'=>$dfrom, 'dto'=>$dto]);}




public function add_category(){
  $d_parent_id= DB::table('category_tbl')->select('name','id')->get();
return view('backend.category.add_category')->with(['d_parent_id'=>$d_parent_id]);}

public function insert_category(Request $request){
  $table_name=new category_tbl;
    $name=$request->input("name");

      $name=str_replace("'", '', $name);
      $name=str_replace("&", 'and', $name);

    $name_c=category_tbl::all()->where("name",$name)->count();
    if($name_c>0){
      $status="There are already a category on This name! You cannot duplicate category! You have to give an Unique name";
      alert()->error('Duplicate',"$status");
      return redirect('makecommand/add_category')->with('status', $status);}
    else{$table_name->name=$name;}

    $table_name->description=$request->input("description");
    $table_name->parent_id=$request->input("parent_id");
    $status=$request->input("status");
      if($status==1){$table_name->status="1";}
      else{$table_name->status="0";}

    if ($request->hasfile('icon')) {
      $img=$request->file('icon'); 
        $image_all_name = $img->getClientOriginalName();
        $name_slug = pathinfo($image_all_name, PATHINFO_FILENAME);
        $filename = $name_slug.'-'.time().'.'.$img->getClientOriginalExtension();

      Image::make($img)->resize(150,150)->save('public/allfiles/img/' .$filename);
      Image::make($img)->resize(25,25)->save('public/allfiles/img/category/' .$filename);


      $table_name->icon=$filename;}

  $table_name->save();
  alert()->success('Added','Well done! Category Added Successfully!');
return redirect('makecommand/category')->with('status', 'Well done! Added Success!');}

public function delete_category(Request $request){
  $id=$request->input('id');
  $id=category_tbl::findOrFail($id);
      $icon="{$id->icon}";

      $image_path = "public/allfiles/img/$icon";  
      if (file_exists($image_path)) {@unlink($image_path);}

      $image_path = "public/allfiles/img/category/$icon";  
      if (file_exists($image_path)) {@unlink($image_path);}

    $id->delete();
  alert()->error('Deleted','The Category has been Deleted');
return back()->with('status', 'Data Deleted');}

public function edit_category(Request $request){
  $id=$request->input("id");
  $id=category_tbl::findOrFail($id);
  $d_parent_id= DB::table('category_tbl')->select('name','id')->get();
return view('backend.category.edit_category')->with(['id'=>$id,'d_parent_id'=>$d_parent_id]);} 

public function update_category(Request $request){
 $id=$request->input('id');
  $table_name=category_tbl::find($id);
    $name=$request->input("name");

      $name=str_replace("'", '', $name);
      $name=str_replace("&", 'and', $name);
      
    $pr_name=$request->input("pr_name");
    $name_c=category_tbl::all()->where("name",$name)->count();
    if($name_c>0){
      if($pr_name==$name){$table_name->name=$name;}
      else{
      $status="There are already a category on This name! You cannot duplicate category! You have to give an Unique name";
      alert()->error('Duplicate',"$status");
      return redirect('makecommand/add_category')->with('status', $status);}
    }
    else{$table_name->name=$name;}
    $table_name->description=$request->input("description");
    $table_name->parent_id=$request->input("parent_id");
    $status=$request->input("status");
      if($status==1){$table_name->status="1";}
      else{$table_name->status="0";}

    if ($request->hasfile('icon')) {
      $img=$request->file('icon');  echo "string";
        $id=category_tbl::findOrFail($id);
            $pr_icon="{$id->icon}";

        $image_path = "public/allfiles/img/$pr_icon";  
        if (file_exists($image_path)) {@unlink($image_path);}

          $image_path = "public/allfiles/img/category/$pr_icon";  
          if (file_exists($image_path)) {@unlink($image_path);}


          $image_all_name = $img->getClientOriginalName();
          $name_slug = pathinfo($image_all_name, PATHINFO_FILENAME);
        $filename = $name_slug.'-'.time().'.'.$img->getClientOriginalExtension();

      Image::make($img)->resize(150,150)->save('public/allfiles/img/' .$filename);
      Image::make($img)->resize(25,25)->save('public/allfiles/img/category/' .$filename);

      $table_name->icon=$filename;}

  $table_name->update();
 $id=$request->input('id');
  alert()->success('Updated','Well done! Category Updated Successfully!');
return redirect("makecommand/category?id=$id")->with('status', 'Well done! Updated Success!');}


//manufacturer
public function manufacturer(Request $request){
  $d_parent_id= DB::table('manufacturer_tbl')->select('parent_id')->distinct()->get();

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $manufacturer_tbl=manufacturer_tbl::orderBy('id', 'desc')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{$manufacturer_tbl=manufacturer_tbl::orderBy('id', 'desc')->paginate(30);}

return view('backend.manufacturer.index')->with(['manufacturer_tbl'=>$manufacturer_tbl, 'd_parent_id'=>$d_parent_id,'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_manufacturer(Request $request){
    $orderby=$request->input("orderby");
    $ordertype=$request->input("ordertype");
  $d_parent_id= DB::table('manufacturer_tbl')->select('parent_id')->distinct()->get();

    $search=$request->input("search");
    $search_by=$request->input("search_by");

    //have search
  if( !empty($search)){
      // Date
        $dfrom=$request->input("dfrom");
        $dto=$request->input("dto");
        if( !empty($dfrom) or  !empty($dto) ){
           $manufacturer_tbl = manufacturer_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
        else{
           $manufacturer_tbl = manufacturer_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
    return view('backend.manufacturer.index')->with(['manufacturer_tbl'=>$manufacturer_tbl, 'search_by'=>$search_by,'search'=>$search, 'd_parent_id'=>$d_parent_id,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $manufacturer_tbl=manufacturer_tbl::orderBy($orderby, $ordertype)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$manufacturer_tbl=manufacturer_tbl::orderBy($orderby, $ordertype)->paginate(30);}
  return view('backend.manufacturer.index')->with(['manufacturer_tbl'=>$manufacturer_tbl, 'd_parent_id'=>$d_parent_id,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_manufacturer(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");
  $d_parent_id= DB::table('manufacturer_tbl')->select('parent_id')->distinct()->get();

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $manufacturer_tbl = manufacturer_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $manufacturer_tbl = manufacturer_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend..manufacturer.index')->with(['manufacturer_tbl'=>$manufacturer_tbl, 'search_by'=>$search_by,'search'=>$search, 'd_parent_id'=>$d_parent_id,'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function add_manufacturer(){
  $d_parent_id= DB::table('manufacturer_tbl')->select('name','id')->get();
return view('backend.manufacturer.add_manufacturer')->with(['d_parent_id'=>$d_parent_id]);}

public function insert_manufacturer(Request $request){
  $table_name=new manufacturer_tbl;
    $name=$request->input("name");
    $name_c=manufacturer_tbl::all()->where("name",$name)->count();
    if($name_c>0){
      $status="There are already a manufacturer on This name! You cannot duplicate manufacturer! You have to give an Unique name";
      alert()->error('Duplicate',"$status");
      return redirect('makecommand/add_manufacturer')->with('status', $status);}
    else{$table_name->name=$name;}

    $table_name->description=$request->input("description");
    $table_name->parent_id=$request->input("parent_id");
    $status=$request->input("status");
      if($status==1){$table_name->status="1";}
      else{$table_name->status="0";}
    if ($request->hasfile('icon')) {
      $img=$request->file('icon');  
        $image_all_name = $img->getClientOriginalName();
        $name_slug = pathinfo($image_all_name, PATHINFO_FILENAME);
        $filename = $name_slug.'-'.time().'.'.$img->getClientOriginalExtension();
      Image::make($img)->save('public/allfiles/img/' .$filename);
      $table_name->icon=$filename;}
  $table_name->save();
  alert()->success('Added','Well done! manufacturer Added Successfully!');
return redirect('makecommand/manufacturer')->with('status', 'Well done! Added Success!');}

public function delete_manufacturer(Request $request){
  $id=$request->input('id');
  $id=manufacturer_tbl::findOrFail($id);
      $icon="{$id->icon}";
      $image_path = "public/allfiles/img/$icon";  
      if (file_exists($image_path)) {@unlink($image_path);}
    $id->delete();
  alert()->error('Deleted','The manufacturer has been Deleted');
return back()->with('status', 'Data Deleted');}

public function edit_manufacturer(Request $request){
  $id=$request->input("id");
  $id=manufacturer_tbl::findOrFail($id);
  $d_parent_id= DB::table('manufacturer_tbl')->select('name','id')->get();
return view('backend.manufacturer.edit_manufacturer')->with(['id'=>$id,'d_parent_id'=>$d_parent_id]);} 

public function update_manufacturer(Request $request){
 $id=$request->input('id');
  $table_name=manufacturer_tbl::find($id);
    $name=$request->input("name");
    $pr_name=$request->input("pr_name");
    $name_c=manufacturer_tbl::all()->where("name",$name)->count();
    if($name_c>0){
      if($pr_name==$name){$table_name->name=$name;}
      else{
      $status="There are already a manufacturer on This name! You cannot duplicate manufacturer! You have to give an Unique name";
      alert()->error('Duplicate',"$status");
      return redirect('makecommand/add_manufacturer')->with('status', $status);}
    }
    else{$table_name->name=$name;}
    $table_name->description=$request->input("description");
    $table_name->parent_id=$request->input("parent_id");
    $status=$request->input("status");
      if($status==1){$table_name->status="1";}
      else{$table_name->status="0";}
    if ($request->hasfile('icon')) {
      $img=$request->file('icon');  echo "string";
        $id=manufacturer_tbl::findOrFail($id);
            $pr_icon="{$id->icon}";
        $image_path = "public/allfiles/img/$pr_icon";  
        if (file_exists($image_path)) {@unlink($image_path);}
          $image_all_name = $img->getClientOriginalName();
          $name_slug = pathinfo($image_all_name, PATHINFO_FILENAME);
          $filename = $name_slug.'-'.time().'.'.$img->getClientOriginalExtension();
      Image::make($img)->save('public/allfiles/img/' .$filename);
      $table_name->icon=$filename;}
  $table_name->update();
 $id=$request->input('id');
  alert()->success('Updated','Well done! manufacturer Updated Successfully!');
return redirect("makecommand/manufacturer?id=$id")->with('status', 'Well done! Updated Success!');}






//customize
public function visual_customization(Request $request){
    $type=$request->input("type");
  $customize_tbl= DB::table('raw_tbl')->where('type', $type)->latest()->first();
  $customize_tbl_count= DB::table('raw_tbl')->where('type', $type)->count();

  $home_feature= raw_tbl::where('type', "home")->where('section',"home feature")->get();
  $home_small_feature= raw_tbl::where('type', "home")->where('section',"home small feature")->get();
return view('frontend.customize.visual_customization')->with(['home_small_feature'=>$home_small_feature,'home_feature'=>$home_feature,'customize_tbl'=>$customize_tbl,'customize_tbl_count'=>$customize_tbl_count, 'type'=>$type]);}


//customize
public function show_layout(Request $request){
return view('frontend.customize.show_layout')->with(['type'=>'type']);}



//customize
public function customize(Request $request){
    $type=$request->input("type");
  $customize_tbl= DB::table('raw_tbl')->where('type', $type)->latest()->first();
  $customize_tbl_count= DB::table('raw_tbl')->where('type', $type)->count();

  $home_feature= raw_tbl::where('type', "home")->where('section',"home feature")->get();
  $home_small_feature= raw_tbl::where('type', "home")->where('section',"home small feature")->get();
return view('backend.customize.index')->with(['home_small_feature'=>$home_small_feature,'home_feature'=>$home_feature,'customize_tbl'=>$customize_tbl,'customize_tbl_count'=>$customize_tbl_count, 'type'=>$type]);}


public function insert_customize(Request $request){
  $table_name=new raw_tbl;

    $type=$request->input("type");
    if ($type !== Null) { $table_name->type=$request->input("type");}

    $section=$request->input("section");
    if ($section !== Null) { $table_name->section=$request->input("section");}

    $description=$request->input("description");
    if ($description !== Null) { $table_name->description=$request->input("description");}

    $btn=$request->input("btn");
    if ($btn !== Null) { $table_name->btn=$request->input("btn");}

    $url=$request->input("url");
    if (! $url==Null) { $table_name->url=$request->input("url");}

    $layout=$request->input("layout");
    if (! $layout==Null) { $table_name->layout=$request->input("layout");}

    $category=$request->input("category");
    if (! $category==Null) { $table_name->category=$request->input("category");}



    
    if ($request->hasfile('image')) {

      $img=$request->file('image');
      $filename=time().'.'.$img->getClientOriginalExtension();

       $image_w=$request->input("image_w");
       $image_h=$request->input("image_h");

      Image::make($img)->resize("$image_w","$image_h")->save('public/allfiles/img/customize/' .$filename);
      $table_name->image=$filename;
    }
    
  $table_name->save();
  alert()->success('Added','Well done! Category Added Successfully!');

return back()->with('status', 'Well done! Added Success!');}





public function update_customize(Request $request){
 $id=$request->input('id');
  $table_name=raw_tbl::find($id);

    $value=$request->input("value");
    if ($value !== Null) { $table_name->value=$request->input("value");}

    $type=$request->input("type");
    if ($type !== Null) { $table_name->type=$request->input("type");}

    $section=$request->input("section");
    if ($section !== Null) { $table_name->section=$request->input("section");}

    $description=$request->input("description");
    if ($description !== Null) { $table_name->description=$request->input("description");}

    $btn=$request->input("btn");
    if ($btn !== Null) { $table_name->btn=$request->input("btn");}

    $url=$request->input("url");
    if (! $url==Null) { $table_name->url=$request->input("url");}

    $layout=$request->input("layout");
    if (! $layout==Null) { $table_name->layout=$request->input("layout");}

    $category=$request->input("category");
    if (! $category==Null) { $table_name->category=$request->input("category");}

    
    if ($request->hasfile('image')) {
          $id=raw_tbl::findOrFail($id);
          $pr_icon="{$id->image}";
          $image_path = "public/allfiles/img/customize/$pr_icon";  
          if (file_exists($image_path)) {@unlink($image_path);}
      $img=$request->file('image');
      $filename=time().'.'.$img->getClientOriginalExtension();

       $image_w=$request->input("image_w");
       $image_h=$request->input("image_h");

      Image::make($img)->resize("$image_w","$image_h")->save('public/allfiles/img/customize/' .$filename);
      $table_name->image=$filename;
    }

  $table_name->update();
  alert()->success('Updated','Well done! Category Updated Successfully!');

return back()->with('status', 'Well done! Updated Success!');}



public function delete_customized_section(Request $request){
  $id=$request->input('id');
  $id=raw_tbl::findOrFail($id);
          $pr_icon="{$id->image}";
          $image_path = "public/allfiles/img/customize/$pr_icon";  
          if (file_exists($image_path)) {@unlink($image_path);}
  $id->delete();
  alert()->error('Deleted','The Section has been Deleted');
return back()->with('status', 'Data Deleted');}










//user
public function user(Request $request){
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $User=User::orderBy('id', 'desc')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
    } 
    else{$User=User::orderBy('id', 'desc')->paginate(30);}
return view('backend.user.index')->with(['User'=>$User, 'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_user(Request $request){
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
           $User = User::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
        else{
           $User = User::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
    return view('backend.user.index')->with(['User'=>$User, 'search_by'=>$search_by,'search'=>$search, 'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $User=User::orderBy($orderby, $ordertype)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$User=User::orderBy($orderby, $ordertype)->paginate(30);}
  return view('backend.user.index')->with(['User'=>$User,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_user(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $User = User::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $User = User::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend.user.index')->with(['User'=>$User, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}




public function edit_user(Request $request){
  $id=$request->input("user_code");
  $id=User::findOrFail($id);
return view('backend.user.edit_user')->with(['id'=>$id]);} 


public function update_user(Request $request){
  $id=$request->input("id");
  $table_name=User::findOrFail($id);
    $table_name->usertype=$request->input("usertype");
    $table_name->status=$request->input("status");

    $user_approve=$table_name->approve;
    if($user_approve == 0){
      $input_approve=$request->input("approve");


      if($input_approve == 1){
        $table_name->approve=1;
        $user_request_role=$table_name->request_role;

        if($user_request_role == "vendor"){
          $table_name->usertype="vendor";
          $table_name->request_role="complete vendor";
        }

        elseif($user_request_role == "affiliate" || $user_request_role == "complete affiliate"){
          $table_name->usertype="affiliate";
          $table_name->request_role="complete affiliate";
        }

        elseif($user_request_role == "dealer"){
          $table_name->usertype="dealer";
          $table_name->request_role="complete dealer";
        }
        else{
          $table_name->usertype="user";
          $table_name->request_role="user";
        }
      }
      elseif($input_approve == 3){
        $table_name->approve=3;
          $table_name->usertype="user";
          $table_name->request_role="user";
      }

    }


  $table_name->update();
  $status="Well done!!! User Updated";
alert()->success('Updated',"$status");
return back()->with('status', "$status");}







public function pending_user(Request $request){
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $User=User::orderBy('id', 'desc')->where('approve', 0)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);
    } 
    else{$User=User::orderBy('id', 'desc')->where('approve', 0)->paginate(30);}
return view('backend.user.pending_user')->with(['User'=>$User, 'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_pending_user(Request $request){
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
           $User = User::orderBy($orderby, $ordertype)->where('approve', 0)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
        else{
           $User = User::orderBy($orderby, $ordertype)->where('approve', 0)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
    return view('backend.user.pending_user')->with(['User'=>$User, 'search_by'=>$search_by,'search'=>$search, 'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $User=User::orderBy($orderby, $ordertype)->where('approve', 0)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$User=User::orderBy($orderby, $ordertype)->where('approve', 0)->paginate(30);}
  return view('backend.user.pending_user')->with(['User'=>$User,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_pending_user(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $User = User::orderBy('id', 'DESC')->where('approve', 0)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $User = User::orderBy('id', 'DESC')->where('approve', 0)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend.user.pending_user')->with(['User'=>$User, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}





















}
