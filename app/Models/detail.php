<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    use HasFactory;
    public $timestamps = null;
    protected $table="detail_peminjaman";
    protected $primaryKey="id_detail";
    protected $fillable=['id_peminjaman','tgl_pinjam','tgl_kembali'];
}
