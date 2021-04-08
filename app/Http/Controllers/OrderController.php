<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

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

        if(isset($request->discount)){
            $discount = (100 - $request->discount) * 0.01;
            $orders = collect($orders)->map(function($item) use ($discount) {
                $item->order_sum = floor($item->order_sum * $discount);
                return $item;
            });
        }

        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        return response()->json($orders, 200, $headers, JSON_UNESCAPED_UNICODE);

    }

    public function create(Request $request){
        $order = (array)$request->input();
        $order['sum'] = ($request->count ?: 1) * Product::find($request->productId)->price;

        return Order::create($order);
    }
}
