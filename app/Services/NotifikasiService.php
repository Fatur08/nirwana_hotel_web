<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
class NotifikasiService
{
    /**
     * Membuat notifikasi baru
     */
    public static function buat(
        $judul,
        $isi,
        $jenis,
        $dibuatOleh
    ) {
        DB::table('notifikasi')->insert([
            'judul_notifikasi' => $judul,
            'isi_notifikasi' => $isi,
            'jenis_notifikasi' => $jenis,
            'dibuat_oleh' => $dibuatOleh,
            'waktu_notifikasi' => now()
        ]);
    }
}