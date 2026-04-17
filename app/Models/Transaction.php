<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'customer_name',
        'customer_phone',
        'product_type',
        'age_variant',
        'quantity',
        'unit_price',
        'total_price',
        'transaction_date',
        'notes',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    /**
     * Generate unique transaction code
     */
    public static function generateCode(): string
    {
        $prefix = 'TRX';
        $date = now()->format('Ymd');
        $lastTransaction = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction->transaction_code, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return "{$prefix}{$date}{$newNumber}";
    }

    /**
     * Get formatted unit price
     */
    public function getFormattedUnitPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->unit_price, 0, ',', '.');
    }

    /**
     * Get formatted total price
     */
    public function getFormattedTotalPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    /**
     * Get product type label
     */
    public function getProductTypeLabelAttribute(): string
    {
        return GeneralConfig::getProductTypeLabel($this->product_type);
    }

    /**
     * Get age variant label
     */
    public function getAgeVariantLabelAttribute(): string
    {
        return GeneralConfig::getAgeVariantLabel($this->age_variant);
    }

    /**
     * Scope for filtering by month and year
     */
    public function scopeOfMonth($query, int $month, int $year)
    {
        return $query->whereMonth('transaction_date', $month)
                     ->whereYear('transaction_date', $year);
    }

    /**
     * Scope for filtering by year
     */
    public function scopeOfYear($query, int $year)
    {
        return $query->whereYear('transaction_date', $year);
    }

    /**
     * Get monthly sales summary for chart
     */
    public static function getMonthlySales(int $year): array
    {
        $months = [];
        
        $productTypes = GeneralConfig::getProductTypes();
        
        for ($month = 1; $month <= 12; $month++) {
            $monthData = ['month' => $month];

            foreach ($productTypes as $typeKey => $typeLabel) {
                $quantity = self::where('product_type', $typeKey)
                    ->whereMonth('transaction_date', $month)
                    ->whereYear('transaction_date', $year)
                    ->sum('quantity');
                $monthData[$typeKey] = (int) $quantity;
            }

            $months[] = $monthData;
        }

        return $months;
    }
}
