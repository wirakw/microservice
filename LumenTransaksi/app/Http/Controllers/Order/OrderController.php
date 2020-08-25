<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Barang;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class OrderController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
       $orders = OrderDetail::all();
       return $this->successResponse($orders);
    }


    /**
     * Store a single book information
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request)
    {
        $rules = [
            'nama'      =>  'required|max:255',
            'email'     =>  'required',
            'phone'     =>  'required|min:12',
            'qty'       =>  'required|min:1',
            'barang_id' =>  'required',
        ];
        $this->validate($request, $rules);
 
        $dataPembeli = [
            "nama" => $request->input("nama"),
            "email" => $request->input("email"),
            "phone" => $request->input("phone"),
            "provinsi" => $request->input("provinsi"),
            "kabupaten" => $request->input("kabupaten"),
            "kd_post" => $request->input("kd_post"),
            "alamat" => $request->input("alamat"),
        ];
        $pembeli = Customer::create($dataPembeli);

        $dataOrder = [
            "salesman" => $request->input("salesman"),
            "pembeli" => $pembeli->id,
            "phone" => $request->input("phone"),
        ];
        $order = Order::create($dataOrder);

        $barang = Barang::findOrFail($request->input("barang_id"));

        $orderDetail = [
            "order_id" => $order->id,
            "barang_id" => $request->input("barang_id"),
            "qty" => $request->input("qty"),
            "harga" => $barang->harga,
            "status_pembayaran" => 0,
        ];
        $orderdetail = OrderDetail::create($orderDetail);
        // $barang = Barang::create($request->all());
        $responseMessage = [
            "order_id" => $order->id,
            "barang_id" => $request->input("barang_id"),
            "pembeli" => $pembeli->id,
        ];
        return $this->successResponse($responseMessage, Response::HTTP_CREATED);
    }
}
