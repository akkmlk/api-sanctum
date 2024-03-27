<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionDetail;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien',
        'type_obat',
        'price_total',
    ];

    public function detailTransactions()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
