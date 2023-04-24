<?php

namespace App\Http\Controllers;

use App\Models\Tr_cart;
use Illuminate\Support\Str;
use App\Models\Ms_catalogue;
use App\Models\Ms_sizeharga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Kodepandai\LaravelRajaOngkir\Facades\RajaOngkir;

class CartController extends Controller
{
    public function store_item(Request $request)
    {
        // dd($request->all());
        $bio_id = Session::GET('bio')->id;
        $catalogue = Ms_catalogue::where('id', $request->catalogues_id)->first();
        $myCart = Tr_cart::where('biodata_id', $bio_id)->where('catalogue_id', $request->catalogues_id)->where('hargasize_id', $request->size)->whereNull('payment_id')->first();
        dd($myCart);

        if ($myCart) {
            $total = $myCart->qty + $request->qty;
            // dd($total);
            $create = Tr_cart::updateOrCreate(
                [
                'id' => $myCart->id,
                'biodata_id' => $bio_id,
                'catalogue_id' => $request->catalogues_id,
                'hargasize_id' => $request->size
                ],
                [
                'qty' => $total
                ]
            );
        } else {
            $create = Tr_cart::updateOrCreate(
                [
                'id' => $request->id
                ],
                [
                'biodata_id' => $bio_id,
                'catalogue_id' => $request->catalogues_id,
                'hargasize_id' => $request->size,
                'qty' => $request->qty
                ]
            );
        }

        // dd($create);

        if($create) {
            Session::flash('sukses', $request->qty.' Pesanan Anda telah masuk ke Keranjang');
            return redirect('/katalog/detail/'.$catalogue->slug);
        }
    }

    public function pesananku()
    {
        $bio_id = Session::GET('bio')->id;
        $size = Ms_sizeharga::all();
        $list = Tr_cart::with('katalog.images', 'hargasize')->where('biodata_id', $bio_id)->whereNull('payment_id')->get();
        //    return $list;
        return view('pesananku.index', compact('list', 'size'));
    }

    public function pesananku_item($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $get = Tr_cart::with('katalog', 'hargasize')->where('id', $id)->first();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
            return response()->json($get);
    }

    public function edit_pesananku(Request $request)
    {
        //  dd($request->all());
        $bio_id = Session::GET('bio')->id;
        $catalogue = Ms_catalogue::where('id', $request->catalogues_id)->first();
        $myCart = Tr_cart::where('biodata_id', $bio_id)->where('catalogue_id', $request->catalogues_id)->where('hargasize_id', $request->size)->whereNull('payment_id')->first();
        //  dd($myCart);
        //  $total = $myCart->qty + $request->qty;
        if ($request->qty < 1) {
            $create = Tr_cart::where('id', $request->id)->forceDelete();
        }
        else {
            if ($myCart) {
                $create = Tr_cart::updateOrCreate(
                    [
                    'id' => $request->id,
                    'biodata_id' => $bio_id,
                    'catalogue_id' => $request->catalogues_id,
                    'hargasize_id' => $request->size
                    ],
                    [
                    'qty' => $request->qty
                    ]
                );
            }
        }
        



        if($create) {
            Session::flash('sukses', $request->qty.' Pesanan Anda telah diubah');
            return redirect('/keranjangku');
        }
    }



}
