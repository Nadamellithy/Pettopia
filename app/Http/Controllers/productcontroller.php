<?php

namespace App\Http\Controllers;

use App\Models\Ppet;
use App\Product;
use App\Puser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productcontroller extends Controller
{
    public function addproduct(Request $request)
    {
        $file_extension = $request->photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'image/product';
        $request->photo->move($path, $file_name);
        $data = $request->input('user_id');

        $user = Puser::find($data);
        $product = Product::create(
            [
                'name' => $request->name,
                'price' => $request->price,
                'photo' => $file_name,
                'description' => $request->description,
                'location' => $request->location,

            ]);
        $user = $user->products()->save($product);

        return $product;
    }

    /////////////////////////////
    public function searchInproduct(Request $request)
    {
        $data = $request->input('product_name');
        $Validator = Validator::make($request->all(), [
            'product_name' => 'required | min:3']);
        if ($Validator->fails()) {
            return $Validator->errors();
        } else {
            $product = Product::where('name', 'like', "%{$data}%")
                ->get();

            return response()->json($product);
        }
    }

    ////////////////////
    public function allproduct()
    {
        $product = Product::all();
        return ($product);
    }

    public function deleteproduct(Request $request)
    {
        $data = $request->input('product_id');
        $product = Product::where('id', '=', $data);
        $product->delete();
        return 'done';
    }

    public function viewproudct(Request $request)
    {
        $data = $request->input('product_id');
        $Product = Product::where('id', '=', 'product_id')->get();
        return ($Product);
    }
}



