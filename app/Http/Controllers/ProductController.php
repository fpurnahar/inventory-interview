<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('id', 'DESC')->paginate(5);
        return view('welcome', compact('product'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            if ($request->search == null) {
                $productSearch = Product::paginate(10);
            } else {
                $productSearch = Product::where('nama_barang', 'LIKE', '%' . $request->search . "%")->paginate(10);
            }
            if ($productSearch) {
                return response($productSearch);
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:200',
            'kode_barang' => 'required|max:200',
            'jumlah_barang' => 'required',
            'tanggal' => 'required|date',
        ]);

        $product = new Product();
        $product->nama_barang = $request->nama_barang;
        $product->kode_barang = $request->kode_barang;
        $product->jumlah_barang = $request->jumlah_barang;
        $product->tanggal = $request->tanggal;

        $product->save();
        return back()->with('success', 'Add News Product Success');
    }

    public function edit(Product $product)
    {
        return view('edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->nama_barang = $request->nama_barang;
        $product->kode_barang = $request->kode_barang;
        $product->jumlah_barang = $request->jumlah_barang;
        $product->tanggal = $request->tanggal;
        $product->save();

        return redirect()->route('home')->with('success', 'Update Success');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('home')->with('success', 'Delete Product Has Been Success');
    }
}
