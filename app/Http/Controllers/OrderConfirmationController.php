<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderConfirmationController extends Controller
{
    public function confirmOrder($id){
        $order = Order::find($id);
     
        if ($order) {
            if($order->status == 'canceled'){
                Session::flash('success', 'This order has been canceled before');
                return back();
            }
            else if($order->status == 'WaitingForUserConfirmation'){ 
                $order->status = 'confirmed';
                $order->save();
                return view('confirmOrder.confirmed');
           }
           else{
                Session::flash('success', 'This order has been confirmed before ');
                return back();
           }
        } else {
            abort(404);
        }
    }
    public function cancelOrder($id){
        $order = Order::find($id);
        if ($order) {          
             if($order->status == 'WaitingForUserConfirmation'){ 
                $order->status = 'canceled';
                $order->save();
                return view('confirmOrder.canceledOrder',["message"=> "canceled"]);
            }
            else {
                Session::flash('success', 'This order has been confirmed before you can not cancel it');
                
                return view('confirmOrder.canceledOrder',["message"=> "can't cancel"]);

            }
        } else {
            abort(404);
        }
    }
}
