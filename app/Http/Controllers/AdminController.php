<?php

namespace App\Http\Controllers;

use App\Models\AdminUsers;
use App\Models\Customer;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    private const TSHIRTS = 'tshirts';
    private const TROUSERS = 'trousers';
    private const UNDERWEARS = 'underwears';
    private const SHORTS = 'shorts';

    public function paidCustomers()
    {
        $customers = Customer::where('payed', true)->paginate(8);
        return view('admin.customers')->with('customers', $customers)->with('status', 1);
    }

    public function unpaidCustomers()
    {
        $customers = Customer::where('payed', false)->paginate(8);
        return view('admin.customers')->with('customers', $customers)->with('status', 0);
    }


    public function getOrders($id)
    {
        $orders = Customer::find($id)->orders;

        return view('admin.orders')->with('orders', $orders);
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginPOST(Request $request)
    {
        $admin =  AdminUsers::where(['username' => $request->get('username')])->first();

        if (!$admin) return redirect('/site-admin/login');

        if (!password_verify($request->get('password'), $admin->password)) return back();

        session()->put('is_admin', true);

        return redirect()->route('root.paid-customers');
    }

    public function addProduct()
    {
        return view('admin.add_product');
    }

    private function uploadProduct($file, $type)
    {
        $file_name = UuidV4::uuid4() . $file->getClientOriginalName();
        $destination_path = public_path() . '/images/' . $type;
        $file->move($destination_path, $file_name);

        return '/images/' . $type . '/' . $file_name;
    }


    public function addProductPOST(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'quantity' => 'required|numeric',
            'delivery_fee' => 'required|numeric',
            'description' => 'required',
            'type' => ['required', Rule::in(['tshirts', 'trousers', 'shorts', 'underwears'])],
            'price' => 'required|numeric'
        ]);


        $file = $request->file('image_url');
        $type = $request->get('type');
        $image_url = '';

        switch ($type) {
            case self::TSHIRTS:
                $image_url = $this->uploadProduct($file, self::TSHIRTS);
                break;
            case self::SHORTS:
                $image_url = $this->uploadProduct($file, self::SHORTS);
                break;
            case self::UNDERWEARS:
                $image_url = $this->uploadProduct($file, self::UNDERWEARS);
                break;
            case self::TROUSERS:
                $image_url = $this->uploadProduct($file, self::TROUSERS);
                break;
        }

        Products::create([
            'title' => $request->get('title'),
            'quantity' => $request->get('quantity'),
            'delivery_fee' => $request->get('delivery_fee'),
            'description' => $request->get('description'),
            'type' => $request->get('type'),
            'price' => $request->get('price'),
            'image_url' => $image_url
        ]);

        Session::flash('admin-added');

        return back();
    }

    public function logout()
    {
        session()->remove('is_admin');

        return redirect('/');
    }
}
