<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClothesController extends Controller
{
    public function tshirts()
    {
        $tshirts = Products::where('type', 'tshirts')->paginate(8);
        return view('clothes.tshirts')->with('products', $tshirts);
    }

    public function trousers()
    {
        $trousers = Products::where('type', 'trousers')->paginate(6);
        return view('clothes.trousers')->with('products', $trousers);
    }
    public function shorts()
    {
        $shorts = Products::where('type', 'shorts')->paginate(6);
        return view('clothes.shorts')->with('products', $shorts);
    }

    public function underwears()
    {
        $underwears = Products::where('type', 'underwears')->paginate(6);
        return view('clothes.underwears')->with('products', $underwears);
    }

    public function addToCart($id)
    {
        if(!isset($_REQUEST['type'])) return redirect('/');

        $product = Products::find($id);

        if(!$product) return redirect('/');

        $type = $_REQUEST['type'];

        if($type == 'trousers' || $type == 'shorts') 
        {
            return view('layouts.add_size')->with('product', $product);
        }
        else if($type == 'tshirts' || $type == 'underwears')
        {
            return view('layouts.add_no_size')->with('product', $product);
        }
        else return redirect('/');
    }

    public function addItemToCart(Request $request)
    {
        $data = $request->all();
        $oldSession = session()->get('cart');

        $id = $data['id'];
        $amount = [
            'color' => $data['color'], 
            'size' => $data['size'], 
            'quantity' => $data['quantity'],
            'image_url' => $data['image_url'],
            'title' => $data['title'],
            'price' => $data['price'],
            'id' => $data['id']
        ];

        if($oldSession)
        {
            $oldSession[$id] = $amount;
            session()->put('cart', $oldSession);
        }
        else {
            session()->put('cart', [
                $id => $amount
            ]);
        }


        Session::flash('added', 'Added');

        return redirect()->back();
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        return view('clothes.checkout')->with('cart', $cart);
    }

    public function removeFromCart(Request $request)
    {    
        $cart = session()->get('cart');
        $id = $request->get('id');

        unset($cart[$id]);

        session()->put('cart', $cart);

        if(count($cart) <= 0) return redirect('/');

        return redirect()->back();
    }

    public function buy()
    {
        return view('clothes.buy');
    }
}