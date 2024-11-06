<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DeliveryAddress;
use Auth;
use DB;
use Session;
class DeliveryAddressController extends Controller
{
    public function store(Request $request) {
        try {
            if($request->is_default == 1) {
                DeliveryAddress::where('user_id', auth()->user()->id)->update(['is_default' => 0]);
            }
            $address = new DeliveryAddress();
            $address->user_id = auth()->user()->id;
            $address->full_name = $request->full_name;
            $address->phone = $request->phone;
            $address->street = $request->street;
            $address->brgy_code = $request->brgy_code;
            $address->city_code = $request->city_code;
            $address->province_code = $request->province_code;
            $address->region_code = $request->region_code;
            $address->zip_code = $request->postal_code;
            $address->is_default = $request->is_default;

            if($address->save()) {

                if(DeliveryAddress::where('user_id', auth()->user()->id)->get()->count() > 1) {
                    Session::flash('new_added_delivery', $address->id);
                }

                flash('Delivery address created successfully')->success();
                return back();
            }
            else {
                flash('Something went wrong')->error();
                return back();
            }
        }
        catch (\Throwable $th) {
            flash($th->getMessage())->error();
            return back();
        }
    }
    public function make_default($id) {
        DB::beginTransaction();
        try {
            // Set default to 0
            DeliveryAddress::where(['user_id' => Auth::user()->id, 'is_default' => 1])->update([
                'is_default' => 0
            ]);

            DeliveryAddress::where(['id' => $id])->update([
                'is_default' => 1
            ]);

            DB::commit();
            flash('Address has been updated.')->success();
        }
        catch(\Throwable $th) {
            DB::rollback();
            flash('Something went wrong. Try again later.')->error();
        }
        return back();
    }
}
