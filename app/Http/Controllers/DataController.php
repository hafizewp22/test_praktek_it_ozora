<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(Request $request)
    {
        $datas = Data::all();
        $search_query = $request->query('SearchData');
        $dataSearch = Data::orWhere('nama_barang', "LIKE", "%$search_query%")->get();
        return view('index', compact('datas', 'dataSearch'));
    }

    public function UploadData(Request $request)
    {
        $addDatas = new Data();

        $request->validate([
            'nama_barang' => ['required', 'unique:data'], // Memastikan nama_barang unik di dalam tabel "datas"
            'harga_beli' => ['required', 'numeric'],
            'harga_jual' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'photo' => ['required', 'image', 'mimes:jpeg,png', 'max:100'], // Format foto harus JPG atau PNG, maksimum 100KB
        ]);

        $addDatas->nama_barang = $request->input('nama_barang');
        $addDatas->harga_beli = $request->input('harga_beli');
        $addDatas->harga_jual = $request->input('harga_jual');
        $addDatas->stok = $request->input('stok');

        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/upload/'), $filename);
            $addDatas['photo'] = $filename;
        }

        $addDatas->save();
        return redirect('/')->with('status', 'Data Added Successfull');
    }

    public function UpdateData(Request $request)
    {
        $request->validate([
            'nama_barang' => ['required'],
            'harga_beli' => ['required', 'numeric'],
            'harga_jual' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'photo' => ['image', 'mimes:jpeg,png', 'max:100'], // Format foto harus JPG atau PNG, maksimum 100KB
        ]);

        $data = Data::find($request->id);

        $data->nama_barang = $request->input('nama_barang');
        $data->harga_beli = $request->input('harga_beli');
        $data->harga_jual = $request->input('harga_jual');
        $data->stok = $request->input('stok');

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('images/upload/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/upload/'), $filename);
            $data['photo'] = $filename;
        };

        $data->save();
        return redirect('/')->with('status', 'Data Updated Successfull');
    }

    public function DeleteData($id)
    {
        $data = Data::where('id', $id)->first();

        if (!$data) {
            return redirect('/')->with('error', 'Data not found.');
        }

        // Hapus data
        $data->delete();

        return redirect('/')->with('status', 'Data deleted successfully');
    }

    public function SearchData(Request $request){
        $search_query = $request->query('SearchData');
        $datas = Data::orWhere('nama_barang', "LIKE", "%$search_query%")->get();
        return view('index', compact('datas', 'datas'));
    }
}
