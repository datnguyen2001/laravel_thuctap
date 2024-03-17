<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Illuminate\Support\Facades\File;

class AdminSliderController extends Controller
{

   
   // public function __construct()
   // {
   //     $this->middleware('auth:admin');
   // }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function manage_slider()
     {
        $sliders = Slider::orderBy('id','asc')->get();
        return view('admin.pages.slider.index')->with('slider',$sliders);
    
       
      }



     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_slider()
    {
       
        return view('admin.pages.slider.create');

    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function slider_store(Request $request)
    {
        


     $request->validate(
     [
    'title' => 'required|max:150',
    'image' => 'required|image',
    'button_text' =>'nullable',
    'button_link' =>'nullable|url',
    'priority' => 'required',
     ],
     [
      'title.required'=>'please provide a slider Title',
      'image.image'=>'plaese provide a valid image with .png,.jpg,.gif extension',
      'button_link.url'=>'please provide a valid buttonlink url',
      'priority.required'=>'plaese provide a slider priority',
     ]

     );


    $slider = new slider();

    $slider->title        = $request->title;
    $slider->button_text  = $request->button_text;
    $slider->button_link  = $request->button_link;
    $slider->priority     = $request->priority;

    //insert image
     if($request->hasfile('image')){
        //insert the image
         $image = $request->file('image');
         $img = time() . '.'. $image->getClientOriginalExtension();
         $location = 'images/slider/' .$img;
         Image::make($image)->save($location);
         $slider->image= $img;
    }
    

    $slider->save();

    session()->flash('success','A New Slider Has Added Succesfully!!!');

    return redirect()->route('admin.slider');


    }



     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function slider_edit($id)
    {
         $slider = Slider::find($id);
         return view('admin.pages.slider.edit')->with('slider',$slider);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function slider_update(Request $request, $id)
    {
        
      $request->validate(
     [
    'title' => 'required|max:150',
    'image' => 'image',
    'button_text' =>'nullable',
    'button_link' =>'nullable|url',
    'priority' => 'required',
     ],
     [
      'title.required'=>'please provide a slider Title',
      'image.image'=>'plaese provide a valid image with .png,.jpg,.gif extension',
      'button_link.url'=>'please provide a valid buttonlink url',
      'priority.required'=>'plaese provide a slider priority',
     ]

     );


    $slider = slider::find($id);

    $slider->title        = $request->title;
    $slider->button_text  = $request->button_text;
    $slider->button_link  = $request->button_link;
    $slider->priority     = $request->priority;

     //insert image
     if($request->image){
        
        //delete the old image from the folder
        if(File::exists('images/slider/'.$slider->image)){
           File::delete('images/slider/'.$slider->image);
        }

         $image = $request->file('image');
         $img = time() . '.'. $image->getClientOriginalExtension();
         $location = 'images/slider/' .$img;
         Image::make($image)->save($location);
         $slider->image= $img;
    }

    $slider->save();

      
       session()->flash('success','A New Slider Has Updated Succesfully!!!');

       return redirect()->route('admin.slider');

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function slider_delete($id)
    {
        

          $slider =slider::find($id);
          if(!is_null($slider)){ 

         //delete the slider image

         if(File::exists('images/slider/'.$slider->image)){
           File::delete('images/slider/'.$slider->image);
           }
           $slider->delete();
          }

          session()->flash('success','slider Has Deleted Succesfully!!!');
          
          return back();
    }

}
