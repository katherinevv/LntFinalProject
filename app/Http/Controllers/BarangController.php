<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function createBarang(){
        $categories = Category::all();
        return view('createBarang', compact('categories'));
    }

    public function storeBarang(Request $request){

        $request->validate([
            // 'kategori_barang' => 'required|string',
            'nama_barang' => 'required|min:5|max:80',
            'harga_barang' => 'required|integer',
            'jumlah_barang' => 'required|integer',
            'foto_barang' => 'required|mimes:png,jpg',
        ]);

        // $imageName = null;
        // if ($request->hasFile('foto_barang')) {
        //     $image = $request->file('foto_barang');
        //     $imageName = time() . '.' . $image->extension();
        //     $image->move(public_path('images'), $imageName);
        // }

        $extension = $request->file('foto_barang')->getClientOriginalExtension();
        $imageName = $request->nama_barang.'.'.$extension;
        $request->file('foto_barang')->storeAs('/public/image', $imageName);

        Barang::create([
            'kategori_barang' => $request->CategoryName,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'foto_barang' => $imageName,
        ]);

        //name dari model => $request->name dari form

        return redirect('/');
    }

    public function show(){
        $barangs = Barang::all();
        
        return view('welcome', compact('barangs'));
    }

    public function edit($id){
        $barang = Barang::findOrFail($id);
        return view('editBarang', compact('barang'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'nama_barang' => 'required|min:5|max:80',
            'harga_barang' => 'required|integer',
            'jumlah_barang' => 'required|integer',
            'foto_barang' => 'image|required|mimes:png,jpg',
        ]);

        // $imageName = null;
        // if ($request->hasFile('foto_barang')) {
        //     $image = $request->file('foto_barang');
        //     $imageName = time() . '.' . $image->extension();
        //     $image->move(public_path('images'), $imageName);
        // }

        $extension = $request->file('foto_barang')->getClientOriginalExtension();
        $imageName = $request->nama_barang.'.'.$extension;
        $request->file('foto_barang')->storeAs('/public/image', $imageName);

        Barang::findOrFail($id)->update([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'foto_barang' => $imageName,
        ]);

        return redirect('/');
    }

    public function delete($id){
        Barang::destroy($id);

        return redirect('/');
    }

    // =========================================
    // API
    // munculin data barang yang udah diinput
    public function getBarang(){
        $barangs = Barang::all();
        return $barangs;
    }

    // function untuk menambahkan data barang dari postman
    public function addBarang(Request $request){
        $imageName = null;
        if ($request->hasFile('foto_barang')) {
            $image = $request->file('foto_barang');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
        }

        Barang::create([
            'kategori_barang' => $request->kategori_barang,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'foto_barang' => $imageName,
        ]);

        return response()->json(["success" => 200]);
    }

    //function untuk mengupdate barang dari postman berdasarkan id
    public function updateBarang(Request $request, $id){

        $imageName = null;
        if ($request->hasFile('foto_barang')) {
            $image = $request->file('foto_barang');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
        }

        Barang::findOrFail($id)->update([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'foto_barang' => $imageName,
        ]);

        return response()->json(["success" => 200]);
    }

    // function untuk menghapus barang berdasarkan id
    public function removeBarang($id){
        Barang::destroy($id);
        return response()->json(["success" => 200]);
    }
}
