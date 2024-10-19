<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChartOfAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tb_chart_of_account';
    protected $fillable = [
        'kode',
        'nama',
        'status',
        'kategori_id',
        'deleted_at'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaksi::class, 'coa_id');
    }

}
