<?php
// config for Kodepandai/LaravelRajaOngkir
return  [
    /**
     * api key yang di dapat dari akun raja ongkir
     */
    'API_KEY' => env('RAJAONGKIR_KEY', '9619edab3a1f81ed6c116d42da4ed1ef'),

    /**
     * tipe akun untuk menentukan api url
     * starter, basic, pro
     */
    'ACCOUNT_TYPE' => env('RAJAONGKIR_TYPE', 'starter')
];
