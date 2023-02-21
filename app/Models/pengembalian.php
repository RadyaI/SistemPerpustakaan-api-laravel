<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    use HasFactory;
    public $timestamps ="null";
    protected $table = "pengembalian";
    protected $primarykey ="id_pengembalian";
    protected $fillable =['id_peminjaman','status'];
}
