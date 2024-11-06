<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// MODELS
use App\Models\{
    Cart,
    Category,
    LocationArea,
    Products,
    Wishlist,
    Attribute,
    ProductStock
};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class CartController extends Controller
{

    public function index()
    {
        try {
            // Unset Session
            Session::forget('session_cart');

            $carts = DB::table('carts')
                ->select('carts.id', 'carts.item_name', 'carts.sku', 'carts.quantity', 'carts.unit_price', 'carts.location_id', 'pickup_points.name')
                ->leftJoin('pickup_points', 'carts.location_id', '=', 'pickup_points.id')
                ->where('carts.checkout_date', '=', NULL)
                ->where('carts.user_id', '=', Auth::user()->id)
                ->get();

            return view('pages.products.cart', compact('carts'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    // insert product on cart
    public function add_to_cart(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 403, 'message' => 'Login First.'], 403);
            // return redirect()->route('sign.in');
        } else {

            // validation checking if the sku with same location_id and based on user_id are exist
            $cartItem = Cart::where('sku', $request->sku)
                ->where('user_id', $request->user_id)
                ->where('location_id', $request->location_id)
                ->first();

            $available_stocks = DB::table('worldcraft_stocks')
                ->where('sku_id', $request->sku)
                ->where('pup_location_id', $request->location_id)
                ->value('quantity');


            // If the cart item exists with the same SKU and location_id, update the quantity
            if ($cartItem) {
                // update cart quantity
                // $cartItem->quantity += $request->quantity;

                $newQuantity = $cartItem->quantity + $request->quantity;
                if ($newQuantity > $available_stocks) {
                    return response()->json([
                        'status' => 'fail',
                        'message' => 'Quantity exceeds available stock. Please review your cart.'
                    ]);
                }

                $cartItem->quantity = $newQuantity;
                if ($cartItem->save()) {
                    return response()->json(['status' => 'success', 'message' => 'Quantity updated.']);
                } else {
                    return response()->json(['status' => 'fail', 'message' => 'Failed to update quantity.']);
                }
                // if ($cartItem->save()) {
                //     return response()->json(['status' => 'success', 'message' => 'Quantity updated.']);
                // } else {
                //     return response()->json(['status' => 'fail', 'message' => 'Failed to update quantity.']);
                // }
            } else {

                // If the item does not exist in the cart, check if requested quantity exceeds available stock
                if ($request->quantity > $available_stocks) {
                    return response()->json([
                        'status' => 'fail',
                        'message' => 'Requested quantity exceeds available stock. Please review your cart.'
                    ]);
                }

                // If the not exist, create a new one
                $cart = new Cart();
                $cart->product_id = $request->product_id;
                $cart->item_name = $request->product_name;
                $cart->sku = $request->sku;
                $cart->variant = $request->variant;
                $cart->quantity = $request->quantity;
                $cart->unit_price = $request->unit_price;
                $cart->user_id = $request->user_id;
                $cart->location_id = $request->location_id;

                if ($cart->save()) {
                    return response()->json(['status' => 'success', 'message' => 'Item added to cart.']);
                } else {
                    return response()->json(['status' => 'fail', 'message' => 'Failed to add item to cart.']);
                }
            }
        }


    }

    // update qty if sku exist and based on user_id
    public function updateQuantity(Request $request)
    {
        $cartItem = Cart::where('sku', $request->sku)
            ->where('user_id', $request->user_id)
            ->where('location_id', $request->location_id)
            ->first();

        $available_stocks = DB::table('worldcraft_stocks')
            ->where('sku_id', $request->sku)
            ->where('pup_location_id', $request->location_id)
            ->value('quantity');

        // Check if the cart item exists
        if ($cartItem) {
            if ($request->quantity > $available_stocks) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'The maximum quantity of this product has been reached. Please check available stock.',
                    'available_stock' => $available_stocks
                ]);
            }

            // If the quantity is valid, update the cart item
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            return response()->json(['status' => 'success', 'message' => 'Quantity updated.']);
        }
    }

    // delete individual item in cart
    public function delete_cart_item(Request $request)
    {
        try {
            $cartItem = Cart::findOrFail($request->id);
            $cartItem->delete();

            return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete item'], 500);
        }
    }

    public function proceed_to_shipping(Request $request)
    {
        try {
            $checkout_cart = $request->checkout_cart;

            Session::put('session_cart', $checkout_cart);

            return 1;
        } catch (\Throwable) {

        }
    }
}
