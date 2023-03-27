<?php

namespace App\Http\Controllers;

use App\Models\SubProducts;
use Illuminate\Http\Request;

class SubProductController extends Controller
{
    //Create a new SubProduct
    public function index() {
        return SubProducts::select('id', 'name','email','address')->get();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        try {
            SubProducts::create($request->post());

            return response()->json([
                'message' => 'SubProduct created successfully!'
            ]);
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while creating a subproduct!'
            ], 500);
        }
    }

    public function show($id)
    {
        //
        $product = SubProducts::find($id);
        return response()->json([
            'SubProduct'=>$product
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'address'=>'required'
        ]);

        try {
            $product = SubProducts::find($id);
            $product->name = $request->name;
            $product->email = $request->email;
            $product->address = $request->address;
            $product->save();

                return response()->json([
                    'message' => 'SubProduct updated successfully!'
                ]);


        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while updating a sub-product!'
            ], 500);
        }
    }

    public function destroy($id)
    {
        //
        try {
            $product = SubProducts::find($id);
            $product->delete();

            return response()->json([
                'message' => 'SubProduct deleted successfully!'
            ]);

        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while deleting a sub-product!'
            ], 500);
        }
    }
}

