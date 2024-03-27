<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'pasien' => 'jamal',
            'price_total' => 17000,
            'type_obat' => 'tablet',
        ]);

        $detailTransactions = [
            [
                'transaction_id' => 1,
                'obat_dibeli' => 'oskadon',
            ],
            [
                'transaction_id' => 1,
                'obat_dibeli' => 'paramex',
            ],
            [
                'transaction_id' => 1,
                'obat_dibeli' => 'stopcold',
            ],
        ];

        foreach ($detailTransactions as $value) {
            TransactionDetail::create($value);
        }
    }
}
