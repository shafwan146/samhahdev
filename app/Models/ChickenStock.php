<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChickenStock extends Model
{
    protected $fillable = [
        'product_type',
        'age_variant',
        'product_name',
        'quantity',
        'price',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'price' => 'decimal:2',
        ];
    }

    public const TYPE_AYAM_PELUNG = 'ayam_pelung';
    public const TYPE_PITIK_PELUNG = 'pitik_pelung';

    public const AGE_1_BULAN = '1_bulan';
    public const AGE_2_BULAN = '2_bulan';

    public static function getProductTypes(): array
    {
        return [
            self::TYPE_AYAM_PELUNG => 'Ayam Pelung',
            self::TYPE_PITIK_PELUNG => 'Pitik Pelung (DOC)',
        ];
    }

    public static function getAgeVariants(): array
    {
        return [
            self::AGE_1_BULAN => '1 Bulan',
            self::AGE_2_BULAN => '2 Bulan',
        ];
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
