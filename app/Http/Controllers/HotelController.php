<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function modalDLX(Request $request)
    {
        $nomor_kamar = $request->nomor_kamar;
        return view('modalDLX',compact('nomor_kamar'));
    }
}
