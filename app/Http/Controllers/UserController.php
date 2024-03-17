<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use Auth;


class UserController extends Controller
{
    /**
     * check the login or not for go to user dashboard .
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Show the form for creating a new dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_dashboard()
    {
        $user =Auth::user();
        return view('pages.user.dashboard',compact('user'));
    }




    /**
     * Show the form for a new User  .
     *
     * @return \Illuminate\Http\Response
     */
    public function user_profile()
    {

          $divisions = Division::orderBy('priority','asc')->get();

         $districts = district::orderBy('division_id','asc')->get();

        $user =Auth::user();

        return view('pages.user.profile',compact('user','divisions','districts'));
    }








    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request)
    {

        $this->validate($request,[

         'first_name' => 'required|string|max:30',
         'last_name' => 'nullable|string|max:15',
         'email' =>'required|string|email|max:100',
         'username' => 'required|string|alpha_dash|max:100',
         'password' => 'string|min:5',
         'division_id' => 'required|numeric',
         'district_id' => 'required|numeric',
         'street_address' => 'required|max:15',
          'phone_no' => 'required|max:15',
         'shipping_address' => 'required|max:100',


        ]);


     $user = Auth::user();

     $user->firstname= $request->first_name;
     $user->lastname= $request->last_name;
     $user->username= str_slug($request->first_name.$request->last_name);
     $user->email= $request->email;
     $user->division_id= $request->division_id;
     $user->district_id= $request->district_id;
     $user->phoneno= $request->phone_no;
     $user->street_address= $request->street_address;
     $user->shipping_address= $request->shipping_address;
     $user->ip_address= request()->ip();

     if($request->password !=NULL || $request->password !=""){

            $user->password= Hash::make($request->password);

       }

     $user->save();


    session()->flash('success','Your Profile Has Updated Succesfully..');

    return redirect()->route('user.profile');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
