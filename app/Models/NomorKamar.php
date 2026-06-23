<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class NomorKamar extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "nomor_kamar";
    protected $primaryKey = "id_nomor_kamar";

    protected $fillable = [
        'id_kamar',
        'nomor_kamar',
        'jenis_bed'
    ];
}