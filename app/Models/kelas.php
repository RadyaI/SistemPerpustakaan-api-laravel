<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    public $timestamps = null;
    protected $table="kelas";
    protected $primaryKey="id_kelas";
    protected $fillable=['nama_kelas'];
}
