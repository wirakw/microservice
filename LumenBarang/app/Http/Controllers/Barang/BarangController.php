<?php

namespace App\Http\Controllers\Barang;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BarangController extends Controller
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
       $barangs = Barang::all();
       return $this->successResponse($barangs);
    }


    /**
     * Store a single book information
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_barang'   =>  'required|max:255',
            'kategori'      =>  'required|min:1',
            'harga'         =>  'required',
            'stok'          =>  'required',
        ];
        $this->validate($request, $rules);

        $barang = Barang::create($request->all());

        return $this->successResponse($barang, Response::HTTP_CREATED);
    }


    /**
     * Storing a single produk data
     * @param $barang
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($barang)
    {
        $barang = Barang::findOrFail($barang);
        return $this->successResponse($barang);
    }


    /**
     * @param Request $request
     * @param $barang
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $barang)
    {
        $rules = [
            'nama_barang'   =>  'required|max:255',
            'kategori'      =>  'required|min:1',
            'harga'         =>  'required',
            'stok'          =>  'required',
        ];
        $this->validate($request, $rules);
        $barang = Barang::findOrFail($barang);
        $barang->fill($request->all());
        if($barang->isClean()){
            return $this->errorResponse("At least one value must change", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $barang->save();
        return $this->successResponse($barang);
    }


    /**
     * Delete produk information
     * @param $barang
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($barang)
    {
        $barang = Barang::findOrFail($barang);
        $barang->delete();
        return $this->successResponse($barang);
    }
}
