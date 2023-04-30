<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Ms_catalogue;
use App\Models\Ms_sizeharga;
use App\Models\Tr_image;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        try {
            $getData = Ms_catalogue::with('images')->withCount('images')->get();
            //   return $getData;
            if ($request -> ajax()) {
                return DataTables::of($getData)
                ->addColumn('action', function ($getData) {
                    $char = "'";
                    $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-info" title="Ubah" onclick="editData('.$char.Crypt::encrypt($getData->id).$char.')"><i class="bx bxs-cog"></i></a>';
                    $btn .= '&nbsp;';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger" title="Hapus" onclick="hapusData('.$char.Crypt::encrypt($getData->id).$char.')"><i class="bx bxs-trash-alt"></i></a>';
                    return $btn;
                })
                ->editColumn('description', function ($getData) {
                    return Str::words($getData->description, '25');
                })
                ->editColumn('is_active', function ($getData) {
                    switch ($getData->is_active) {
                        case 1:
                            $hasil = '<span class="badge badge-success">Aktif</span>';
                            break;

                        default:
                            $hasil = '<span class="badge badge-danger">Non Aktif</span>';
                            break;
                    }

                    return $hasil;
                })
                ->rawColumns(['description', 'action', 'is_active'])
                ->addIndexColumn()
                ->make(true);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return view('katalog.index');
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $id = $request->id;
            $get = Ms_catalogue::find($id);

            if ($get == null) {
                $data = $request->validate([
                    'sku' => ['required', 'unique:ms_catalogues', 'max:50'],
                    'name' => ['unique:ms_catalogues']
                ]);
            }

            $data = Ms_catalogue::updateOrCreate(
                [
                'id' => $id],
                [
                    'sku' => $request->sku,
                    'name' => $request->nama,
                    'description' => $request->description,
                    'slug' => Str::slug($request->nama)
                ]
            );

            if ($id !== null) {
                $id = $id;
            } else {
                $id = $data->id;
            }

            if ($request->file('images')) {
                foreach ($request->file('images') as $imagefile) {
                    $image = new Tr_image();
                    $path = $imagefile->store('/images/resource', ['disk' =>   'my_files']);
                    $image->name = $path;
                    $image->catalogue_id = $data->id;
                    $image->save();            // dd($data);
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return response()->json($data);
    }

    public function show($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $data = Ms_catalogue::where('id', $id)->first();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return response()->json($data);
    }

    public function shop()
    {
        try {
            $getData = Ms_catalogue::with('images')->get();

            // return $getData;    
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return view('katalog.shop', compact('getData'));
    }

    public function detail($slug)
    {
        try {
            $data = Ms_catalogue::with('images')->where('slug', $slug)->first();
            $size = Ms_sizeharga::where('catalogue_id', $data->id)->get();

            // return $size;    
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return view('katalog.detil', compact('data', 'size'));
    }
}
