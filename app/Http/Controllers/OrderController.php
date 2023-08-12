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

    public function apiOrders()
    {
        $latestOrders = Order::with('coffee')->get();
        return response()->json($latestOrders);
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

        $data = $request->validate([
            'nama' => 'required',
            'meja' => 'required',
            'jumlah' => 'required|numeric',
            'coffee_id' => 'required',
        ], [
            "nama.required"=>"Nama Harus Diisi",
            "meja.required"=>"Meja Harus Diisi",
            "jumlah.required"=>"Jumlah Harus Diisi",
        ]);
    

        $order = Order::create($data);

        return response()->json($order);
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
