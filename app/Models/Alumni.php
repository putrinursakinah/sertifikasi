<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'tgl_lahir',
        'tahun_lulus',
        'nis',
        'alamat',
        'email',
        'telepon',
        'handphone',
        'foto'
    ];
}
