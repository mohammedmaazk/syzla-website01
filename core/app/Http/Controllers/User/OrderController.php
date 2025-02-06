<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
	public function order()
	{
		$pageTitle = "My Orders";
		$orders    = Order::where('user_id', auth()->id())->latest()->with('deposit')->paginate(getPaginate());
		return view($this->activeTemplate . 'user.order.index', compact('pageTitle', 'orders'));
	}

	public function details($id)
	{
		$pageTitle = 'Order Detail';
		$order     = Order::where('id', $id)->where('user_id', auth()->id())->with(['orderDetail.product', 'coupon', 'shipping', 'deposit.gateway', 'user'])->firstOrFail();
		return view($this->activeTemplate . 'user.order.detail', compact('pageTitle', 'order'));
	}
}
