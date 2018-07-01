<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Category;
use App\Product;
class AdminController extends Controller
{
  
  private $error;
  public function __construct(){
      $this->middleware('admin');
   }


   public function admin(){
      $categories = Category::orderBy('id', 'DESC')->get();
      //dd($categories);
      return view('/admin')->with('categories',$categories);

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
                       <strong>Ուշադրություն!</strong> Կատեգորիան չի ջնջվել:
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
                           Կատեգորիան ջնջված է:
                           </div>';
             }
             else{
               $this->error = '<div class="alert alert-danger">
                         <strong>Ուշադրություն!</strong> Կատեգորիան չի ջնջվել ամբողջությամբ:
                         </div>';
             }
           }
           else{
             $this->error = '<div class="alert alert-danger">
                       <strong>Ուշադրություն!</strong> Կատեգորիան չի ջնջվել ամբողջությամբ:
                       </div>';
           }
           return redirect('/admin');
           //return $this->admin();
         }

         //~~~~~~~~~~~~~~~~~ADMIN PRODUCTS~~~~~~~~~~~~~~~//

             public function productsOfCategory($id){
               $products = Product::where('cat_id', $id)->get();
               return view('/adminCatProducts')->with('products',$products)->with('cat_id',$id);
             }


             public function addProduct($cat_id,Request $request){
               $input = $request->all();
               foreach($input as $i){
                 if(!isset($i)){
                 $this->error = '<div class="alert alert-danger">
                             <strong>Ուշադրություն!</strong> Դասընթաց ավելացնելու համար անհրաժեշտ է լրացնել բոլոր դաշտերը:
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
                             <strong>Ուշադրություն!</strong> Դասընթացը չի ավելացվել, քանի որ ընտրված ֆայլը նկար չէր:
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
                                 Դասընթացն ավելացվել է:
                                 </div>';
                   }
                 }

               }
               else{
                 $this->error = '<div class="alert alert-danger">
                           <strong>Ուշադրություն!</strong> Դասընթաց ավելացնելու համար անհրաժեշտ է լրացնել բոլոր դաշտերը:
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
                              <strong>Ուշադրություն!</strong> Նկարի փոփոխություն չի կատարվել, քանի որ ընտրված ֆայլը նկար չէր:
                              </div>';
                  }
                }
                if($input['name'] != ""){
                  $product->product = $input['name'];
                }

                $product->save();
                return redirect('/adminCatProducts/'.$cat_id);
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
                              Դասընթացը ջնջվել է:
                              </div>';
                }
                else{
                  $this->error = '<div class="alert alert-danger">
                            <strong>Ուշադրություն!</strong> Դասընթացը չի ջնջվել:
                            </div>';
                }
                return redirect('/adminCatProducts/'.$cat_id);
               // return $this->productsOfCategory($cat_id);
              }




}
