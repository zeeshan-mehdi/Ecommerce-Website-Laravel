<?php
   
namespace App\Http\Controllers;
   
use App\cart;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;
use Illuminate\Support\Facades\Redirect;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = session('total');
        

        if($amount==0){
            Session::flash('error', 'Amount is 0$');
            return redirect('/posts');
        }

        Stripe\Charge::create ([
                "amount" => $amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from ecommerce-app.test"
        ]);
  
        Session::flash('success', 'Payment successful!');

        $user = Auth::id();

        if($user!==null){

            $found = session('cart');

            $found = $found->item;

            foreach($found as $item){
                $order = new Orders;
                $order->user_id = $user;
                $order->quantity = $item['quantity'];
                $order->price = $item['price'];
                $order->item = $item['id'];
                $order->status = 'processing';
                $order->save();
            }

            session()->forget('cart');
        }else{
            session()->flash('user not logged in');
            \redirect('/login');
        }
        
          
        return Redirect('/posts');
    }
}
