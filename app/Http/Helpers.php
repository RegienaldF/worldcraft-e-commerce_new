<?php
use App\Models\{
    BusinessSetting,
    Currency
};

function translate($text) {
    return $text;
}

function get_item_price1($sku, $location_id = null, $quantity = 1) {

    // default discounts
    $price = 0;
    $promo_discount = 0;
    $reseller_discount = 15.00;
    $dealer_discount = 20.00;

    $promo_thumbnail = null;

    $sku_promo = DB::table('promo_products')
                    ->select(
                        'promo_products.percentage_discount',
                        'promo_products.prorated_reseller_discount',
                        'promo_products.prorated_dealer_discount',
                        'promos.thumbnail'
                    )
                    ->leftJoin('promos', 'promos.id', '=', 'promo_products.promo_id')
                    ->where('promo_products.sku', $sku)
                    ->where('promo_products.location_id', $location_id)
                    ->where('promo_products.promo_status', 'approved')
                    ->where('promos.status', 'active')
                    ->whereRaw('NOW() BETWEEN promos.start AND promos.end')
                    ->orderBy('promo_products.id', 'DESC')
                    ->first();


    if($sku_promo) {
        $promo_discount = $sku_promo->percentage_discount;
        $reseller_discount = $sku_promo->prorated_reseller_discount;
        $dealer_discount = $sku_promo->prorated_dealer_discount;

        $promo_thumbnail = $sku_promo->thumbnail;
    }

    // GET THE LATEST SKU
    $product_stocks = DB::table('product_stocks')
                        ->leftJoin('products', 'product_stocks.product_id', 'products.id')
                        ->where([
                            'product_stocks.sku' => $sku,
                            'products.published' => 1
                        ])
                        ->orderBy('product_stocks.id', 'DESC')
                        ->first();

    if($product_stocks) {
        $price = $product_stocks->price;
    }

    $srp = $price;

    $price -= $price * $promo_discount / 100;

    if(Auth::check()) {
        if(Auth::user()->user_type == 'reseller') {
            $price -= $price * $reseller_discount / 100;
        }
        elseif(Auth::user()->user_type == 'dealer') {
            $price -= $price * $dealer_discount / 100;
        }
    }

    $srp = round($srp, 2);
    $price = round($price, 2);

    $data = [
        'srp' => $srp * $quantity,
        'price' => $price * $quantity,
        'promo_discount' => $promo_discount,
        'promo_thumbnail' => $promo_thumbnail
    ];

    return $data;
}
function get_item_price($sku, $location_id = null, $quantity = 1) {
    // default discounts
    $price = 0;
    $promo_discount = 0;
    $reseller_discount = 15.00;
    $dealer_discount = 20.00;
    $promo_thumbnail = null;

    // Combine the promo and product query into one
    $product_info = DB::table('product_stocks')
                      ->select(
                          'product_stocks.price',
                          'promos.thumbnail',
                          'promo_products.percentage_discount',
                          'promo_products.prorated_reseller_discount',
                          'promo_products.prorated_dealer_discount'
                      )
                      ->leftJoin('promo_products', function($join) use ($sku, $location_id) {
                          $join->on('promo_products.sku', '=', 'product_stocks.sku')
                               ->where('promo_products.location_id', '=', $location_id)
                               ->where('promo_products.promo_status', '=', 'approved');
                      })
                      ->leftJoin('promos', function($join) {
                          $join->on('promos.id', '=', 'promo_products.promo_id')
                               ->where('promos.status', '=', 'active')
                               ->whereRaw('NOW() BETWEEN promos.start AND promos.end');
                      })
                      ->leftJoin('products', 'product_stocks.product_id', '=', 'products.id')
                      ->where([
                          'product_stocks.sku' => $sku,
                          'products.published' => 1
                      ])
                      ->orderBy('promo_products.id', 'DESC')
                      ->orderBy('product_stocks.id', 'DESC')
                      ->first();

    if($product_info) {
        $price = $product_info->price;
        $promo_discount = $product_info->percentage_discount ?? $promo_discount;
        $reseller_discount = $product_info->prorated_reseller_discount ?? $reseller_discount;
        $dealer_discount = $product_info->prorated_dealer_discount ?? $dealer_discount;
        $promo_thumbnail = $product_info->thumbnail;
    }

    // Calculate the SRP
    $srp = $price;
    $price -= $price * $promo_discount / 100;

    if (Auth::check()) {
        $user_type = Auth::user()->user_type;
        if ($user_type == 'reseller') {
            $price -= $price * $reseller_discount / 100;
        } elseif ($user_type == 'dealer') {
            $price -= $price * $dealer_discount / 100;
        }
    }

    // Round SRP and price
    $srp = round($srp, 2);
    if($location_id == null) {

        $price = $srp;
    }
    else {
        $price = round($price, 2);

    }

    // Return calculated data
    return [
        'srp' => $srp * $quantity,
        'price' => $price * $quantity,
        'promo_discount' => $promo_discount,
        'promo_thumbnail' => $promo_thumbnail,
        'prorated_reseller_discount' => $reseller_discount,
        'prorated_dealer_discount' => $dealer_discount
    ];
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = \App\Models\Upload::find($id)) != null) {
            return asset($asset->file_name);
        }
        return null;
    }
}
if (! function_exists('currency_symbol')) {
    function currency_symbol()
    {
        $code = Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        if(Session::has('currency_code')){
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        }
        else{
            $currency = Currency::where('code', $code)->first();
        }
        return $currency->symbol;
    }
}
//converts currency to home default currency
if (! function_exists('convert_price')) {
    function convert_price($price)
    {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if($business_settings != null){
            $currency = Currency::find($business_settings->value);
            $price = floatval($price) / floatval($currency->exchange_rate);
        }

        $code = Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        if(Session::has('currency_code')){
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        }
        else{
            $currency = Currency::where('code', $code)->first();
        }

        $price = floatval($price) * floatval($currency->exchange_rate);

        return $price;
    }
}

//formats currency
if (! function_exists('format_price')) {
    function format_price($price)
    {
        if (BusinessSetting::where('type', 'decimal_separator')->first()->value == 1) {
            $fomated_price = number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value);
        }
        else {
            $fomated_price = number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value , ',' , ' ');
        }

        if(BusinessSetting::where('type', 'symbol_format')->first()->value == 1){
            return currency_symbol().$fomated_price;
        }
        return $fomated_price.currency_symbol();
    }
}

//formats price to home default price with convertion
if (! function_exists('single_price')) {
    function single_price($price)
    {
        return format_price(convert_price($price));
    }
}
if (!function_exists('unique_order_code')) {
    function unique_order_code () {
        $now = \Carbon\Carbon::now();

        $number = $now->year . $now->month . '-' . mt_rand(10000, 99999);

        if (unique_order_code_exists($number)) {
            return unique_order_code();
        }

        return $number;
    }
}
if (!function_exists('unique_order_code_exists')) {
    function unique_order_code_exists ($number) {
        return \App\Models\Order::where('unique_code', $number)->exists();
    }
}

if (!function_exists('unique_order_number')) {
    function unique_order_number () {
        $latest_order = \App\Models\Order::latest()->first();

        $now = \Carbon\Carbon::now();

        $latest_id = $latest_order->id + 1;

        $number =  $now->year . $now->month . '-' . $latest_id;

        if (unique_order_number_exists($number) && unique_order_number_cancelled_exists($number)) {
            return unique_order_number();
        }

        return $number;
    }
}
