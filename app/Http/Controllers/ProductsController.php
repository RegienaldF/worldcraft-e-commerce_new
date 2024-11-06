<?php

namespace App\Http\Controllers;

use App\Promo;
use App\Models\Cart;
use App\PromoProduct;
use App\Models\Category;
use App\Models\Products;
use App\Models\Wishlist;
use App\Models\Attribute;
use App\Models\PickupPoint;
use App\Models\LocationArea;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\WarehouseDiscount;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    // Display category and display products based on selected category
    public function search_by_category($slug, Request $request)
    {
        // $products = \App\Models\ProductCategory::leftJoin('products', 'products.id', 'product_categories.product_id')
        //                                        ->leftJoin('product_stocks', function ($join) {
        //                                             $join->on('products.id', 'product_stocks.product_id')
        //                                                 ->where('product_stocks.id', '=', function ($query) {
        //                                                     $query->select(DB::raw('MAX(id)'))
        //                                                 ->from('product_stocks')
        //                                                 ->whereColumn('product_stocks.sku', 'product_stocks.sku')
        //                                                 ->whereColumn('product_stocks.product_id', 'products.id');
        //                                                });
        //                                        })
        //                                        ->where('products.published', 1)
        //                                        ->where('category', $slug)
        //                                        ->select('products.id', 'products.name', 'product_stocks.sku', 'product_stocks.price AS unit_price', 'products.thumbnail_img AS image')
        //                                        ->paginate(12);

        // $products = \App\Models\ProductCategory::leftJoin('products', 'products.id', 'product_categories.product_id')
        //                                        ->leftJoin('product_stocks', function ($join) {
        //                                             $join->on('products.id', 'product_stocks.product_id')
        //                                                  ->where('product_stocks.id', '=', function ($query) {
        //                                                     $query->select(DB::raw('MAX(id)'))
        //                                                           ->from('product_stocks')
        //                                                           ->whereColumn('product_stocks.sku', 'product_stocks.sku')
        //                                                           ->whereColumn('product_stocks.product_id', 'products.id');
        //                                             });
        //                                         })
        //                                         ->leftJoin('promo_products', function($join) {
        //                                             $join->on('promo_products.sku', '=', 'product_stocks.sku')
        //                                                  ->where('promo_products.promo_status', '=', 'approved');
        //                                             })
        //                                         ->leftJoin('promos', function($join) {
        //                                             $join->on('promos.id', '=', 'promo_products.promo_id')
        //                                                  ->where('promos.status', '=', 'active')
        //                                                  ->whereRaw('NOW() BETWEEN promos.start AND promos.end');
        //                                         })
        //                                         ->where('products.published', 1)
        //                                         ->where('product_categories.category', $slug) // Changed to refer to product_categories
        //                                         ->select(
        //                                             'products.id',
        //                                                      'products.name',
        //                                                      'product_stocks.sku',
        //                                                      'product_stocks.price AS unit_price',
        //                                                      'products.thumbnail_img AS image',
        //                                                      'promos.thumbnail AS promo_thumbnail', // Add promo thumbnail
        //                                                      'promo_products.percentage_discount',
        //                                                      'promo_products.prorated_reseller_discount',
        //                                                      'promo_products.prorated_dealer_discount'
        //                                         )
        //                                         ->groupBy('products.id', 'products.name') // Group by product ID and name
        //                                         ->orderBy('products.name', 'ASC') // Optional: Order by product name
        //                                         ->paginate(50);

        $products = \App\Models\ProductCategory::leftJoin('products', 'products.id', 'product_categories.product_id')
            ->leftJoin('product_stocks', function ($join) {
                $join->on('products.id', 'product_stocks.product_id')
                    ->where('product_stocks.id', '=', function ($query) {
                        $query->select(DB::raw('MAX(id)'))
                            ->from('product_stocks')
                            ->whereColumn('product_stocks.sku', 'product_stocks.sku')
                            ->whereColumn('product_stocks.product_id', 'products.id');
                    });
            })
            ->leftJoin('promo_products', function ($join) {
                $join->on('promo_products.sku', '=', 'product_stocks.sku')
                    ->where('promo_products.promo_status', '=', 'approved');
            })
            ->leftJoin('promos', function ($join) {
                $join->on('promos.id', '=', 'promo_products.promo_id')
                    ->where('promos.status', '=', 'active')
                    ->whereRaw('NOW() BETWEEN promos.start AND promos.end');
            })
            ->leftJoin('uploads', 'products.thumbnail_img', '=', 'uploads.id')
            ->where('products.published', 1)
            ->where('product_categories.category', $slug)
            ->select(
                'products.id',
                'products.name',
                DB::raw('MAX(products.slug) AS slug'),
                DB::raw('MAX(product_stocks.sku) as sku'),
                DB::raw('MAX(product_stocks.price) AS unit_price'),
                DB::raw('MAX(products.thumbnail_img) AS image'),
                DB::raw('MAX(promos.status) AS promos_status'),
                DB::raw('MAX(promo_products.promo_status) AS item_promo_status'),
                DB::raw('MAX(promos.thumbnail) AS promo_thumbnail'),
                DB::raw('MAX(promo_products.percentage_discount) as percentage_discount'),
                DB::raw('MAX(promo_products.prorated_reseller_discount) as prorated_reseller_discount'),
                DB::raw('MAX(promo_products.prorated_dealer_discount) as prorated_dealer_discount'),
                DB::raw('MAX(uploads.file_original_name) AS file_original_name'),
                DB::raw('MAX(uploads.file_name) AS file_name')
            )
            ->groupBy('products.id', 'products.name')
            ->paginate(perPage: 20);

        $total_page = $products->lastPage();
        // dd($products);
        // dd($products->toArray()['data']);
        if ($request->ajax()) {
            $view = view('pages.products.display_category_product.data', compact('products'))->render();
            return response()->json(['html' => $view]);
        }
        return view('pages.products.products_list', compact('products', 'total_page', 'slug'));
    }

    // get product variant based on selected product in category and displayed to product details
    public function get_variation(Request $request, $slug)
    {
        try {
            $category = Category::get();
            $product = Products::where('slug', $slug)->first();
            $productId = $product->id;

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }

            $choiceOptions = json_decode($product->choice_options, true);
            $attributes = [];

            foreach ($choiceOptions as $option) {
                $attribute = Attribute::find($option['attribute_id']);

                if ($attribute) {
                    $attributes[strtolower($attribute->name)] = $option['values'];
                }
            }

            // initial product data for the product details page
            // $productStocks = DB::table('products as a')
            //     ->leftJoin('product_stocks as b', 'a.id', '=', 'b.product_id')
            //     ->leftJoin('product_stocks_descriptions as c', 'b.sku', '=', 'c.sku')
            //     ->select('a.name', 'a.category_id', 'a.tags', 'a.choice_options', 'b.sku', 'b.variant', 'b.qty', 'c.description')
            //     ->where('a.id', $productId)
            //     ->get();

            $productStocks = DB::table('products as a')
                ->leftJoin('product_stocks as b', 'a.id', '=', 'b.product_id')
                ->leftJoin('product_stocks_descriptions as c', 'b.sku', '=', 'c.sku')
                ->leftJoin('uploads as d', 'a.thumbnail_img', '=', 'd.id')
                ->select('a.name AS name', 'a.category_id AS category_id', 'a.tags AS tags', 'a.choice_options AS choice_options', 'b.sku AS sku', 'b.variant AS variant', 'b.qty AS qty', 'c.description AS description', 'd.file_original_name AS file_original_name', 'd.file_name AS file_name')
                ->where('a.id', $productId)
                ->get();

            // dd($productStocks);

            return view('pages.products.product_details', compact('category', 'product', 'attributes', 'productStocks'));

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    // display product quantity per warehouse
    public function getStockQuantity(Request $request)
    {
        $sku = $request->sku;
        $warehouses = DB::table('pickup_points as pup')
            ->select('pup.id', 'pup.name', 'pup.address', 'ws.sku_id', 'ws.quantity')
            ->leftJoin('worldcraft_stocks as ws', 'ws.pup_location_id', '=', 'pup.id')
            ->where('pup.pick_up_status', 1)
            ->whereNotIn('pup.id', ['34','35','36','38'])
            ->where('ws.sku_id', $sku)
            ->where('ws.quantity', '!=', 0)
            ->orderBy('pup.name', 'asc')
            ->get();
        return response()->json($warehouses);
    }

    // display SKU based on selected variant and product description
    public function product_variation(Request $request)
    {
        $productId = $request->product_id;
        $variant = $request->variant;
        try {
            // $latestProductStocks = ProductStock::select('image', 'price', 'product_id', 'sku', 'variant')
            //     ->where('id', function ($query) use ($productId, $variant) {
            //         $query->select(DB::raw('MAX(id)'))
            //             ->from('product_stocks')
            //             ->where('product_id', $productId)
            //             ->where('variant', $variant)
            //             ->whereColumn('sku', 'product_stocks.sku');
            //     })
            //     ->first();

            $latestProductStocks = ProductStock::select('product_stocks.image AS image', 'product_stocks.price AS price', 'product_stocks.product_id AS product_id', 'product_stocks.sku AS sku', 'product_stocks.variant AS variant', 'uploads.file_original_name AS file_original_name', 'uploads.file_name AS file_name')
                ->leftJoin('uploads', 'product_stocks.image', '=', 'uploads.id')
                ->where('product_stocks.id', function ($query) use ($productId, $variant) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('product_stocks')
                        ->where('product_id', $productId)
                        ->where('variant', $variant)
                        ->whereColumn('sku', 'product_stocks.sku');
                })
                ->first();
            return response()->json($latestProductStocks);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    // display wishlist
    public function wishlist()
    {
        $category = Category::get();
        return view('pages.products.wishlist', compact('category'));
    }

    // insert product to wishlist
    public function add_wishlist(Request $request)
    {
        $wishlist = new Wishlist();
        $wishlist->user_id = $request->user_id;
        $wishlist->product_id = $request->product_id;

        if ($wishlist->save()) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }

    // // display checkout page
    // public function checkout()
    // {
    //     $category = Category::get();
    //     return view('pages.products.checkout', compact('category'));
    // }

}
