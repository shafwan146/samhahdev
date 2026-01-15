<?php

namespace App\Exports;

use App\Models\ChickenStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ChickenStockExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return ChickenStock::orderBy('product_type')
            ->orderBy('age_variant')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Jenis Produk',
            'Varian Umur',
            'Jumlah (ekor)',
            'Harga (Rp)',
            'Catatan',
            'Dibuat',
            'Diperbarui',
        ];
    }

    public function map($stock): array
    {
        return [
            $stock->id,
            $stock->product_name,
            $stock->product_type,
            $stock->age_variant,
            $stock->quantity,
            $stock->price,
            $stock->notes ?? '-',
            $stock->created_at->format('Y-m-d H:i:s'),
            $stock->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2E7D32'],
                ],
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
        ];
    }
}
