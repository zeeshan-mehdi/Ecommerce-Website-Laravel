<?php
/**
 * Created by PhpStorm.
 * User: zeesh
 * Date: 7/26/2019
 * Time: 4:04 PM
 */

namespace App\Model;


use App\Post;

class Cart
{
    public $totalPrice =0 ;
    public $totalQuantity=0;
    public $item = null ;


    /**
     * Cart constructor.
     */
    public function __construct()
    {

    }

    public function addProduct($id,$product){
        $newItem = ['id'=>$id,'quantity'=> 0,'price'=>$product->price,'title'=>$product->title,'description'=>$product->description];

        if($this->item){
            if(array_key_exists($id,$this->item)){
                $newItem = $this->item[$id];
            }
        }

        $newItem['quantity']++;

        $amount = str_replace(',','',$product->price);

        $amount =(int) str_replace('$','',$amount);


        $newItem['price'] = (int)$newItem['quantity']* $amount;

        $this->item[$id] = $newItem;
        $this->totalPrice +=$newItem['price'];

        $this->totalQuantity++;


    }


    public function addOne($id,$cart){
        if($cart->totalQuantity==0){
            return $cart;
        }

        $item_ = $cart->item[$id];
        $item_['quantity']++;

        $unitPrice = Post::find((int)$id);

        $amount = str_replace(',','',$unitPrice->price);

        $amount =(int) str_replace('$','',$amount);


        $item_['price'] = (int)$item_['quantity']* $amount;

        $cart->item[$id] = $item_;

        $cart->totalPrice += $amount;

        $cart->totalQuantity++;

        return $cart;

    }

    public function removeOne($id,$cart){
        if($cart->totalQuantity==0){
            return $cart;
        }

        $item_ = $cart->item[$id];
        $item_['quantity']--;

        if($item_['quantity']==0){
            $cart = $this->removeItem($id,$cart);
            $unitPrice = Post::find((int)$id);

            $amount = str_replace(',','',$unitPrice->price);

            $amount =(int) str_replace('$','',$amount);


            $item_['price'] = (int)$item_['quantity']* $amount;

            $cart->totalPrice -= $amount;

            $cart->totalQuantity--;
            return $cart;
        }

        $unitPrice = Post::find((int)$id);

        $amount = str_replace(',','',$unitPrice->price);

        $amount =(int) str_replace('$','',$amount);


        $item_['price'] = (int)$item_['quantity']* $amount;

        $cart->item[$id] = $item_;

        $cart->totalPrice -= $amount;

        $cart->totalQuantity--;
        return $cart;
    }

    public function removeItem($id,$cart){

        $item = $cart->item[$id];
        $this->totalQuantity-=$item['quantity'];
        $this->totalPrice -= $item['price'];


        unset($cart->item[$id]);

        return $cart;
    }


}