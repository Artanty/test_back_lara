<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // TODO comment
    public function getOrders(Request $request){

        $orders = Order::join('products','products.id','=','orders.productId')
            ->select(
                'orders.id as order_id',
                'products.id as product_id',
                'products.name as product_name',
                'products.price as product_price',
                'orders.count as products_count',
                'orders.sum as order_sum'
            )->get();

        if(isset($request->discount) && $request->discount > 0){
            $discount = (100 - $request->discount) * 0.01;
            return collect($orders)->map(function($item) use ($discount) {
                $item->order_sum = floor($item->order_sum * $discount);
                return $item;
            });
        }

        return response()->json($orders);
    }

    // TODO mass assigment
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
