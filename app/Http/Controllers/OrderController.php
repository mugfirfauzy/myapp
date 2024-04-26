<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class OrderController extends Controller
{
    public function index(Request $request) {
        $orders = DB::table('orders')
        ->when($request->transaction_id, function ($query) use ($request) {
            return $query->where('transaction_id', 'like', '%'.$request->search.'%');
        })
        ->paginate(10);
        return view('pages.order.index', compact('orders'));
    }

    public function show($id) {
        $order = Order::findOrFail($id);
        return view('pages.order.show', compact('order'));
    }

    public function edit($id) {
        $order = Order::findOrFail($id);
        return view('pages.order.edit', compact('order'));
    }

    public function update(Request $request, $id) {
        $order = DB::table('orders')->where('id',$id);
        $order->update([
            'status' => 'on_delivery',
            'shipping_receipt' => $request->shipping_receipt
        ]);

        $this->sendNotificationToUser($order->first()->user_id, 'Paket dikirim dengan no resi '.$request->shipping_receipt);

        return redirect()->route('order.index');
    }

    public function sendNotificationToUser($userId, $message) {
        $user = User::find($userId);
        $token = $user->fcm_id;

        $messaging = app('firebase.messaging');
        $notification = Notification::create('Paket terkirim', $message,'','FLUTTER_NOTIFICATION_CLICK');

        $message = CloudMessage::withTarget('token', $token)->withNotification($notification);

        $messaging->send($message);
    }



}
