<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Image;
use Illuminate\Support\Facades\File;
class AdminProductController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth:admin');
    }
      */





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


      // $main_category = Category::orderBy('name','asc')->where('parent_id',NULL)->get();

       // $sub_category = Category::orderBy('name','asc')->where('parent_id',$main_category->id)->get();

        return view('admin.pages.product.create');
        //,compact('main_category','sub_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $request->validate([
    'title' => 'required|max:150',
    'description' => 'required',
    'price' => 'required|numeric',
    'quantity' => 'required|numeric',
    'category_id' => 'required|numeric',
    'brand_id' => 'required|numeric',
    'product_image' => 'nullable|image',
     ]);



       $product = new Product;

       $product->title = $request->title;
       $product->description = $request->description;
       $product->price = $request->price;
       $product->quantity = $request->quantity;
       $product->slug =$request->title;
       $product->category_id=$request->category_id;
       $product->brand_id=$request->brand_id;
       $product->admin_id=1;
       $product->save();

       //ProductImage Model image insert

      //for single image insert

      /* if($request->hasfile('productimage')){
        //insert the image
         $image = $request->file('productimage');
         $img = time() . '.'. $image->getClientOriginalExtension();
         $location = 'images/product/' .$img;
         Image::make($image)->save($location);

         $productimage = new ProductImage;

         $productimage->product_id = $product->id;
         $productimage->image =  $img;
         $productimage->save();
       } */

       //for Multiple Image Insert

       if(count($request->productimage) > 0){
        $i=0;
        foreach ($request->productimage as $image) {

        //insert the image
         $img = time() . $i .'.'. $image->getClientOriginalExtension();
         $location = 'images/product/' .$img;
         Image::make($image)->save($location);

         $productimage = new ProductImage;

         $productimage->product_id = $product->id;
         $productimage->image =  $img;
         $productimage->save();
         $i++;
        }

       }

       session()->flash('success','A New Product Has Created Succesfully!!!');
       return redirect()->route('admin.product');
    }


  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function manage_product()
     {
        $products = Product::orderBy('id','desc')->get();
        return view('admin.pages.product.index')->with('products',$products);


      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_edit($id)
    {

         $product = Product::find($id);
        return view('admin.pages.product.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_product(Request $request, $id)
    {
        //

    $request->validate([
    'title' => 'required|max:150',
    'description' => 'required',
    'price' => 'required|numeric',
    'quantity' => 'required|numeric',
    'category_id' => 'required|numeric',
    'brand_id' => 'required|numeric',
    'product_image' => 'nullable|image',

     ]);



       $product =Product::find($id);

       $product->title = $request->title;
       $product->description = $request->description;
       $product->price = $request->price;
       $product->quantity = $request->quantity;
       $product->category_id=$request->category_id;
       $product->brand_id=$request->brand_id;


    //update image into productImage Model
     if(isset($request->productimage)){


        //delete the old image from the folder path
        foreach ($product->images as $img) {
          //delete from path
             $filename = $img->image;
             if(File::exists('images/product/'.$filename)){
                File::delete('images/product/'.$filename);
             }
              $img->delete();
           }

        //update image

        if(count($request->productimage) > 0){
        $i=0;
        foreach ($request->productimage as $image) {

        //insert the image
         $img = time() . $i .'.'. $image->getClientOriginalExtension();
         $location = 'images/product/' .$img;
         Image::make($image)->save($location);

         $productimage = new ProductImage;

         $productimage->product_id = $product->id;
         $productimage->image =  $img;
         $productimage->save();
         $i++;
        }

       }

    }

       $product->save();

       session()->flash('success','A New Product Has Updated Succesfully!!!');
       return redirect()->route('admin.product');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_delete($id)
    {

          $product =Product::find($id);
          if(!is_null( $product)){
           $product->delete();
          }

          //delete all image
          foreach ($product->images as $img) {
          //delete from path
             $filename = $img->image;
             if(File::exists('images/product/'.$filename)){
                File::delete('images/product/'.$filename);
             }

             $img->delete();
          }

          session()->flash('success','Product Has Deleted Succesfully!!!');

          return back();
    }

}
