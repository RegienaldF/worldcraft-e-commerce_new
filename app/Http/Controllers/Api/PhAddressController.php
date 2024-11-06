<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PhRegion;
use App\Models\PhProvince;
use App\Models\PhCity;
use App\Models\PhBarangay;

class PhAddressController extends Controller
{
    public function get_regions() {
        return PhRegion::select('psgcCode', 'regDesc', 'regCode')->get();
    }
    public function get_province(Request $request) {
        return PhProvince::select('psgcCode', 'provDesc', 'regCode', 'provCode')->where('regCode', $request->region_code)->orderBy('provDesc', 'asc')->get();
    }
    public function get_city(Request $request) {
        return PhCity::select('psgcCode', 'citymunDesc', 'regDesc', 'provCode', 'citymunCode')->where('provCode', $request->province_code)->get();
    }
    public function get_barangay(Request $request) {
        return PhBarangay::select('brgyCode','brgyDesc','regCode','provCode','citymunCode')->where('citymunCode', $request->city_code)->get();
    }
}
