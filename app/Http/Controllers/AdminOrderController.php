<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Order;
use PDF;

class AdminOrderController extends Controller
{

    /*
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    */

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $orders = Order::orderBy('id','desc')->get();
        return view('admin.pages.order.index')->with('order',$orders);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $orders = Order::find($id);
      $orders->is_seen_by_admin =1;
      $orders->save();
      return view('admin.pages.order.show')->with('order',$orders);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function order_completed($id)
    {
        $order = Order::find($id);

        if($order->is_completed){
           $order->is_completed=0;
        }
        else{
           $order->is_completed=1;
        }

        $order->save();

        session()->flash('success','Order Completed Status Changed !..');
        return back();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function order_paid($id)
    {
        $order = Order::find($id);

        if($order->is_paid){
           $order->is_paid=0;
        }
        else{
           $order->is_paid=1;
        }

        $order->save();

        session()->flash('success','Order Paid Status Changed !..');
        return back();
    }


    /**
     * Show the form for generate_invoicee the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generate_invoice($id)
    {
      $order = Order::find($id);

      $pdf = PDF::loadView('admin.pages.order.invoice',compact('order'));
    //$pdf->stream('invoice.pdf'); 
    // return $pdf->download('invoice.pdf');

    return view('admin.pages.order.invoice',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_charge_update(Request $request, $id)
    {
        $order=Order::find($id);

        $order->shipping_charge   =$request->shipping_charge;
        $order->shipping_discount =$request->shipping_discount;
        $order->save();
        session()->flash('success','Order Charge And Discount Changed !..');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_delete($id)
    {
        $order= Order::find($id);

        if(!is_null($order)){ 
            $order->delete();
           }
 
           session()->flash('success','Order Has Deleted Succesfully!!!');
           
           return back();
    }
}
