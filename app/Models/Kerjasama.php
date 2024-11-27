<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerjasama extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kerjasamas';

    // Kolom-kolom yang dapat diisi (mass-assignable)
    protected $fillable = [
        'nama_mitra',
        'gambar',
        'deskripsi_kerjasama',
        'tanggal_mulai',
        'tanggal_berakhir',
        'status',
        'dokumen_pendukung',
        'created_at',
        'updated_at',
    ];

    // Jika tidak ingin menggunakan `created_at` dan `updated_at` otomatis, bisa tambahkan:
    // public $timestamps = false;

    // Cast kolom-kolom dengan tipe data tertentu
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
        'status' => 'string', // Enum akan diperlakukan sebagai string
    ];
}
