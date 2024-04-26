<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Address;
use App\Services\Midtrans\CreateVAService;
use App\Services\Midtrans\CreateEChannelService;

class OrderController extends Controller
{
    public function order(Request $request) {
        $request->validate([
            'address_id' =>'required',
            'payment_method' => 'required',
            'shipping_name' => 'required',
            'shipping_service' => 'required',
            'shipping_cost' => 'required',
            'items' => 'required',
        ]);

        $subtotal = 0;
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $subtotal += $product->price * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'address_id' => $request->address_id,
            'subtotal' => $subtotal,
            'shipping_cost' => $request->shipping_cost,
            'total_cost' => $subtotal + $request->shipping_cost,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'shipping_name' => $request->shipping_name,
            'shipping_service' => $request->shipping_service,
            'transaction_id' => 'INV-0424-'.rand(000001,999999),
        ]);

        if ($request->payment_va_name) {
            $order->update([
                'payment_va_name' => $request->payment_va_name,
            ]);
        }

        foreach($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        //MIDTRANS
        if ($request->payment_method == 'bank_transfer') {
            $midtrans = new CreateVAService($order->load('user','orderItems'));
            $apiResponse = $midtrans->getVA();
            $order->payment_va_number = $apiResponse->va_numbers[0]->va_number;
            $order->payment_transaction_id = $apiResponse->transaction_id;
            $order->save();
        } else {
            $midtrans = new CreateEChannelService($order->load('user','orderItems'));
            $apiResponse = $midtrans->getEChannel();
            $order->bill_key = $apiResponse->bill_key;
            $order->biller_code = $apiResponse->biller_code;
            $order->payment_transaction_id = $apiResponse->transaction_id;
            $order->save();
        }


        return response()->json([
            'message' => 'Order create succesfully',
            'order' => $order,
        ]);


    }

    public function getOrderById($id)
    {
        $order = Order::with('orderItems.product')->find($id);

        return response()->json([
            'message' => 'success',
            'order' => $order
        ]);
    }

    public function getStatusOrderById($id)
    {
        $order = Order::find($id);

        return response()->json([
            'message' => 'success',
            'status' => $order->status
        ]);
    }

    public function getOrder(Request $request)
    {
        // $order = Order::where('user_id',$request->user()->id)->with('orderItems.product')->get();
        $order = Order::where('user_id',$request->user()->id)->get();
        return response()->json([
            'message' => 'success',
            'order' => $order
        ]);
    }

    public function getWholeOrder(Request $request)
    {
        $order = Order::where('user_id',$request->user()->id)->with('user','address.province','address.city','address.district','orderItems.product')->get();
        // $order = Order::where('user_id',$request->user()->id)->get();
        return response()->json([
            'message' => 'success',
            'order' => $order
        ]);
    }




}
