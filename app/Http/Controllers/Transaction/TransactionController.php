<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    public function addCart(Request $request) {
        $transaction = Transaction::create([
            'pasien' => $request->pasien,
            'type_obat' => $request->type,
            'price_total' => $request->priceTotal,
        ]);

        $listObat = $request->listObat;
        foreach ($listObat as $key => $obat) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'obat_dibeli' => $obat,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'created',
        ], 200);
    }

    public function invoice() {
        $invoice = Transaction::latest()->first();
        $detail = $invoice->detailTransactions()->where('transaction_id', $invoice->id)->get();

        if ($invoice && $detail)  {
            return response()->json([
                'success' => true,
                'data' => $invoice,
                'detail' => $detail,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'failed'
            ], 400);
        }
    }
}
