<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\CdekService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('product')->where('user_id', Auth::id())->latest()->get();

        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $products = Product::all();
        $pvzList = [];
        $selectedCity = $request->query('city');

        if ($selectedCity) {
            $pvzList = app(CdekService::class)->getPvzList($selectedCity);
        }

        return view('orders.create', compact('products', 'pvzList', 'selectedCity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'pvz_code' => $request->pvz_code,
            'comment' => $request->comment,
            'status' => 'new',
        ]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Заказ успешно создан!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if (auth()->id() !== $order->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'No access to this order!');
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
