<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Kamar extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "kamar";
    protected $primaryKey = "id_kamar";

    protected $fillable = [
        'kode_kamar',
        'tarif_per_hari',
        'tipe_kamar',
        'before_10_persen',
        'after_10_persen',
        'rate_net'
    ];
}