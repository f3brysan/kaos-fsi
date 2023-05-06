<?php

namespace App\Http\Controllers;

use App\Models\Tr_cart;
use App\Models\Tr_payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Kodepandai\LaravelRajaOngkir\Facades\RajaOngkir;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // dd($request->all());

        // cari banyak item
        $qty = 0;
        $totalbiayaitem = 0;
        foreach ($request->check as $check) {
            $item = Tr_cart::with('hargasize')->where('id', $check)->first();
            $qty += $item->qty;
            $totalbiayaitem += $item->hargasize->s_price*$item->qty;
        }

        $oneKg = 3;

        // dd($totalbiayaitem);

        $hitungPcsKg = ceil($qty/$oneKg)*1000;

        $randKode = Str::upper(Str::random(16)) ;
        $bio = SESSION::GET('bio');
        // dd($bio->provinsi_id);
        $cost = RajaOngkir::getCost(255, 'NEDI', $bio->kota_id, $bio->alamat, $hitungPcsKg, 'jne');
        $data = $cost['rajaongkir']['results'];
        // looping biaya ongkir
        foreach ($data as $item) {
            $result = $item['costs'][1]['cost'][0]['value'];
            $description = $item['costs'][1]['description'];
        }
    //   return $cost;
        $randDigitCode = rand(100, 999); //random 3 digit belakang
        $pungli = $result + 2000 + $randDigitCode; // ongkir + 2000 + 3 digit acak
        // dd($pungli);
        DB::beginTransaction();
        $payment = Tr_payment::create([
            'bio_id' => $bio->id,
            'no_pesanan' => $randKode,
            'biaya_item' => $totalbiayaitem,
            'biaya_ongkir' => $pungli,
            'total_biaya' => $totalbiayaitem + $pungli,
            'bobot' => $hitungPcsKg,
            'kurir' => $data[0]['name'],
            'prov_asal' => $cost['rajaongkir']['origin_details']['province'],
            'kab_asal' => $cost['rajaongkir']['origin_details']['city_name'],
            'prov_tujuan' => $cost['rajaongkir']['destination_details']['province'],
            'kab_tujuan' => $cost['rajaongkir']['destination_details']['city_name'],
            'alamat_tujuan' => $bio->alamat,
            'created_at' => now()
        ]);

        if ($payment) {
            foreach ($request->check as $check) {
                $insert_cart = Tr_cart::with('hargasize')->where('id', $check)->update(['payment_id' => $payment->id]);
            }
        }

        if ($insert_cart) {
            DB::commit();
            return redirect('/keranjangku');
        } else {
            DB::rollBack();
            return redirect('/keranjangku');
        }

    }

    public function transaksi_all()
    {
        $session = Session::get('bio');
        $unpaid = Tr_payment::whereNull('bukti_upload')
                            ->where('bio_id', $session->id)
                            ->with('items.katalog', 'items.hargasize')
                            ->get();
        $waiting = Tr_payment::whereNotNull('bukti_upload')
                            ->whereNull('is_lunas')
                            ->where('bio_id', $session->id)
                            ->with('items.katalog', 'items.hargasize')
                            ->get();
        $valid = Tr_payment::whereNotNull('bukti_upload')
                            ->where('is_lunas', 1)
                            ->where('bio_id', $session->id)
                            ->with('items.katalog', 'items.hargasize')
                            ->get();
        // return $valid;
        return view('payment.index', compact('unpaid', 'waiting', 'valid'));
    }

    public function unpaid($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $data = Tr_payment::where('id', $id) ->with('items.katalog', 'items.hargasize', 'biodata')->first();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
            return response()->json($data);

    }

    public function unggah_pembayaran(Request $request)
    {
        // dd($request->all());
        try {
            if ($request->file('document')) {
                // $image = new Tr_image();
                $path = $request->file('document')->store('/images/buktibayar', ['disk' =>   'my_files']);
                $data = Tr_payment::where('id', $request->id)->update([
                    'bukti_upload' => $path,
                    'updated_at' => now()]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return response()->json($data);
    }

    public function data_bayar()
    {
        $unpaid = Tr_payment::whereNull('bukti_upload')
                ->with('items.katalog', 'items.hargasize','biodata')
                ->get();
        $waiting = Tr_payment::whereNotNull('bukti_upload')
                ->whereNull('is_lunas')
                ->with('items.katalog', 'items.hargasize','biodata')
                ->get();
        $valid = Tr_payment::whereNotNull('bukti_upload')
                ->where('is_lunas', 1)
                ->with('items.katalog', 'items.hargasize', 'biodata')
                ->get();

        // return $waiting;
        return view('payment.data', compact('unpaid', 'waiting', 'valid'));
    }

    public function approve($id)
    {   
        $bio = SESSION::GET('bio');
        $data = Tr_payment::where('id', $id)->update([
            'is_lunas' => 1,
            'verif_by' => $bio->name,
            'verif_at' => now()
        ]);

        if ($data) {
            return redirect('/master/transaksi');
        }
    }
}
