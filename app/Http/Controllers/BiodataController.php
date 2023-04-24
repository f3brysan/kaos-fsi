<?php

namespace App\Http\Controllers;

use App\Models\Tr_biodata;
use Illuminate\Http\Request;
use Kodepandai\LaravelRajaOngkir\Facades\RajaOngkir;

class BiodataController extends Controller
{    
    public function create()
    {
        $provinsi = RajaOngkir::getProvince();
        $provinsi = $provinsi['rajaongkir']['results'];
        // dd($provinsi);
        return view('biodata.create', compact('provinsi'));
    }

    public function store(Request $request)
    {
        try {
            $id = $request->id;
            $user_id =  auth()->user();
            $data = Tr_biodata::updateOrCreate(
                ['id' => $id],
                ['user_id' => $user_id->id,
                 'name' => $request->name,
                 'phone' => $request->telp,
                 'sex' => $request->sex,
                //  'community_id' => $request->community_id
                'provinsi_id' => $request->provinsi,
                'kota_id' => $request->kabupaten,
                'alamat' => $request->alamat
        ]
            );
        } catch (\Exception $e) {
            return $e->getMessage();
        }
            return response()->json($data);
    }
}
