<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zotas;

class ZotasController extends Controller
{
    public function index()
    {
        $zotas = Zotas::all();
        return view('zotas.index', compact('zotas'));
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'id' => 'required',
            'response' => 'required',
        ]);

        $zota = Zotas::firstOrCreate(
            ['ID'=>$data['id']],
            ['RESPONSE'=>$data['response']]);

        return response()->json([
            'status' => 'success',
        ], 200);       
    }

    public function destroy(Request $request)
    {
        $data = request()->validate([
            'id' => 'required',
            'response' => 'required',
        ]);
        
        $delete = Zotas::where('ID', $data['id'])->delete();

        return response()->json([
            'status' => 'success',
        ], 200);  
    }
}
