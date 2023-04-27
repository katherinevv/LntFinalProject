<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function createInvoice(){
        $categories = Category::all();
        return view('createInvoice', compact('categories'));
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('showInvoice', compact('invoice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'kategori_barang' => 'required',
            'nama_barang' => 'required',
            'kuantitas' => 'required|numeric',
            'alamat_pengiriman' => 'required|min:10|max:100',
            'kode_pos' => 'required|digits:5',
        ]);

        $invoice = new Invoice();
        $invoice->nomor_invoice = $invoice->generateInvoiceNumber();
        $invoice->kategori_barang = $request->CategoryName;
        $invoice->nama_barang = $request->nama_barang;
        $invoice->harga_barang = $request->harga_barang;
        $invoice->kuantitas = $request->kuantitas;
        $invoice->alamat_pengiriman = $request->alamat_pengiriman;
        $invoice->kode_pos = $request->kode_pos;
        $invoice->subtotal_harga = $invoice->calculateSubtotal();
        $invoice->total_harga = $invoice->calculateTotalPrice();
        $invoice->saveInvoice();
        return redirect()->route('show', $invoice->id);
    }

    // public function edit($id)
    // {
    //     $invoice = Invoice::findOrFail($id);
    //     return view('editInvoice', compact('invoice'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'kategori_barang' => 'required',
    //         'nama_barang' => 'required',
    //         'kuantitas' => 'required|numeric',
    //         'alamat_pengiriman' => 'required|min:10|max:100',
    //         'kode_pos' => 'required|digits:5',
    //     ]);

    //     $invoice = Invoice::findOrFail($id);
    //     $invoice->kategori_barang = $request->kategori_barang;
    //     $invoice->nama_barang = $request->nama_barang;
    //     $invoice->harga_barang = $request->harga_barang;
    //     $invoice->kuantitas = $request->kuantitas;
    //     $invoice->alamat_pengiriman = $request->alamat_pengiriman;
    //     $invoice->kode_pos = $request->kode_pos;
    //     $invoice->subtotal_harga = $invoice->calculateSubtotal();
    //     $invoice->total_harga = $invoice->calculateTotalPrice();
    //     $invoice->saveInvoice();

    //     return redirect()->route('show', $invoice->id);
    // }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('show', $invoice->id);
    }


}


?>