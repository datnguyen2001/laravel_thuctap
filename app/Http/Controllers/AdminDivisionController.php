<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;

class AdminDivisionController extends Controller
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
    public function manage_division()
     {
        $divisions = Division::orderBy('priority','asc')->get();
        return view('admin.pages.division.index')->with('division',$divisions);
    
       
      }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_division()
    {
        return view('admin.pages.division.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function division_store(Request $request)
    {
        


     $request->validate(
     [
    'name' => 'required|max:150',
    'priority' => 'required',
     ],
     [
      'name.required'=>'please provide a division name',
      'priority.required'=>'plaese provide a division priority',
     ]

     );


    $division = new Division();

    $division->name=$request->name;
    $division->priority=$request->priority;
   
    $division->save();

    session()->flash('success','A New Division Has Added Succesfully!!!');

    return redirect()->route('admin.division');


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
    public function division_edit($id)
    {
         $division = Division::find($id);
        return view('admin.pages.division.edit')->with('division',$division);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function division_update(Request $request, $id)
    {
        
     $request->validate(
     [
    'name' => 'required|max:150',
    'priority' => 'required',
     ],
     [
      'name.required'=>'please provide a division name',
      'priority.required'=>'plaese provide a division priority',
     ]

     );


    $division = Division::find($id);

    $division->name=$request->name;
    $division->priority=$request->priority;
   
    $division->save();

      
       session()->flash('success','A New Division Has Updated Succesfully!!!');

       return redirect()->route('admin.division');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function division_delete($id)
    {
        

          $division =Division::find($id);
          if(!is_null( $division)){ 

          //delete all the district 

          $districts= District::where('division_id',$division->id)->get();
          foreach ($districts as $district) {
             
             $district->delete();
           } 

           $division->delete();
          }

          session()->flash('success','Division Has Deleted Succesfully!!!');
          
          return back();
    }
}
