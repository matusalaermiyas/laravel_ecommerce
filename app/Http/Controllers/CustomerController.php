<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Session;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function submit(Request $request)
    {
        $total_price = 0;

        $user_id = Session::get('user_id');

        $customer = Customer::create([
            'customer_name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'region' => $request->get('region'),
            'kebele' => $request->get('kebele'),
            'user_id' => $user_id
        ]);

        $cart = session()->get('cart');

        foreach ($cart as $key => $value) {
            Order::create([
                'size' => $value['size'],
                'quantity' => $value['quantity'],
                'item_name' =>  $value['title'],
                'price' => $value['price'],
                'customer_id' => $customer->id
            ]);

            $total_price += ($value['quantity'] * $value['price']);
        };

        session()->put('total_price', $total_price);
        session()->put('customer_id', $customer->id);

        return redirect('/customer/stripe');
    }
    public function stripe()
    {
        return view('customer.stripe');
    }

    public function stripePost(Request $request)
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $res = Stripe\Charge::create([
                'amount' =>  ceil(session()->get('total_price')),
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Ecommerce payment',
                'metadata' => ['customer_id' => session()->get('customer_id')]
            ]);

            $customer_id = $res['metadata']['customer_id'];


            $customer = Customer::find($customer_id);


            if (!$customer) return; // TODO: Not Found After Paying

            $customer->payed = true;
            $customer->save();

            session()->remove('cart');
            session()->remove('total_price');
            session()->remove('customer_id');

            Session::flash('payment-success', 'Payment Success');

            return redirect('/');
        } catch (Exception $ex) {
            return $ex;

            Session::flash('payment-error', 'Error');
            return redirect('/customer/stripe');
        }
    }

    public function login()
    {
        return view('customer.login');
    }

    public function loginPOST(Request $request)
    {
        $customer = User::where('email', $request->get('email'))->first();

        if (!$customer || !password_verify($request->get('password'), $customer->password)) return back();

        Session::put('customer_logged', 1);
        Session::put('user_id', $customer->id);
        Session::put('customer_name', $customer->name);

        return  redirect(route('customer.dashboard'));
    }


    public function register()
    {
        return view('customer.register');
    }

    public function registerPOST(Request $request)
    {
        $request->validate([
            'email' => 'email|unique:users',
            'password' => 'required',
            'username' => 'required'
        ]);

        User::create([
            'name' => $request->username,
            'password' => Hash::make($request->get('password')),
            'email' => $request->email
        ]);

        Session::flash('account-created', 'Account created successfully');

        return redirect(route('customer.login'));
    }

    public function dashboard()
    {
        $orders = [];

        $data = Customer::where('user_id', Session::get('user_id'))->get();

        foreach ($data as $d) array_push($orders, ['delivered' => $d->delivered, 'orders' => $d->orders]);

        return view('customer.dashboard')->with('orders', $orders);
    }

    public function logout()
    {
        Session::remove('customer_logged');
        Session::remove('user_id');
        Session::remove('customer_name');

        return redirect(route('customer.login'));
    }
}
