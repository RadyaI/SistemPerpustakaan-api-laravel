<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;
    public $timestamps = null;
    protected $table="peminjaman";
    protected $primaryKey="id_peminjaman";
    protected $fillable=['id_siswa','id_kelas','id_buku','nama','alamat','tgl_pinjam','tgl_kembali','tenggat','status'];
}
