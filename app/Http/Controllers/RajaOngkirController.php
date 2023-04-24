<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodepandai\LaravelRajaOngkir\Facades\RajaOngkir;


class RajaOngkirController extends Controller
{
    public function getProvince()
    {
        return RajaOngkir::getProvince();
    }

    public function getCities($id)
    {
        $city = RajaOngkir::getCity(null, $id);
        $city = $city['rajaongkir']['results'];
        // return $city;
        return json_encode($city);
    }

    public function getSubdistrict()
    {
        $sub = RajaOngkir::getSubdistrict(444, null);
        // $sub = 'wkwkwk';
        return $sub;
    }

    public function getCost($destination)
    {
        $cost = RajaOngkir::getCost(255, 'NEDI', $destination, 'Alamat Tujuan', 1000, 'jne');
        $data = $cost['rajaongkir']['results'];
        foreach ($data as $item) {
            $result = $item['costs'][1]['cost'][0]['value'];
        }
        return $cost;
    }
}
