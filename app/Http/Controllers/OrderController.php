<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stationary;
use App\Models\Customer;
use App\Models\Status;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $orders = Order::latest()->paginate(5);

        $orders = Order::select([
            'o.id',
            'o.customer_id',
            'o.stationary_id',
            'o.quantity',
            'o.status',
            'o.user_id',
            'c.name as customer_name',
            's.name as stationary_name',
            'u.name as user_name',
            'sta.name as status',
        ])
        ->from('orders as o')
        ->join('customers as c', function($join) {
            $join->on('o.customer_id', '=', 'c.id');
        })
        ->join('stationaries as s', function($join) {
            $join->on('o.stationary_id', '=', 's.id');
        })
        ->join('users as u', function($join) {
            $join->on('o.user_id', '=', 'u.id');
        })
        ->join('statuses as sta', function($join) {
            $join->on('o.status', '=', 'sta.id');
        })
        ->orderBy('o.id', 'DESC')
        ->paginate(5);

        return view('order.index',compact('orders'))
            ->with('user_name', \Auth::user()->name)
            ->with('page_id', request()->page)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stationaries = Stationary::all();
        $customers = Customer::all();

        return view('order.create')
            ->with('stationaries', $stationaries)
            ->with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'stationary_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:12',
        ]);

        $order = new Order;
        $order->customer_id = $request->input(['customer_id']);
        $order->stationary_id = $request->input(['stationary_id']);
        $order->quantity = $request->input(['quantity']);
        $order->status = 1;
        $order->user_id = \Auth::user()->id;
        $order->save();
        
        return redirect()->route('orders.index')
                        ->with('success', '受注登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $stationaries = Stationary::all();
        $customers = Customer::all();
        $statuses = Status::all();

        return view('order.edit', compact('order'))
            ->with('stationaries', $stationaries)
            ->with('customers', $customers)
            ->with('statuses', $statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate ([
            'customer_id' => 'required|integer',
            'stationary_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:12',
        ]);

        $order->customer_id = $request->input(["customer_id"]);
        $order->stationary_id = $request->input(["stationary_id"]);
        $order->quantity = $request->input(["quantity"]);
        $order->status = $request->input(["status_id"]);
        $order->user_id = \Auth::user()->id;
        $order->save();

        return redirect()->route('orders.index')
                        ->with('success', '受注入力を変更しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
                        ->with('success', '受注ID' . $order->id . 'を削除しました');
    }
}
