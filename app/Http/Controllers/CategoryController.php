<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategory(){
        return view('createCategory');
    }

    public function storeCategory(Request $request){

        $request->validate([
            'CategoryName' => 'required|unique:categories,CategoryName,except,id',
        ]);

        Category::create([
            'CategoryName' => $request->CategoryName,
        ]);
        return redirect('/create-barang');
    }

    // ==========================================================================
    // API
    public function addCategory(Request $request){
        Category::create([
            'CategoryName' => $request->CategoryName,
        ]);
        return response()->json(["success" => 200]);
    }
}
