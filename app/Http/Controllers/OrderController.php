<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Yajra\DataTables\Facades\DataTables;
// use DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::with('coffee')->get();
        // dd($data);
        return view('admin.order.listOrder', ["data"=>$data]);
    }

    public function data()
    {
        $data = Order::with('coffee')->get();
        // dd($data);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Order::create([
            "nama"=>$request->nama,
            "meja"=>$request->meja,
            "jumlah"=>$request->jumlah,
            "coffee_id"=>$request->coffee_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('success', "Pesanan Dihapus");
    }
}
