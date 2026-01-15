<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Transaction::orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Tanggal',
            'Nama Customer',
            'No. Telepon',
            'Jenis Produk',
            'Varian Umur',
            'Jumlah (ekor)',
            'Harga Satuan (Rp)',
            'Total Harga (Rp)',
            'Catatan',
            'Dibuat',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->transaction_code,
            $transaction->transaction_date->format('Y-m-d'),
            $transaction->customer_name,
            $transaction->customer_phone ?? '-',
            $transaction->product_type,
            $transaction->age_variant,
            $transaction->quantity,
            $transaction->unit_price,
            $transaction->total_price,
            $transaction->notes ?? '-',
            $transaction->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E65100'],
                ],
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
        ];
    }
}
