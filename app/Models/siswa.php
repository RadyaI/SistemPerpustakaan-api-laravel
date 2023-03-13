<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    public $timestamps = null;
    protected $table="siswa";
    protected $primaryKey="id_siswa";
    protected $fillable=['nama_siswa','tanggal_lahir','gender','alamat','umur'];
}
