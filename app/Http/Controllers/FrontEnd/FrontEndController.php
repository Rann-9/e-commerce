<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Midtrans\Config;
use Midtrans\Snap;

class FrontEndController extends Controller
{
    public function index()
    {
        $category = Category::select('id', 'name', 'slug')->latest()->limit(8)->get();
        $product = Product::with('product_galleries')->select('id', 'name', 'slug', 'price')->latest()->get();

        return view('pages.Frontend.index', compact(
            'category',
            'product'
        ));
    }

    public function detailProduct($slug)
    {
        $product = Product::with('product_galleries')->where('slug', $slug)->first();
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $recommendation = Product::with('product_galleries')->select('id', 'name', 'slug', 'price')->inRandomOrder()->limit(4)->get();
        return view('pages.Frontend.detail-product', compact(
            'product',
            'category',
            'recommendation'
        ));
    }

    public function detailCategory($slug)
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $categories = Category::where('slug', $slug)->first();
        $product = Product::with('product_galleries')->where('category_id', $categories->id)->get();

        return view('pages.Frontend.detail-category', compact(
            'categories',
            'category',
            'product'
        ));
    }

    public function cart(Request $request)
    {
        $cart = Cart::with('product')->where('user_id', auth()->user()->id)->get();

        // dd($cart);

        $category = Category::select('id', 'name', 'slug')->latest()->get();
        return view('pages.Frontend.cart', compact(
            'category',
            'cart'
        ));
    }

    public function addToCart(Request $request, $id)
    {
        try {
            Cart::create([
                'product_id' => $id,
                'user_id' => auth()->user()->id
            ]);

            return redirect()->route('cart');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }
    }

    public function deleteCart($id)
    {
        try {
            Cart::findOrFail($id)->delete();

            return redirect()->route('cart');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back();
        }
    }

    public function checkout(Request $request)
    {
        try {
            // request data
            $data = $request->all();

            // get data cart user
            $cart = Cart::with('product')->where('user_id', auth()->user()->id)->get();
            // dd data cart
            // dd($cart);

            // create transaction
            $transaction = Transaction::create([
                'user_id' => auth()->user()->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'total_price' => $cart->sum('product.price'),
            ]);

            // create transaction item
            foreach ($cart as $item) {
                TransactionItem::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $item->product_id,
                    'transaction_id' => $transaction->id
                ]);
            }

            // delete cart
            Cart::where('user_id', auth()->user()->id)->delete();

            // settind midtrans
            // use Midtrans\Config;
            // user Midtrans\Snap;
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$clientKey = config('services.midtrans.clientKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');

            // setup variable midtrans
            $midtrans = [
                'transaction_details' => [
                    'order_id' => 'RANN' . $transaction->id,
                    'gross_amount' => (int) $transaction->total_price,

                ],
                'customer_details' => [
                    'first_name' => $transaction->name,
                    'email' => $transaction->email,
                    'phone' => $transaction->phone,
                ],
                'enable_payment' => ['gopay', 'bank_transfer'],
                'vtweb' => []
            ];

            // create payment url from midtrans
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // update payment url
            $transaction->update([
                'payment_url' => $paymentUrl
            ]);

            // dd($transaction);

            return redirect($paymentUrl);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back();
        }
    }
}
