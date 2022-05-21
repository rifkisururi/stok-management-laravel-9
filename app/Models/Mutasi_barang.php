<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi_barang extends Model
{
    use HasFactory;
    
    protected $table = 'mutasi_barang';
    protected $primaryKey = 'id';
    protected $fillable = ['id_barang','tanggal', 'jumlah', 'harga','category'];
    public $timestamps = false;
}
