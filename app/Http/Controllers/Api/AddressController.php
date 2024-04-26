<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->default == "yes") {
            $address = DB::table('addresses')->where('user_id',$request->user()->id)->where('is_default',true)->get();
            return response()->json([
                'message' => 'success',
                'data' => $address
            ], 200);
        } else {
            $address = Address::where('user_id',$request->user()->id)->with('province','city','district')->get();
            return response()->json([
                'message' => 'success',
                'data' => $address
            ], 200);
        }
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
    public function store(StoreAddressRequest $request)
    {
        $address = DB::table('addresses')->insert([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'postal_code' => $request->postal_code,
            'user_id' => $request->user()->id,
            'is_default' => $request->is_default,
        ]);

        if($address) {
            return response()->json([
                'status' => 'success',
                'message' => 'address saved'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'address failed to saved'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
