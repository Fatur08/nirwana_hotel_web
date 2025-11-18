<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class HotelController extends HotelController
{
    public function modalDLX(Request $request)
    {
        $nomor_kamar = $request->nomor_kamar;
        return view('modalDLX',compact('nomor_kamar'));
    }

    public function update_owner_admin($id_admin, Request $request)
    {
        $id_admin = $request->id_admin;
        $nama_admin = $request->nama_admin;
        $email_admin = $request->email_admin;
        $alamat_admin = $request->alamat_admin;
        $no_hp_admin = $request->no_hp_admin;
        $kecamatan_admin = $request->kecamatan_admin;
        $old_foto_admin = $request->old_foto_admin;
        $password_admin = $request->password_admin;

        if($request->hasFile('foto_admin')){
            $foto_admin = $id_admin.".".$request
                ->file('foto_admin')
                ->getClientOriginalExtension();
        } else {
            $foto_admin = $old_foto_admin;
        }

        try {
            $data = [
                'nama_admin' => $nama_admin,
                'email_admin' => $email_admin,
                'alamat_admin' => $alamat_admin,
                'no_hp_admin' => $no_hp_admin,
                'foto_admin'=>$foto_admin,
                'kecamatan_admin' => $kecamatan_admin,
                'password_admin' => $password_admin
            ];
            $update = DB::table('admin')->where('id_admin', $id_admin)->update($data);
            if ($update){
                if ($request->hasFile('foto_admin')) {
                    $foto_admin = $id_admin.".".$request
                        ->file('foto_admin')
                        ->getClientOriginalExtension();
                    $folderpath = "public/uploads/data_induk/admin/";
                    $folderpathold = $folderpath . $old_foto_admin;
                    if (Storage::exists($folderpathold)) {
                        Storage::delete($folderpathold);
                    }
                    $request->file('foto_admin')->storeAs($folderpath, $foto_admin);
                    $publicPath = public_path('storage/uploads/data_induk/admin/');
                    if (!is_dir($publicPath)) {
                        mkdir($publicPath, 0777, true);
                    }
                    $sourceFile = storage_path('app/' . $folderpath . $foto_admin);
                    $destinationFile = public_path('storage/uploads/data_induk/admin/' . $foto_admin);
                    copy($sourceFile, $destinationFile);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => 'Data Gagal Diupdate']);
        }
    }
}
