<?php

namespace App\Http\Controllers;

use App\Models\Ms_catalogue;
use App\Models\Tr_biodata;
use App\Models\Tr_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $biodataCheck = Tr_biodata::where('user_id', $user->id)->first();

        if (empty($biodataCheck)) {
            return redirect('biodata/create');
        }

        Session::put('bio', $biodataCheck);
        $sess = SESSION::GET('bio');
        $catalogue = Ms_catalogue::where('is_active', 1)->count();
        $myCart = Tr_cart::where('biodata_id', $sess->id)
                            ->whereNull('payment_id')
                            ->sum('qty');
        $myOrder = Tr_cart::where('biodata_id', $sess->id)
        ->whereNotNull('payment_id')
        ->sum('qty');

        // $paid = Tr_cart::with('payment')
        // ->where('biodata_id', $sess->id)
        // ->whereNotNull('payment_id')
        // ->whereHas('payment', function($q){
        //     $q->where('is_lunas', 1);
        // })
        // ->sum('qty');

        // return $paid;
        return view('dashboard.index', compact('catalogue', 'myCart','myOrder'));
    }
}
