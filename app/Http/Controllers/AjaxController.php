<?php

namespace App\Http\Controllers;

use App\Address;
use App\Model\EarningModel;
use App\Orders;
use Illuminate\Http\Request;
use App\Post;
use App\Model\Cart;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;
use Psy\Util\Json;


class AjaxController extends Controller
{

    public function price(Request $request)
    {
        if ($request->ajax()) {
            $value = $request->total;


            $address = new Address();

            $address->name = $request->name;
            $address->contact = $request->contact;
            $address->province = $request->province;
            $address->city = $request->city;
            $address->area = $request->area;
            $address->street = $request->street;

            if (Auth::check()) {
                $address->user_id = Auth::id();
            }

            $address->save();

            session(['total' => $value]);

            try {
                //$request->session()->forget('error');
            } catch (Exception $e) {

            }

            return session('total');
        }
    }

    public function getPrice()
    {
        return session('total');
    }


    public function cart(Request $request)
    {

        $id = $request->id;

        $intId = (int)$id;

        $post = Post::find($intId);

        $q = $post->quantity;
        $q--;

        $request->session()->has('cart') ? $cart = session('cart') : $cart = null;

        if (!$cart)
            $cart = new Cart();

        $cart->addProduct($intId, $post);

        $request->session()->put('cart', $cart);


        $post->quantity = $q;
        $post->save();


        return "success";


    }

    public function setPriceZero()
    {
        $cart = session('cart');

        if ($cart !== null) {
            $cart->totalPrice = 0;
        }
        session(['total' => '0']);
    }

    public function getTotalPrice()
    {
        $items = cart::all();

        $totalPrice = 0;

        foreach ($items as $item) {
            $val = str_replace(',', '', $item->price);
            return ((int)str_replace('$', '', $val));
        }

        return $totalPrice;
    }

    public function deleteItem(Request $request)
    {
        $id = $request->id;

        $cart = session('cart');

        $cart = $cart->removeItem($id, $cart);
        session(['total' => $cart->totalPrice]);
        session(['qty' => $cart->totalQuantity]);
        return json_encode($cart);
    }

    public function deleteProduct(Request $request)
    {
        $id = $request->id;

        Post::find($id)->delete();

        return 'Success';

    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function addItem(Request $request)
    {
        $id = $request->id;

        $cart = session('cart');

        $cart = $cart->addOne($id, $cart);


        session(['total' => $cart->totalPrice]);
        session(['qty' => $cart->totalQuantity]);

        $post = Post::find($id);

        $q = $post->quantity;
        $q++;

        $post->quantity = $q;
        $post->save();

        return json_encode($cart);

    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function minusItem(Request $request)
    {
        $id = $request->id;

        $cart = session('cart');

        $cart = $cart->removeOne($id, $cart);

        session(['qty' => $cart->totalQuantity]);
        session(['total' => $cart->totalPrice]);

        $post = Post::find($id);

        $q = $post->quantity;
        $q--;
        $post->quantity = $q;
        $post->save();
        return json_encode($cart);
    }

    public function changeOrderStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $order = Orders::find($id);

        $order->status = $status;

        $order->save();

        return "Success";

    }

    public function getStockCount(Request $request)
    {

        $products = Post::all();

        $count = 0;
        $total = 0;
        foreach ($products as $product) {
            $count += $product->quantity;
            $total += $product->total;
        }


        return $count / $total;

    }

    public function getOrdersCount(Request $request)
    {

        $orders = Orders::all();

        return count($orders);

    }

    public function getSalesCount(Request $request)
    {

        $orders = Orders::all();

        $count = 0;

        foreach ($orders as $ord) {
            if ($ord->status === 'Delivered') {
                $count += $ord->quantity;
            }
        }

        return $count;

    }


    public function getEarningsByDate(Request $request)
    {

        $orders = Orders::all();

        $earnings = new EarningModel();

        foreach ($orders as $ord) {

            if (strtolower($ord->status) === 'delivered') {

                $price = ($ord->price * $ord->quantity);

                $d = substr($ord->created_at, 0, 10);

                $earnings->insert($ord->id, $price, $d);
            }
        }


        //session(['earnings'=>$earnings]);

        return json_encode($earnings);

    }


    public function retrieveTotalBalance()
    {


        \Stripe\Stripe::setApiKey('sk_test_SOd1Kj11fUIX8ckHEWeAZrlS00VWcni6h9');

        $balance = \Stripe\Balance::retrieve();

        $available = $balance->available;

        $amount = 0;

        foreach ($available as $avail) {
            $amount += $avail->amount;
        }

        return $amount;


    }


    public function getTopCategories()
    {
        $products = Post::all();

        $categories = null;


        foreach ($products as $product) {
            $category = $product->category;


            if ($categories === null) {
                $count = 0;
                foreach ($products as $pro) {
                    if ($pro->category === $category) {
                        $count++;
                    }
                }

                $categories[$category] = ['category' => $category, 'count' => $count];
            } else if (!key_exists($category, $categories)) {
                $count = 0;
                foreach ($products as $pro) {
                    if ($pro->category === $category) {
                        $count++;
                    }
                }

                $categories[$category] = ['category' => $category, 'count' => $count];
            }

        }
        return json_encode($categories);
    }

    public function fetchAddress(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::check()) {
                $id = Auth::id();

                $address = Address::where('user_id', $id)->get();
                if ($address === null) {
                    return null;
                }

                return json_encode($address);
            } else {
                return null;
            }
        }
        return null;
    }

    public function fetchUserAddress(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $address = Address::where('user_id', $id)->get();
            if ($address === null) {
                return null;
            }

            return json_encode($address);
        }
        return null;
    }


}
