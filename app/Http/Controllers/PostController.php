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
use App\admin\notification_tbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class PostController extends Controller
{

//post
public function post(Request $request){
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $post_tbl=post_tbl::orderBy('id', 'desc')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{$post_tbl=post_tbl::orderBy('id', 'desc')->paginate(30);}
return view('backend.post.index')->with(['post_tbl'=>$post_tbl, 'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_post(Request $request){
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
           $post_tbl = post_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
        else{
           $post_tbl = post_tbl::orderBy($orderby, $ordertype)->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
    return view('backend.post.index')->with(['post_tbl'=>$post_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $post_tbl=post_tbl::orderBy($orderby, $ordertype)->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$post_tbl=post_tbl::orderBy($orderby, $ordertype)->paginate(30);}
  return view('backend.post.index')->with(['post_tbl'=>$post_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_post(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $post_tbl = post_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $post_tbl = post_tbl::orderBy('id', 'DESC')->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend.post.index')->with(['post_tbl'=>$post_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}


public function add_post(Request $request){
return view('backend.post.add_post');}


public function insert_post(Request $request){
  $table_name=new post_tbl;
    $table_name->title=$request->input("title");
    $table_name->tag_line=$request->input("tag_line");
    $table_name->meta_desc=$request->input("meta_desc");
    $table_name->description=$request->input("description");
    $table_name->caption=$request->input("caption");
    $table_name->user_id=Auth::id();


      $slug=$request->input('slug');
      $slug=str_replace(' ', '-', $slug);

      $slug_count=post_tbl::where('slug',$slug)->count();
      if($slug_count>0){
        $slug_count=$slug_count+1;
        $slug=$slug."-".$slug_count;

          $slug_count=post_tbl::where('slug',$slug)->count();
          if($slug_count>0){
            $slug_status='এই Slug টি ডাটাবেজে আছে। অনুগ্রহ করে ইউনিক স্লাগ দিন';
            alert()->success('Congratulation',"$slug_status");
            return back()->with(['slug_status'=>$slug_status]);
          }
      }
    $table_name->slug=$slug;

    $category=$request->input('category');
    if(!empty($category)){
        $um_category=$request->input("category");
        $im_category=implode(",",$um_category);
        $table_name->category=$im_category;}

    $tag=$request->input('tag');
    if(!empty($tag)){
        $um_tag=$request->input("tag");
        $im_tag=implode(",",$um_tag);
        $table_name->tag=$im_tag;}

    if ($request->hasfile('image')) {
      $img=$request->file('image');
      $filename=$slug.'-'.time().'.'.$img->getClientOriginalExtension();
      Image::make($img)->resize(250,160)->save('public/allfiles/img/post/' .$filename);
      Image::make($img)->resize(71,46)->save('public/allfiles/img/post/thumb/' .$filename);
      Image::make($img)->resize(850,544)->save('public/allfiles/img/post/big/' .$filename);
      $table_name->image=$filename;}


    if (isset($request->status)){$table_name->status = true;}
    else {$table_name->status = false;}

    $usertype=Auth::user()->usertype;
    if ($usertype=="admin" || $usertype=="editor") {
      $table_name->is_approved = 1;
      $table_name->approval_id = Auth::id();
    }

  $table_name->save();
  alert()->success('Added','পোস্টটি সাবমিট করা হয়েছে');
return back()->with('status', 'Well done! Added Success!');}

public function delete_post(Request $request){
  $id=$request->input('id');
  $id=post_tbl::findOrFail($id);
      $pr_image="$id->image";
      $image_path = "public/allfiles/img/post/$pr_image";  
      if (file_exists($image_path)) {@unlink($image_path);}
      $image_path = "public/allfiles/img/post/thumb/$pr_image";  
      if (file_exists($image_path)) {@unlink($image_path);}
      $image_path = "public/allfiles/img/post/big/$pr_image";  
      if (file_exists($image_path)) {@unlink($image_path);}
  $id->delete();
  alert()->error('Deleted','The post has been Deleted');
return back()->with('status', 'Data Deleted');}



public function show_post(Request $request){
  $id=$request->input("id");
  $id=post_tbl::findOrFail($id);
return view('backend.post.show_post')->with(['id'=>$id]);}

public function edit_post(Request $request){
  $id=$request->input("id");
  $id=post_tbl::findOrFail($id);
return view('backend.post.edit_post')->with(['id'=>$id]);} 

public function update_post(Request $request){
  $id=$request->input('id');
  $table_name=post_tbl::find($id);
    $table_name->title=$request->input("title");
    $table_name->tag_line=$request->input("tag_line");
    $table_name->meta_desc=$request->input("meta_desc");
    $table_name->description=$request->input("description");
    $table_name->caption=$request->input("caption");


      $pr_slug="{$table_name->slug}";
      $slug=$request->input('slug');
      $slug=str_replace(' ', '-', $slug);

      $slug_count=post_tbl::where('slug',$slug)->count();

      if($pr_slug==$slug){$slug="{$table_name->slug}";}
      else{
        if($slug_count>0){
          $slug_count=$slug_count+1;
          $slug=$slug."-".$slug_count;

            $slug_count=post_tbl::where('slug',$slug)->count();
            if($slug_count>0){
              $slug_status='এই Slug টি ডাটাবেজে আছে। অনুগ্রহ করে ইউনিক স্লাগ দিন';
              alert()->success('Congratulation',"$slug_status");
              return back()->with(['slug_status'=>$slug_status]);
            }
        }
      }
      $table_name->slug=$slug;


    $category=$request->input('category');
    if(!empty($category)){
        $um_category=$request->input("category");
        $im_category=implode(",",$um_category);
        $table_name->category=$im_category;}

    $tag=$request->input('tag');
    if(!empty($tag)){
        $um_tag=$request->input("tag");
        $im_tag=implode(",",$um_tag);
        $table_name->tag=$im_tag;}

    if ($request->hasfile('image')) {

        $pr_image="$table_name->image";
        $image_path = "public/allfiles/img/post/$pr_image";  
        if (file_exists($image_path)) {@unlink($image_path);}
        $image_path = "public/allfiles/img/post/thumb/$pr_image";  
        if (file_exists($image_path)) {@unlink($image_path);}
        $image_path = "public/allfiles/img/post/big/$pr_image";  
        if (file_exists($image_path)) {@unlink($image_path);}

      $img=$request->file('image');
      $filename=$slug.'-'.time().'.'.$img->getClientOriginalExtension();
      Image::make($img)->resize(250,160)->save('public/allfiles/img/post/' .$filename);
      Image::make($img)->resize(71,46)->save('public/allfiles/img/post/thumb/' .$filename);
      Image::make($img)->resize(850,544)->save('public/allfiles/img/post/big/' .$filename);
      $table_name->image=$filename;}


    if (isset($request->status)){$table_name->status = true;}
    else {$table_name->status = false;}


  $table_name->update();
  $id=$request->input('id');
alert()->success('Updated','Well done! post Updated Successfully!');
return back()->with('status', 'Well done! Updated Success!');}




//unapproved_post
public function unapproved_post(Request $request){
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $post_tbl=post_tbl::orderBy('id', 'desc')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->where('is_approved', "0")->paginate(30);} 
    else{$post_tbl=post_tbl::orderBy('id', 'desc')->where('is_approved', "0")->paginate(30);}
return view('backend.post.unapproved_post')->with(['post_tbl'=>$post_tbl, 'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_unapproved_post(Request $request){
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
           $post_tbl = post_tbl::orderBy($orderby, $ordertype)->where('is_approved', "0")->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
        else{
           $post_tbl = post_tbl::orderBy($orderby, $ordertype)->where('is_approved', "0")->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
    return view('backend.post.unapproved_post')->with(['post_tbl'=>$post_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $post_tbl=post_tbl::orderBy($orderby, $ordertype)->where('is_approved', "0")->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$post_tbl=post_tbl::orderBy($orderby, $ordertype)->where('is_approved', "0")->paginate(30);}
  return view('backend.post.unapproved_post')->with(['post_tbl'=>$post_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_unapproved_post(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $post_tbl = post_tbl::orderBy('id', 'DESC')->where('is_approved', "0")->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $post_tbl = post_tbl::orderBy('id', 'DESC')->where('is_approved', "0")->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend.post.unapproved_post')->with(['post_tbl'=>$post_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}



public function post_ap_re(Request $request){
  $id=$request->input('id');
  $table_name=post_tbl::find($id);

    
  $approval=$request->input('approval');
    if ($approval==0) {$table_name->is_approved = "reject";}
    else{$table_name->is_approved = 1;}

  $table_name->approval_id=Auth::id();
  $table_name->update();
  $id=$request->input('id');
alert()->success('Updated','Well done! post Updated Successfully!');
return back()->with('status', 'Well done! Updated Success!');}






//rejected_post
public function rejected_post(Request $request){
    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
    $post_tbl=post_tbl::orderBy('id', 'desc')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->where('is_approved', "reject")->paginate(30);} 
    else{$post_tbl=post_tbl::orderBy('id', 'desc')->where('is_approved', "reject")->paginate(30);}
return view('backend.post.rejected_post')->with(['post_tbl'=>$post_tbl, 'dfrom'=>$dfrom, 'dto'=>$dto]);}

public function sort_rejected_post(Request $request){
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
           $post_tbl = post_tbl::orderBy($orderby, $ordertype)->where('is_approved', "reject")->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
        else{
           $post_tbl = post_tbl::orderBy($orderby, $ordertype)->where('is_approved', "reject")->where($search_by, 'like', '%'.$search.'%')->paginate(30);}
    return view('backend.post.rejected_post')->with(['post_tbl'=>$post_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }

  //search none
  else{
    // Date
      $dfrom=$request->input("dfrom");
      $dto=$request->input("dto");
      if( !empty($dfrom) or  !empty($dto) ){
      $post_tbl=post_tbl::orderBy($orderby, $ordertype)->where('is_approved', "reject")->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
      else{$post_tbl=post_tbl::orderBy($orderby, $ordertype)->where('is_approved', "reject")->paginate(30);}
  return view('backend.post.rejected_post')->with(['post_tbl'=>$post_tbl,'dfrom'=>$dfrom, 'dto'=>$dto]);
  }
}


public function search_rejected_post(Request $request){
    $search_by=$request->input("search_by");
    $search=$request->input("search");

    $dfrom=$request->input("dfrom");
    $dto=$request->input("dto");
    if( !empty($dfrom) or  !empty($dto) ){
       $post_tbl = post_tbl::orderBy('id', 'DESC')->where('is_approved', "reject")->where($search_by, 'like', '%'.$search.'%')->where('created_at', '>=', date($dfrom))->where('created_at', '<=', date($dto))->paginate(30);} 
    else{
       $post_tbl = post_tbl::orderBy('id', 'DESC')->where('is_approved', "reject")->where($search_by, 'like', '%'.$search.'%')->paginate(30);}

return view('backend.post.rejected_post')->with(['post_tbl'=>$post_tbl, 'search_by'=>$search_by,'search'=>$search,'dfrom'=>$dfrom, 'dto'=>$dto]);}

}
