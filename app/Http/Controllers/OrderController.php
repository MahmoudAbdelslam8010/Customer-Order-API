<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'in:pending,shipped'
        ]);

        $order = Order::create($validated);
        return response()->json($order, 201);
    }


    public function getOrder()
    {
        return Order::with('customer')->get(); // solve n+1 problem -- eager loading
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,shipped'
        ]);

        $order = Order::findOrFail($id);
        // $order = Order::find($id);
        //     if (!$order) {
        //         abort(404);
        //     }
        $order->status = $request->status;
        $order->save();

        return response()->json($order);
    }


    public function stats()
    {
        $totalRevenue = Order::sum(DB::raw('price * quantity'));

        $statusCount = Order::selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->get()
                            ->pluck('count', 'status');

        return response()->json([
            'total_revenue' => $totalRevenue,
            'orders_per_status' => $statusCount,
        ]);
    }

        //bonus
        public function orderStatus(Request $request)
    {
        $status = $request->query('status');
        if ($status) {
            $orders = Order::where('status', $status)->get();
        } else {
            $orders = Order::all();
        }
        return response()->json($orders);
    }
}
