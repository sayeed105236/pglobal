<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use DB;
use Auth;
use Image;
use App\admin\product_tbl;
use App\admin\category_tbl;
use App\admin\shipping_tbl;
use App\admin\manufacturer_tbl;
use App\admin\product_attri_tbl;
use App\Http\Controllers\Controller;
class ProductController extends Controller
{



//product
public function attribute(Request $request){
    $id=$request->input("id");
  $product_tbl=product_tbl::findOrFail($id);
  $product_attri_tbl=product_attri_tbl::orderBy('id', 'desc')->where('product_id',$id)->get();
return view('backend.product.attribute')->with(['product_tbl'=>$product_tbl,'product_attri_tbl'=>$product_attri_tbl]);}


public function insert_attribute(Request $request){
  $table_name=new product_attri_tbl;
    $table_name->color=$request->input("color");
    $table_name->size=$request->input("size");
    $table_name->price=$request->input("price");
    $table_name->stock=$request->input("stock");
    $table_name->product_id=$request->input("product_id");
    $table_name->save();

  $id=$request->input("product_id");
  alert()->success('Added','Well done! Attribute Added Successfully!');
return redirect("makecommand/attribute?id=$id");}



public function update_attribute(Request $request){
  $id=$request->input('id');
  $table_name=product_attri_tbl::find($id);
    $table_name->color=$request->input("color");
    $table_name->size=$request->input("size");
    $table_name->price=$request->input("price");
    $table_name->stock=$request->input("stock");

    $table_name->save();

  $id=$request->input("product_id");
  toast('Well done! Attribute Updated Successfully!','success');
return redirect("makecommand/attribute?id=$id");}



public function delete_attribute(Request $request){
  $id=$request->input('id');
  $id=product_attri_tbl::findOrFail($id);
  $id->delete();
  toast('The manufacturer has been Deleted','error');
return back()->with('status', 'Data Deleted');}





//unapproved_product
public function unapproved_product(Request $request){
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $product_tbl=product_tbl::orderBy('id', 'desc')->where('approve',0)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{$product_tbl=product_tbl::orderBy('id', 'desc')->where('approve',0)->paginate(30);}
return view('backend.product.unapproved_product')->with(['product_tbl'=>$product_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_unapproved_product(Request $request){
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
         $product_tbl = product_tbl::orderBy($orderby, $ordertype)->where('approve',0)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{
         $product_tbl = product_tbl::orderBy($orderby, $ordertype)->where('approve',0)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
return view('backend.product.unapproved_product')->with(['product_tbl'=>$product_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $product_tbl=product_tbl::orderBy($orderby, $ordertype)->where('approve',0)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$product_tbl=product_tbl::orderBy($orderby, $ordertype)->where('approve',0)->paginate(30);}
  return view('backend.product.unapproved_product')->with(['product_tbl'=>$product_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_unapproved_product(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $product_tbl = product_tbl::orderBy('id', 'DESC')->where('approve',0)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $product_tbl = product_tbl::orderBy('id', 'DESC')->where('approve',0)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend.product.unapproved_product')->with(['product_tbl'=>$product_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}

















public function product(Request $request){
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $product_tbl=product_tbl::orderBy('id', 'desc')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{$product_tbl=product_tbl::orderBy('id', 'desc')->paginate(30);}
return view('backend.product.index')->with(['product_tbl'=>$product_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_product(Request $request){
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
         $product_tbl = product_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{
         $product_tbl = product_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
return view('backend.product.index')->with(['product_tbl'=>$product_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $product_tbl=product_tbl::orderBy($orderby, $ordertype)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$product_tbl=product_tbl::orderBy($orderby, $ordertype)->paginate(30);}
  return view('backend.product.index')->with(['product_tbl'=>$product_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_product(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $product_tbl = product_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $product_tbl = product_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend.product.index')->with(['product_tbl'=>$product_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function add_product(){
  $d_category= DB::table('category_tbl')->select('id','name')->distinct()->get();
return view('backend.product.add_product')->with(['d_category'=>$d_category]);}





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
    $table_name->stock=$request->input("stock");
    $table_name->meta_description=$request->input("meta_description");


    $table_name->user_id=$request->input("vendor_id");


      $affiliate_percentage=$request->input('affiliate_percentage');
      $affiliate_percentage=str_replace('%', '', $affiliate_percentage);
      if($affiliate_percentage == NULL){$affiliate_percentage=0;}
      $table_name->affiliate_percentage=$affiliate_percentage;

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
return redirect('makecommand/product')->with('status', 'Well done! Added Success!');}



public function delete_product(Request $request){
  $id=$request->input('id');
  $id=product_tbl::findOrFail($id);

    $image="{$id->main_image}";
    $image_path = "public/allfiles/img/product/thumb/$image";  
    if (file_exists($image_path)) {@unlink($image_path);}
    $image_path = "public/allfiles/img/product/$image";  
    if (file_exists($image_path)) {@unlink($image_path);}
    $image_path = "public/allfiles/img/product/large/$image";  
    if (file_exists($image_path)) {@unlink($image_path);}


    $other_image="{$id->image}";
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

  $id->delete();


alert()->error('Added','The product has been Deleted!');
return back()->with('status', 'DThe product has been Deleted');}

public function edit_product(Request $request){
  $id=$request->input("id");
  $id=product_tbl::findOrFail($id);
  $d_category= DB::table('category_tbl')->select('id','name')->distinct()->get();
return view('backend.product.edit_product')->with(['id'=>$id, 'd_category'=>$d_category]);} 



public function update_product(Request $request){
    //dd($request);
 $id=$request->input('id');
  $table_name=product_tbl::find($id);

   

    $table_name->name=$request->input("name");
    $table_name->description=$request->input("description");
    $table_name->price=$request->input("price");
    $table_name->before_discount=$request->input("before_discount");
    $table_name->meta_tag=$request->input("meta_tag");
    $table_name->stock=$request->input("stock");
    $table_name->meta_description=$request->input("meta_description");
    $table_name->user_id=$request->input("vendor_id");

      $name=$request->input('name');
      $slug=str_replace(' ', '-', $name);


      $affiliate_percentage=$request->input('affiliate_percentage');
      $affiliate_percentage=str_replace('%', '', $affiliate_percentage);
      if($affiliate_percentage == NULL){$affiliate_percentage=0;}
      $table_name->affiliate_percentage=$affiliate_percentage;

    
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


    // approve
    $approve=$request->input("approve");
    if($approve==true){$table_name->approve = true;}
    else{$table_name->approve = false;}


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















//shipping
public function shipping(Request $request){
  $shipping_tbl=shipping_tbl::orderBy('time', 'asc')->get();
return view('backend.shipping.index')->with(['shipping_tbl'=>$shipping_tbl]);}

public function insert_shipping(Request $request){
    $table_name=new shipping_tbl;
      $table_name->district=$request->input("district");
      $table_name->price=$request->input("price");
      $table_name->time=$request->input("time");
    $table_name->save();
  alert()->success('Added','Well done! shipping Added Successfully!');
return redirect('makecommand/shipping')->with('status', 'Well done! Added Success!');}

public function update_shipping(Request $request){
  $id=$request->input("id");
  $table_name=shipping_tbl::findOrFail($id);
    $table_name->district=$request->input("district");
    $table_name->price=$request->input("price");
    $table_name->time=$request->input("time");
  $table_name->update();
alert()->success('Updated','Well done! shipping Updated Successfully!');
return back()->with('status', 'Well done! Updated Success!');}

public function delete_shipping(Request $request){
  $id=$request->input('id');
  $id=shipping_tbl::findOrFail($id);
  $id->delete();
alert()->error('Deleted','The shipping has been Deleted');
return back()->with('status', 'Data Deleted');}






}
