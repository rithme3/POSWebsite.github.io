<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\invoice;
use App\Models\InvoiceDetail;

class OrderController extends Controller
{
    public function index(){
        $data['products']=product::where('active',1)->get();
        $data['cartItems'] = \Cart::getContent();
        return view('admins.orders.index',$data);
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());
        $product = product::find($request->id);  
        // dd($product->thumbnail);   
        \Cart::add([
            'id' => $request->id,
            'name' => $product->name,
            'price' => $product->sell_price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $product->thumbnail
            )
        ]);

        return redirect()->back()->with('success', 'Product is Added to Cart Successfully !');
    }
    public function removeCart(Request $request,$id)
    {
        \Cart::remove($id);

        return redirect()->back()->with('success', 'Item Cart Remove Successfully !');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        return redirect()->back()->with('success', 'All item Cart Remove Successfully !');

    }

    public function saveOrder(Request $request)
    {
        $inv = new invoice;
        $total_amount = 0;
        $count_inv = invoice::whereYear('created_at',date('Y'))->count();
        if($count_inv == 0)
            $inv_ref = $count_inv + 1;
        else
            $inv_ref = $count_inv;
        $inv->inv_no = $this->invoiceRef($inv_ref);
        $inv->total_amount = $total_amount;
        $inv->created_by_id = auth()->user()->id;
        if($inv->save()){
            for($i=0;$i<count($request->id);$i++){
                $inv_detail = new InvoiceDetail;
                $inv_detail->invoice_id = $inv->id;
                $inv_detail->product_id = $request->id[$i];
                $inv_detail->price = $request->price[$i];
                $inv_detail->quantity = $request->quantity[$i];
                $inv_detail->total_price = $request->total[$i];
                if($inv_detail->save()){
                    \Cart::remove($request->id[$i]);
                }     
                $total_amount += $request->total[$i];          
            }
            invoice::where('id',$inv->id)->update(['total_amount'=>$total_amount]);

            session()->flash('print_url', route('invoice.print',$inv->id));
            return redirect()->back()->with('success', 'Invoice ceated Successfully !');
        }
    }
    public function invoiceRef($number,$prefix = "INV",$digit = 4){
        return $prefix.sprintf("%"."0$digit"."d",$number);
    }
}
