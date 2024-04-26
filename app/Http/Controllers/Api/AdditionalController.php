<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

class AdditionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function setdefaultaddress(Request $request)
    {
        $id = $request->id;
        $user_id = $request->user_id;
        $address = DB::table('addresses')->where('user_id',$user_id)->update(['is_default'=>false]);

        $default = Address::findOrFail($id);
        $default->is_default = true;
        $default->update();
        if($default) {
            return response()->json([
                'status' => 'success',
                'message' => 'default address saved'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'set default address failed'
            ], 400);
        }


    }


}
