<?php

namespace App\Http\Controllers;

use App\Models\Coffee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class CoffeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Coffee::all();
        return view('admin.coffee.listCoffee', ['data'=>$data, 'title'=>'Coffee']);
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
        $request->validate([
            'coffee' => 'required|string',
            'price' => 'required|numeric',
            'desc' => 'required|string',
            'img' => 'required|image|mimes:jpg,bmp,png',
        ]);

        $imagePath = $request->file('img')->storePublicly('coffee', 'public');
        // Simpan data ke database
        $coffee = Coffee::create([
            "coffee" => $request->coffee,
            "price" => $request->price,
            "desc" => $request->desc,
            "img" => $imagePath,
        ]);
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Coffee::find($id);
        return view('admin.coffee.editCoffee',['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coffee $coffee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'coffee' => 'required|string',
            'price' => 'required|numeric',
            'desc' => 'required|string',
            'img' => 'image|mimes:jpg,bmp,png',
        ]);
        $coffee = Coffee::find($id);

        if (!$coffee) {
            return redirect()->back()->with('error', 'Data not found');
        }

        $imagePath = $coffee->img;
        if ($request->hasFile('img')) {
            File::delete(public_path('storage/' . $imagePath));

            $imagePath = $request->file('img')->storePublicly('coffee', 'public');
        }
        // Simpan data ke database
        $coffee->update([
            "coffee" => $request->coffee,
            "price" => $request->price,
            "desc" => $request->desc,
            "img" => $imagePath,
        ]);

        return redirect('/admin/coffees')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coffee $coffee)
    {
        // Hapus gambar dari penyimpanan jika ada
        if ($coffee->img) {
            File::delete(public_path('storage/' . $coffee->img));
        }

        // Hapus data Coffee dari basis data
        $coffee->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
