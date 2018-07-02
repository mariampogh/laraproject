<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Category;
use App\Product;
class AdminController extends Controller
{

  // DB_DATABASE=1336016
  // DB_USERNAME=1336016
  // DB_PASSWORD=dingomingo1
  private $error;
  public function __construct(){
      $this->middleware('admin');
   }
   //
   // public function index(){
   //   $this->error = "";
   //   return $this->error;
   // }

   public function admin(){
      $categories = Category::orderBy('id', 'DESC')->get();
      //dd($categories);
      //$this->error= "kkkkkkkkkkk";
      return view('/admin')->with('categories',$categories)->with('error',$this->error);

  }

  //~~~~~~~~~~~~~~~~~ADMIN CATEGORIES~~~~~~~~~~~~~~~//

    public function addCategory(Request $request){
       $input = $request->all();
      if($request->hasFile('image') && $input['name'] != ""){
         $arrImgTypes = array('jpg', 'jpeg', 'png', 'gif');
         $image = $_FILES["image"]["name"];
         $tempName =  $_FILES["image"]["tmp_name"];
      	 $arrImgName = explode(".",$image);
         if (in_array(strtolower(end($arrImgName)), $arrImgTypes)){
             $count = Category::count();
             if($count == 0){
               $lastRecordId = 0;
             }
             else{
                $lastRecordId = Category::latest('id')->first()->id;
             }
             $image = $lastRecordId + 1;
             $image = $image.'.'.end($arrImgName);
             $imgUpload = move_uploaded_file($tempName, public_path().'/uploads/categories/'.$image);
             if($imgUpload ){
                Category::create(['name' => $input["name"],'image' => $image]);
             }
           }
        }
        return redirect('/admin');
        //return $this->admin();
     }




     public function editCategory(Request $request){
        $input = $request->all();
        $cayegory = Category::find($input['id']);
        if($request->hasFile('image')){
          $arrImgTypes = array('jpg', 'jpeg', 'png', 'gif');
          $image = $_FILES["image"]["name"];
          $tempName =  $_FILES["image"]["tmp_name"];
          $arrImgName = explode(".",$image);
          if (in_array(strtolower(end($arrImgName)), $arrImgTypes)){
              $image_path =  public_path().'/uploads/categories/'.$cayegory->image;

              if(File::exists($image_path)) {
                  File::delete($image_path);
              }
              if(!File::exists($image_path)){
                  $image = $input['id'].'.'.end($arrImgName);
                  $imgUpload = move_uploaded_file($tempName, public_path().'/uploads/categories/'.$image);
                  if($imgUpload){
                     $cayegory->image = $image;
                  }

              }
          }
        }
        if($input['name'] != ""){
          $cayegory->name = $input['name'];
        }

        $cayegory->save();
        return redirect('/admin');
        //return $this->admin();
      }


      public function deleteCategory(Request $request){
         $input = $request->all();
         $products = Category::find($input["id"])->products;
         foreach($products as $prd){
           $image_path =  public_path().'/uploads/products/'. $prd['image'];
           if(File::exists($image_path)) {
               File::delete($image_path);
               Products::find($prd['id'])->delete();
           }
           else{
             $this->error = '<div class="alert alert-danger">
                       <strong>Warning!</strong> The category  is not deleted.
                       </div>';
           }
         }
           if($this->error == ""){
             $category = Category::find($input["id"]);
             $image_path =  public_path().'/uploads/categories/'. $category->image;
             if(File::exists($image_path)) {
                 File::delete($image_path);
                 Category::find($input['id'])->delete();
                 $this->error = '<div class="alert alert-success">
                           The category  is deleted.
                           </div>';
             }
             else{
               $this->error = '<div class="alert alert-danger">
                         <strong>Warning!</strong> The category  is not fully deleted.
                         </div>';
             }
           }
           else{
             $this->error = '<div class="alert alert-danger">
                       <strong>Warning!</strong> The category  is not fully deleted.
                       </div>';
           }
           return redirect('/admin');
           //return $this->admin();
         }

         //~~~~~~~~~~~~~~~~~ADMIN PRODUCTS~~~~~~~~~~~~~~~//

             public function productsOfCategory($id){
               $products = Product::where('cat_id', $id)->get();
               //dd($this->error);
               return view('/adminCatProducts')->with('products',$products)->with('cat_id',$id)->with('error',$this->error);
             }


             public function addProduct($cat_id,Request $request){
               $input = $request->all();
               foreach($input as $i){
                 if(!isset($i)){
                 $this->error = '<div class="alert alert-danger">
                             <strong>Warning!</strong> Fill all fields to add product:
                             </div>';
                 }
               }
               if($request->hasFile('image')){
                 $arrImgTypes = array('jpg', 'jpeg', 'png', 'gif');
                 $image = $_FILES["image"]["name"];
                 $tempName =  $_FILES["image"]["tmp_name"];
                 $arrImgName = explode(".",$image);
                 if (!in_array(strtolower(end($arrImgName)), $arrImgTypes)){
                   $this->error = '<div class="alert alert-danger">
                             <strong>Warning!</strong> The product is not added becouse selected file was not picture:
                             </div>';
                 }
                 else{
                   $count = Product::count();
                   if($count == 0){
                     $lastRecordId = 0;
                   }
                   else{
                      $lastRecordId = Product::latest('id')->first()->id;
                   }
                   $image = $lastRecordId + 1;
                   $image = $image.'.'.end($arrImgName);
                   $imgUpload = move_uploaded_file($tempName, public_path().'/uploads/products/'.$image);
                   if($imgUpload ){
                      Product::create([ 'cat_id' => $cat_id,
                                         'product' => $input["product"],
                                         'image' => $image,
                                       ]);
                       $this->error = '<div class="alert alert-success">
                                 The product is added.
                                 </div>';
                   }
                 }

               }
               else{
                 $this->error = '<div class="alert alert-danger">
                            <strong>Warning!</strong> Fill all fields to add product:
                           </div>';
               }
                return redirect('/adminCatProducts/'.$cat_id);
              // return $this->productsOfCategory($cat_id);
             }



             public function editProduct(Request $request){
                $input = $request->all();
                $product = Product::find($input['id']);
                if($request->hasFile('image')){
                  $arrImgTypes = array('jpg', 'jpeg', 'png', 'gif');
                  $image = $_FILES["image"]["name"];
                  $tempName =  $_FILES["image"]["tmp_name"];
                  $arrImgName = explode(".",$image);
                  if (in_array(strtolower(end($arrImgName)), $arrImgTypes)){
                      $image_path =  public_path().'/uploads/products/'.$product->image;

                      if(File::exists($image_path)) {
                          File::delete($image_path);
                      }
                      if(!File::exists($image_path)){
                          $image = $input['id'].'.'.end($arrImgName);
                          $imgUpload = move_uploaded_file($tempName, public_path().'/uploads/products/'.$image);
                          if($imgUpload){
                             $product->image = $image;
                          }

                      }
                  }
                  else{
                    $this->error = '<div class="alert alert-danger">
                              <strong>Warning!</strong> The current pictore is not changed becouse selected file is not picture.
                            </div>';
                  }
                }
                if($input['name'] != ""){
                  $product->product = $input['name'];
                }

                $product->save();
                return redirect('/adminCatProducts/'.$input['cat_id']);
                //return $this->productsOfCategory($input['cat_id']);
              }



              public function deleteProduct($cat_id,Request $request){
                $input = $request->all();
                $image = Product::find($input['id'])->image;
                $image_path =  public_path().'/uploads/products/'.$image;
                if(File::exists($image_path)) {
                    File::delete($image_path);
                    Product::find($input['id'])->delete();
                    $this->error = '<div class="alert alert-success">
                              The product is deleted.
                              </div>';
                }
                else{
                  $this->error = '<div class="alert alert-danger">
                            <strong>Warning!</strong> The product is not deleted.
                            </div>';
                }
                return redirect('/adminCatProducts/'.$cat_id);
               // return $this->productsOfCategory($cat_id);
              }




}
