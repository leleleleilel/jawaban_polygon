<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table      = "transactions";
    protected $primaryKey = "id";
    public $incrementing  = true;
    public $timestamps    = true;

    protected $fillable = [
        "tanggal_transaksi",
        "kategori_id",
        "nominal",
        "keterangan",
        "jenis_transaksi",
        "status"
    ];
}
