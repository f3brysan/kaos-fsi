<?php

namespace App\Http\Controllers;

use App\Models\Tr_biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{    
    public function create()
    {
        return view('biodata.create');
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
                 'community_id' => $request->community_id
        ]
            );
        } catch (\Exception $e) {
            return $e->getMessage();
        }
            return response()->json($data);
    }
}
