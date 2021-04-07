<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request){
        $order = new Order;
        $order->productId = $request->productId;
        $count = $request->count ?: 1;
        $order->count = $count;
        $product = Product::find($request->productId);
        $order->sum = $count * $product->price;
        $order->save();

        return response()->json($order);

    }
}
