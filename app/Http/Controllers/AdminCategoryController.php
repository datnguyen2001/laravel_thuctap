<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use File;


class AdminCategoryController extends Controller
{

    /*  public function __construct()
    {
        $this->middleware('auth:admin');
    }
*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_category()
     {
        $categories = Category::orderBy('id','desc')->get();
        return view('admin.pages.category.index')->with('categories',$categories);


      }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_category()
    {
        $main_category = Category::orderBy('id','desc')->where('parent_id',NULL)->get();
        return view('admin.pages.category.create')->with('main_categories', $main_category );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function category_store(Request $request)
    {

    $request->validate(
     [
    'name' => 'required|max:150',
    'categoryimage' => 'nullable|image',
     ],
     [
      'name.required'=>'please provide a category name',
      'categoryimage.image'=>'plaese provide a valid image with .png,.jpg,.gif extension',
     ]

     );


    $category = new Category();

    $category->name=$request->name;
    $category->description=$request->description;
    $category->parent_id=  $request->parent_id;

//insert image
     if($request->hasfile('categoryimage')){
        //insert the image
         $image = $request->file('categoryimage');
         $img = time() . '.'. $image->getClientOriginalExtension();
         $location = 'images/category/' .$img;
         Image::make($image)->save($location);
         $category->image= $img;
    }
       $category->save();





    session()->flash('success','A new Category Has Added Succesfully!!!');

    return redirect()->route('admin.category');





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

    public function category_edit($id)
    {

    $main_category = Category::orderBy('id','desc')->where('parent_id',NULL)->get();

        $category = Category::find($id);
        return view('admin.pages.category.edit',compact( 'category','main_category'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category_update(Request $request, $id)
    {
         $request->validate(
     [
    'category_name' => 'required|max:150',
    'category_image' => 'nullable|image',
     ],
     [
      'category_name.required'=>'please provide a category name',
      'category_image.image'=>'plaese provide a valid image with .png,.jpg,.gif extension',
     ]

     );


    $category = Category::find($id);

    $category->name=$request->category_name;
    $category->description=$request->description;
    $category->parent_id=  $request->parent_id;


    //insert image
     if($request->category_image){

        //delete the old image from the folder
        if(File::exists('images/category/'.$category->image)){
           File::delete('images/category/'.$category->image);
        }

         $image = $request->file('category_image');
         $img = time() . '.'. $image->getClientOriginalExtension();
         $location = 'images/category/' .$img;
         Image::make($image)->save($location);
         $category->image= $img;
    }

       $category->save();


       session()->flash('success','A New Category Has Updated Succesfully!!!');

       return redirect()->route('admin.category');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category_delete($id)
    {

      $category = Category::find($id);

      if(!is_null($category)){
      //if it is parent category then delete its subcategory
       if($category->parent_id==NULL){
        //delete the sub category
        $subcategory = Category::orderBy('name','desc')->where('parent_id',$category->id)->get();

        foreach ($subcategory as $sub){
         // delete the sub category image
            if(File::exists('images/category/'.$sub->image)){
             File::delete('images/category/'.$sub->image);
        }
           $sub->delete();

        }
       }

        //delete the category image

         if(File::exists('images/category/'.$category->image)){
           File::delete('images/category/'.$category->image);
        }

        $category->delete();
        session()->flash('success','Category Has Deleted Succesfully!!!');

        return back();

      }

    }
}
