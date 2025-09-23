<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $customer=Customer::all();
       return view('customer.index',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // dd('tess');
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request-> validate([
            'customer_id'=>'required|numeric|unique:customers,customer_id',
            'username'=>'required|string|max:255',
            'password'=>'required|string|max:255',
            'nama_customer'=>'required|string|max:255',
            'no_telp'=>'required|string|max:255',
            'email'=>'required|string|max:255',
         ]);


    Customer::create([
    'customer_id'=>$request->customer_id,
    'username'=>$request->username,
    'password'=>Hash::make($request->password),
    'nama_customer'=>$request->nama_customer,
    'no_telp'=>$request->no_telp,
    'email'=>$request->email,
    ]);

    $hak_akses = $request->hak_akses ?? 'pengunjung';

    User::create([
        'name'=>$request->username,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'hak_akses'=>$hak_akses,
        ]);

    return redirect('customer')->with('success','customer Berhasil Ditambah..');

    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($customer_id)
    {
        // dd($id);
        $customer=Customer::where('customer_id',$customer_id)->first();
        return view('customer/edit',compact('customer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $customer_id)
    {

        $customer=Customer::where('customer_id',$customer_id)->first();

        if(!$customer) {
            return redirect('customer')->with('success','customer Gagal Diubah..');
        }


        //update data
        $customer-> update ([
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'nama_customer'=>$request->nama_customer,
            'no_telp'=>$request->no_telp,
            'email'=>$request->email,
        ]);

        $hak_akses = $request->hak_akses ?? 'pengunjung';

        $user=User::where('name',$request->username)->first();

        // $user-> update ([
        //     'email'=>$request->email,
        //     'password'=>Hash::make($request->password),
        //     'hak_akses'=>$hak_akses,
        //  ]);

       return redirect('customer')->with('success','Data customer Berhasil Diubah..');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($customer_id, $username)
    {

        $customer=Customer::where('customer_id',$customer_id)->first();
        $customer->delete();

        // $user=User::where('name',$username)->first();
        // $user->delete();


        return redirect('customer')->with('success','Data customer Berhasil dihapus..');
    }
}
