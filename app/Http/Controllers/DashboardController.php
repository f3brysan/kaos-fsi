<?php

namespace App\Http\Controllers;

use App\Models\Tr_biodata;
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
        // dd(Session::all());
        

        return view('dashboard.index');
    }
}
