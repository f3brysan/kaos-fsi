<?php

namespace App\Http\Controllers;

use App\Models\Ms_sizeharga;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class SizePriceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $getData = Ms_sizeharga::all();
            if ($request -> ajax()) {
                return DataTables::of($getData)
                ->addColumn('action', function ($getData) {
                    $char = "'";
                    $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-info" title="Ubah" onclick="editData('.$char.Crypt::encrypt($getData->id).$char.')"><i class="bx bxs-cog"></i></a>';
                    $btn .= '&nbsp;';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger" title="Hapus" onclick="hapusData('.$char.Crypt::encrypt($getData->id).$char.')"><i class="bx bxs-trash-alt"></i></a>';
                    return $btn;
                })                
                ->rawColumns(['description', 'action', 'is_active'])
                ->addIndexColumn()
                ->make(true);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return view('size.index');
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $id = $request->id;
            $b_price = str_replace(".", "", $request->b_price);
            $s_price = str_replace(".", "", $request->s_price);
            

            $data = Ms_sizeharga::updateOrCreate(
                [
                'id' => $id],
                [
                    'size' => $request->size,
                    'b_price' => $b_price,
                    's_price' => $s_price                    
                ]
            );
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return response()->json($data);
    }
}
