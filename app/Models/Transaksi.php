<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "tb_transaksi";
    protected $fillable = [
        'tanggal',
        'user_id',
        'coa_id',
        'deskripsi',
        'debit',
        'credit',
        'status',
        'deleted_at'
    ];

    public function coa()
    {
        return $this->belongsTo(ChartOfAccount::class, 'coa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
