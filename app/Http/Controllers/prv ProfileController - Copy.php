<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Image;
use App\User;
use App\admin\cart_tbl;
use App\admin\product_tbl;
use App\admin\order_tbl;
use App\admin\shipping_tbl;
use App\admin\order_detail_tbl;
use App\admin\product_attri_tbl;
use Illuminate\Http\Request;

class Profile_Controller extends Controller
{
    
public function profile(){
return view('frontend.profile.index');}


public function update_profile(Request $request){
    $validatedData = $request->validate([
        'name' => 'required|max:191',
        'phone' => 'required|min:10|max:12',
        'email' => 'required|max:191',
        'address' => 'required|max:191',
        'description' => 'max:16777200',
    ]);
  
  $Auth_id=Auth::User()->id;
    $table_name=User::find($Auth_id);
      $table_name->name=$request->input("name");
      $table_name->phone=$request->input("phone");
      $table_name->email=$request->input("email");
      $table_name->address=$request->input("address");
      $table_name->description=$request->input("description");

      if ($request->hasfile('pp')) {
        // main_image
          $pp_image=$request->file('pp');
          $pp_extension=$pp_image->getClientOriginalExtension();
          $pp_extension=strtoupper($pp_extension);
          if($pp_extension=="JPG" || $pp_extension=="PNG" || $pp_extension=="GIF" || $pp_extension=="WEBP"){
        if ($request->hasfile('pp')) {
                // delete Image
                  $pr_pp="{$table_name->pp}";
                  if($pr_pp == "user.svg" || $pr_pp == "user.png" || $pr_pp == "user.jpg"){}
                  else{$pr_pp = "public/allfiles/img/pp/$pr_pp";  
                      if (file_exists($pr_pp)) {@unlink($pr_pp);}}
              $pp_image=$request->file('pp');
              $name=$request->input("name");
              $filename=$name.'-'.time().'.'.$pp_image->getClientOriginalExtension();
              Image::make($pp_image)->resize(150,150)->save('public/allfiles/img/pp/'.$filename);
           $table_name->pp=$filename;}
      }
      else{
          $status="Invalid image extention. Supported image type JPG, PNG, GIF or WEBP files.";
      toast($status,'error');
      return back()->with(['status'=>$status,'pp'=>$status]);}
      }
    $table_name->update();
  alert()->success('Updated','Well done! Profile Updated Successfully!');
return back()->with('status', 'Well done! Updated Success!');
}



public function profile_orderlist(Request $request){
  $Auth_id=Auth::User()->id;
    $order_tbl=order_tbl::orderBy('id', 'desc')->where('user_id',$Auth_id)->paginate(30);
return view('frontend.profile.orderlist')->with(['order_tbl'=>$order_tbl]);}


public function order_management(Request $request){
  $Auth_id=Auth::User()->id;
    $order_tbl=order_tbl::orderBy('id', 'desc')->where('shop_id',$Auth_id)->paginate(30);
return view('frontend.profile.order_management')->with(['order_tbl'=>$order_tbl]);
}

public function edit_order_management(Request $request){
  $id=$request->input("id");
    $order_tbl=order_tbl::findorFail($id);

  $Auth_id=Auth::User()->id;
    $count_order_detail_tbl=order_detail_tbl::where('order_id',$id)->where('product_auth_id',$Auth_id)->count();
    $order_tbl_shop_id="{$order_tbl->shop_id}";
    if ($order_tbl_shop_id == $Auth_id) {
    return view('frontend.profile.edit_order_management')->with(['order_tbl'=>$order_tbl]);
    }
    else{
    toast("There are some problem. Please connect with admin panel",'error');
    return back()->with('status', 'There are some problem. Please connect with admin panel');
    }
}

public function update_order(Request $request){
  $id=$request->input("id");
    $order_tbl=order_tbl::findorFail($id);
    $order_completed="{$order_tbl->order_completed}";

  $Auth_id=Auth::User()->id;
    $order_tbl_shop_id="{$order_tbl->shop_id}";
    if ($order_tbl_shop_id == $Auth_id) {
    $update_option=$request->input("update_option");
    if ($update_option=="pending") {$cmd="pending";}
    elseif ($update_option=="working") {$cmd="working";}
    elseif ($update_option=="accepted") {$cmd="accepted";}
    elseif ($update_option=="complete") {$cmd="complete";}
    else{$cmd="pending";}


    if ($update_option=="complete") {
        $id=$request->input('id');
        $table_name=order_tbl::find($id);
          $table_name->status=$cmd;
          $table_name->order_completed=true;
        $table_name->update();
      }
    else{
        $id=$request->input('id');
        $table_name=order_tbl::find($id);
          $table_name->status=$cmd;
        $table_name->update();
    }
    toast("Updated Successfully",'success');
    return back()->with('status', 'Updated Successfully');
    }
    else{
    toast("There are some problem. Please connect with admin panel",'error');
    return back()->with('status', 'There are some problem. Please connect with admin panel');
    }
}


public function show_order(Request $request){
  $id=$request->input("id");
    $order_tbl=order_tbl::findorFail($id);
    $order_user_id="{$order_tbl->user_id}";
  $Auth_id=Auth::User()->id;

  if ($order_user_id == $Auth_id) {
    return view('frontend.profile.show_order')->with(['order_tbl'=>$order_tbl]);
  }
  else{
    toast("There are some problem. Please connect with admin panel",'error');
    return back()->with('status', 'There are some problem. Please connect with admin panel');
  }
}




public function profile_product(Request $request){
  $Auth_id=Auth::User()->id;
    $product_tbl=product_tbl::where('user_id',$Auth_id)->paginate(30);
return view('frontend.profile.profile_product')->with(['product_tbl'=>$product_tbl]);}

public function add_product(Request $request){
  $d_category= DB::table('category_tbl')->select('id','name')->distinct()->get();
return view('frontend.profile.add_product')->with(['d_category'=>$d_category]);}


public function product_attribute(Request $request){
  $id=$request->input("id");
  $product_tbl=product_tbl::findOrFail($id);
    $product_user="{$product_tbl->user_id}";
  $Auth_id=Auth::User()->id;

  if ($product_user == $Auth_id) {
      $product_attri_tbl=product_attri_tbl::where('product_id',$id)->get();
    return view('frontend.profile.product_attribute')->with(['product_tbl'=>$product_tbl,'product_attri_tbl'=>$product_attri_tbl]);
  }
  else{
    toast("There are some problem. Please connect with admin panel",'error');
    return back()->with('status', 'There are some problem. Please connect with admin panel');
  }
}


public function insert_attribute(Request $request){

  $product_id=$request->input("product_id");
  $product_tbl=product_tbl::findOrFail($product_id);
  $product_user="{$product_tbl->user_id}";
  $Auth_id=Auth::User()->id;

  if ($product_user == $Auth_id) {
      $table_name=new product_attri_tbl;
        $table_name->color=$request->input("color");
        $table_name->size=$request->input("size");
        $table_name->product_id=$request->input("product_id");
       $table_name->save();
    alert()->success('Added','Well done! Attribute Added Successfully!');
    return back()->with('status', 'Well done! Attribute Added Successfully!');
  }
  else{
    toast("There are some problem. Please connect with admin panel",'error');
    return back()->with('status', 'There are some problem. Please connect with admin panel');
  }
}

public function update_attribute(Request $request){
  $id=$request->input('id');
  $product_attri_tbl=product_attri_tbl::find($id);
  $product_id="{$product_attri_tbl->product_id}";
  $product_tbl=product_tbl::findOrFail($product_id);
  $product_user="{$product_tbl->user_id}";
  $Auth_id=Auth::User()->id;

  if ($product_user == $Auth_id) {
    $id=$request->input('id');
      $table_name=product_attri_tbl::find($id);
        $table_name->color=$request->input("color");
        $table_name->size=$request->input("size");
      $table_name->save();

    toast('Well done! Attribute Updated Successfully!','success');
    return back()->with('status', 'Well done! Attribute Updated Successfully');
  }
  else{
    toast("There are some problem. Please connect with admin panel",'error');
    return back()->with('status', 'There are some problem. Please connect with admin panel');
  }
}



public function delete_attribute(Request $request){
  $id=$request->input('id');
  $product_id=product_attri_tbl::find($id)->product_id;
  $product_tbl=product_tbl::findOrFail($product_id);
  $product_user="{$product_tbl->user_id}";
  $Auth_id=Auth::User()->id;

  if ($product_user == $Auth_id) {

        $id=$request->input('id');
        $id=product_attri_tbl::findOrFail($id);
        $id->delete();
        toast('The manufacturer has been Deleted','error');
      return back()->with('status', 'Data Deleted');

    toast('Well done! Attribute Updated Successfully!','success');
    return back()->with('status', 'Well done! Attribute Updated Successfully');
  }
  else{
    toast("There are some problem. Please connect with admin panel",'error');
    return back()->with('status', 'There are some problem. Please connect with admin panel');
  }
}



public function edit_product(Request $request){
  $product_id=$request->input('id');
  $product_tbl=product_tbl::findOrFail($product_id);
  $product_user="{$product_tbl->user_id}";
  $Auth_id=Auth::User()->id;

  if ($product_user == $Auth_id) {
      $id=$request->input("id");
      $id=product_tbl::findOrFail($id);
      $d_category= DB::table('category_tbl')->select('id','name')->distinct()->get();
    return view('frontend.profile.edit_product')->with(['id'=>$id, 'd_category'=>$d_category]);
  }
  else{
    toast("There are some problem. Please connect with admin panel",'error');
    return back()->with('status', 'There are some problem. Please connect with admin panel');
  }
}





public function insert_product(Request $request){
    $validatedData = $request->validate([
        'name' => 'required|max:191',
        'description' => 'max:16777200',
        'price' => 'integer|required',]);

  $table_name=new product_tbl;
    $table_name->name=$request->input("name");
    $table_name->description=$request->input("description");
    $table_name->price=$request->input("price");
    $table_name->before_discount=$request->input("before_discount");
    $table_name->meta_tag=$request->input("meta_tag");
    $table_name->meta_description=$request->input("meta_description");
    $table_name->user_id=Auth::user()->id;


      if(Auth::user()->usertype =='admin'){
        $table_name->approve=true;
      }

      $name=$request->input('name');
      $slug=str_replace(' ', '-', $name);

    // code
    if(!empty($request->input('code'))) {
        $code=$request->input("code");
        $code_count=DB::table('product_tbl')->select('code')->where('code',$code)->count();
        if ($code_count<1) {$table_name->code=$code;}
        else{ toast('Give an unique code! this code is already in use','error');
        return back()->with('status', 'Give an unique code! this code is already in use!');}
    }
    else {
      $product_tbl_count= product_tbl::count();

      if($product_tbl_count>0){$latest_id= product_tbl::latest()->first()->id;}
      else{$latest_id=0;}

      $new_id=$latest_id+1;
      $hash_new_id="#".$new_id;
      $table_name->code=$hash_new_id;}


    // category
    $um_category=$request->input("category");
    if(!empty($um_category)){
        $um_category=$request->input("category");
        $im_category=implode(",",$um_category);
        $table_name->category=$im_category;}


    // status
    $status=$request->input("status");
    if($status==true){$table_name->status = true;}
    else{$table_name->status = false;}


    // meta_title
    if(!empty($request->input('meta_title'))) {
      $table_name->meta_title=$request->input("meta_title");}
    else {
      $table_name->meta_title=$slug;}

    // main_image
    if ($request->hasfile('main_image')) {
        $main_image=$request->file('main_image');
        $filename=$slug.'-'.time().'.'.$main_image->getClientOriginalExtension();
        Image::make($main_image)->resize(103,93)->save('public/allfiles/img/product/thumb/'.$filename);
        Image::make($main_image)->resize(205,186)->save('public/allfiles/img/product/'.$filename);
        Image::make($main_image)->resize(615,558)->save('public/allfiles/img/product/large/' .$filename);
    $table_name->main_image=$filename;}


    // others image
    if(!empty($request->input('image'))) {
      $files=[];$loop=0;
      foreach ($request->file('image') as $media) {
       $loop=$loop+1;
        if (!empty($media)) {
          $filename=$slug.'-'.time().'-'.$loop.'.'.$media->getClientOriginalExtension();
          Image::make($media)->resize(103,93)->save('public/allfiles/img/product/thumb/'.$filename);
          Image::make($media)->resize(205,186)->save('public/allfiles/img/product/'.$filename);
          Image::make($media)->resize(615,558)->save('public/allfiles/img/product/large/' .$filename);
          $files[] = $filename;
        }
      }
      $table_name->image = implode(',',$files);
    }


  $table_name->save();

alert()->success('Added','Well done! product Added Successfully!');
return redirect('profile/product')->with('status', 'Well done! Added Success!');}







public function update_product(Request $request){

  $product_id=$request->input('id');
  $product_tbl=product_tbl::findOrFail($product_id);
  $product_user="{$product_tbl->user_id}";
  $Auth_id=Auth::User()->id;

  if ($product_user == $Auth_id) {

       $id=$request->input('id');
        $table_name=product_tbl::find($id);

          $validatedData = $request->validate([
              'name' => 'required|max:191',
              'description' => 'max:16777200',
              'price' => 'integer|required',]);

          $table_name->name=$request->input("name");
          $table_name->description=$request->input("description");
          $table_name->price=$request->input("price");
          $table_name->before_discount=$request->input("before_discount");
          $table_name->meta_tag=$request->input("meta_tag");
          $table_name->meta_description=$request->input("meta_description");

            $name=$request->input('name');
            $slug=str_replace(' ', '-', $name);

          // code
          if(!empty($request->input('code'))) {
              $code=$request->input("code");
              $code_count=DB::table('product_tbl')->select('code')->where('code',$code)->count();
              if ($code_count<2) {$table_name->code=$code;}
              else{ toast('Give an unique code! this code is already in use','error');
              return back()->with('status', 'Give an unique code! this code is already in use!');}
          }
          else {
            $latest_id= product_tbl::latest()->first()->id;
            $new_id=$latest_id+1;
            $table_name->code=$new_id;}


          // category
          $um_category=$request->input("category");
          if(!empty($um_category)){
              $um_category=$request->input("category");
              $im_category=implode(",",$um_category);
              $table_name->category=$im_category;}


          // status
          $status=$request->input("status");
          if($status==true){$table_name->status = true;}
          else{$table_name->status = false;}


          // meta_title
          if(!empty($request->input('meta_title'))) {
            $table_name->meta_title=$request->input("meta_title");}
          else {
            $table_name->meta_title=$slug;}

          // main_image
          if ($request->hasfile('main_image')) {
                          // Delete Image
                          $whl_tbl=product_tbl::findOrFail($id);
                            $image="{$whl_tbl->main_image}";
                            $image_path = "public/allfiles/img/product/thumb/$image";  
                            if (file_exists($image_path)) {@unlink($image_path);}
                            $image_path = "public/allfiles/img/product/$image";  
                            if (file_exists($image_path)) {@unlink($image_path);}
                            $image_path = "public/allfiles/img/product/large/$image";  
                            if (file_exists($image_path)) {@unlink($image_path);}

              $main_image=$request->file('main_image');
              $filename=$slug.'-'.time().'.'.$main_image->getClientOriginalExtension();
              Image::make($main_image)->resize(103,93)->save('public/allfiles/img/product/thumb/'.$filename);
              Image::make($main_image)->resize(205,186)->save('public/allfiles/img/product/'.$filename);
              Image::make($main_image)->resize(615,558)->save('public/allfiles/img/product/large/' .$filename);
          $table_name->main_image=$filename;}


          // others image
          if($request->hasfile('image')) {
                // Delete Image
                $whl_tbl=product_tbl::findOrFail($id);
                $other_image="{$whl_tbl->image}";
                $other_image_explode= explode(",",$other_image);
                  foreach($other_image_explode as $other_image_explode){
                      $image="$other_image_explode";
                      $image_path = "public/allfiles/img/product/thumb/$image";  
                      if (file_exists($image_path)) {@unlink($image_path);}
                      $image_path = "public/allfiles/img/product/$image";  
                      if (file_exists($image_path)) {@unlink($image_path);}
                      $image_path = "public/allfiles/img/product/large/$image";  
                      if (file_exists($image_path)) {@unlink($image_path);}
                  }

              $files=[];$loop=0;
              foreach ($request->file('image') as $media) {
               $loop=$loop+1;
                if (!empty($media)) {
                  $filename=$slug.'-'.time().'-'.$loop.'.'.$media->getClientOriginalExtension();
                  Image::make($media)->resize(103,93)->save('public/allfiles/img/product/thumb/'.$filename);
                  Image::make($media)->resize(205,186)->save('public/allfiles/img/product/'.$filename);
                  Image::make($media)->resize(615,558)->save('public/allfiles/img/product/large/' .$filename);
                  $files[] = $filename;
                }
              }
              $table_name->image = implode(',',$files);
          }


        $table_name->update();
       $id=$request->input('id');
       alert()->success('Updated','Well done! product Updated Successfully!');
      return back()->with('status', 'Well done! Updated Success!');
  }
  else{
    toast("There are some problem. Please connect with admin panel",'error');
    return back()->with('status', 'There are some problem. Please connect with admin panel');
  }

}

































}
