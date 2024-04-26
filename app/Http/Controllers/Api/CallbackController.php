<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class CallbackController extends Controller
{
    public function callback() {
        $callback = new CallbackService();
        $order = $callback->getOrder();

        // if ($callback->isSignatureKeyVerified()) {
            if ($callback->isSuccess()) {
                $order->update([
                    'status' => 'paid',
                ]);
                $this->sendNotificationToUser($order->user_id, 'Pembayaran telah diterima.');
            } else if ($callback->isExpire()) {
                $order->update([
                    'status' => 'expired',
                ]);
                $this->sendNotificationToUser($order->user_id, 'Waktu pembayaran telah kadaluarsa.');
            } else if ($callback->isCancelled()) {
                $order->update([
                    'status' => 'cancelled',
                ]);
                $this->sendNotificationToUser($order->user_id, 'Pembayaran telah dibatalkan.');
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Callback success',
                ],
            ]);

            // return response()->json([
            //     'meta' => [
            //         'code' => 400,
            //         'message' => 'Callback failed',
            //     ],
            // ]);
        // }

        // return response()->json([
        //     'meta' => [
        //         'code' => 400,
        //         'message' => 'Callback failed',
        //     ],
        // ]);
    }

    public function sendNotificationToUser($userId, $message) {
        $user = User::find($userId);
        $token = $user->fcm_id;

        $messaging = app('firebase.messaging');
        $notification = Notification::create('Notifikasi Pembayaran', $message);

        $message = CloudMessage::withTarget('token', $token)->withNotification($notification);
        $messaging->send($message);
    }



}
