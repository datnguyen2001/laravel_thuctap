<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;

class AdminDistrictController extends Controller
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
     public function manage_district()
     {
        $districts = District::orderBy('division_id','asc')->get();
        return view('admin.pages.district.index')->with('district',$districts);
    
       
      }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_district()
    {
        $divisions = Division::orderBy('priority','asc')->get();

        return view('admin.pages.district.create',compact('divisions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function district_store(Request $request)
    {
        


     $request->validate(
     [
    'name' => 'required|max:150',
    'division_id' => 'required',
     ],
     [
      'name.required'=>'please provide a District name',
      ' division_id.required'=>'plaese provide a district   division id',
     ]

     );


    $district = new District();

    $district->name        = $request->name;
    $district->division_id = $request->division_id;
   
    $district->save();

    session()->flash('success','A New District Has Added Succesfully!!!');

    return redirect()->route('admin.district');


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
    public function district_edit($id)
    {

         $divisions = Division::orderBy('priority','asc')->get(); 
         $district = District::find($id);

      return view('admin.pages.district.edit',compact('district','divisions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function district_update(Request $request, $id)
    {
        
     $request->validate(
     [
    'name' => 'required|max:150',
    'division_id' => 'required',
     ],
     [
      'name.required'=>'please provide a district name',
      'division_id.required'=>'plaese provide a district   Division Id',
     ]

     );


    $district = District::find($id);

    $district->name        = $request->name;
    $district->division_id = $request->division_id;
   
    $district->save();

      
       session()->flash('success','A New District Has Updated Succesfully!!!');

       return redirect()->route('admin.district');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function district_delete($id)
    {
        

          $district =District::find($id);
          if(!is_null( $district)){ 
           $district->delete();
          }

          session()->flash('success','District Has Deleted Succesfully!!!');
          
          return back();
    }
}
