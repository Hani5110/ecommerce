<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
public function index()
{
    $orders = Order::orderBy('id','desc')->get();

    return view('admin.orders.index', compact('orders'));
}
   public function show($id)
 {
    $order = Order::with('items.product')->findOrFail($id);

    return view('admin.orders.show', compact('order'));
 }
   public function destroy($id)
{
    $order = Order::findOrFail($id);
    $order->delete();

    return redirect()->back()->with('success','Order deleted successfully');
}
public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $order->status = $request->status;
    $order->save();

    return redirect()->back();
}
public function status($status)
{
    $orders = Order::where('status',$status)->latest()->get();

    return view('admin.orders.index', compact('orders'));
}
}