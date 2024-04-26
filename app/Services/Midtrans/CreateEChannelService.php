<?php

namespace App\Services\Midtrans;

use Midtrans\CoreApi;

class CreateEChannelService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getEChannel()
    {
        $itemDetails = [];

        foreach($this->order->orderItems as $orderItem) {
            $itemDetails[] = [
                'id' => $orderItem->product->id,
                'price' => $orderItem->product->price,
                'quantity' => $orderItem->quantity,
                'name' => $orderItem->product->name,
            ];
        }

        $itemDetails[] = [
            'id' => 'shipping_cost',
            'price' => $this->order->shipping_cost,
            'quantity' => 1,
            'name' => 'shipping_cost'
        ];

        $params = [
            'payment_type' => 'echannel',
            'transaction_details' => [
                'order_id' => $this->order->transaction_id,
                'gross_amount' => $this->order->total_cost,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $this->order->user->name,
                'email' => $this->order->user->email,
                'phone' => $this->order->user->phone,
            ],
            'echannel' => [
                'bill_info1' => 'Pay for:',
                'bill_info2' => 'Order - '.$this->order->transaction_id,
                'bill_info3' => 'Amount:',
                'bill_info4' => $this->order->total_cost,
            ]
        ];

        $response = CoreApi::charge($params);

        return $response;
    }
}
