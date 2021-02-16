<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\Coupon;
use Inertia\Inertia;
use Cart;

class CartController extends Controller
{
    //
    public function index()
    {
        //
        $items = Cart::content();
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $total = Cart::total();
        //dd($items);
        return Inertia::render('Cart',[
          'items' => $items,
          'subtotal' => $subtotal,
          'tax' => $tax,
          'total' => $total

        ]);
    }
    public function AddToCart(Request $request)
    {
        //
        $quantity = $request->get('Quantity');
        $product_id = $request->get('Product');
        $product = Product::find($product_id);
        //dd($product);

        Cart::add($product->id,$product->title,$quantity,$product->price);
        return redirect::route('Cart');
    }
    public function RemoveFromCart(Request $request){

       $rowId = $request->get('row');
       //dd($rowId);
       Cart::remove($rowId);
       return redirect::route('Cart');
    }
    public function UpdateFromCart(Request $request){

      $rowId = $request->get('row');
      $qty = $request->get('qty');
      $type = $request->get('type');
      $newqty=$qty;

       if($type==0){
         if($qty>1){
           $newqty=$qty-1;
         }
       }else {
         $newqty=$qty+1;
       }
       //dd($newqty);
       Cart::update($rowId,$newqty);
       return redirect::route('Cart');
    }
    public function UseCoupons (Request $request)
    {
      $discount_code = $request->get('coupon');
      //$coupon = Coupon::find($discount_code);

      if($discount_code){
        $percentage_value = Coupon::where('discount_code', $discount_code)->first()->percentage_value;
        $subtotal = Cart::subtotal();
        $result = str_replace( array(",", "'", ";"), '', $subtotal);
        $discount =((int)$result)*($percentage_value/100);
        $subtotal = $result - $discount;
        $items = Cart::content();
        $tax = Cart::tax();
        $result = str_replace( array(",", "'", ";"), '', $tax);
        $total = (string)($subtotal + $tax);

        //dd($total);
        return Inertia::render('Cart',[
          'items' => $items,
          'subtotal' => $subtotal,
          'tax' => $tax,
          'total' => $total
        ]);
      }else {
        return redirect::route('Cart');
      }
    }

}
