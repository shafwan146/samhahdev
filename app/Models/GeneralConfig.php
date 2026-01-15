<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralConfig extends Model
{
    protected $fillable = [
        'type',
        'key',
        'label',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Config types
    public const TYPE_PRODUCT_TYPE = 'product_type';
    public const TYPE_AGE_VARIANT = 'age_variant';

    public static function getTypes(): array
    {
        return [
            self::TYPE_PRODUCT_TYPE => 'Jenis Produk',
            self::TYPE_AGE_VARIANT => 'Varian Umur',
        ];
    }

    public static function getTypeLabel(string $type): string
    {
        return self::getTypes()[$type] ?? $type;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Helper methods
    public static function getProductTypes(): array
    {
        return self::active()
            ->ofType(self::TYPE_PRODUCT_TYPE)
            ->ordered()
            ->pluck('label', 'key')
            ->toArray();
    }

    public static function getAgeVariants(): array
    {
        return self::active()
            ->ofType(self::TYPE_AGE_VARIANT)
            ->ordered()
            ->pluck('label', 'key')
            ->toArray();
    }

    public static function getProductTypeLabel(string $key): string
    {
        return self::where('type', self::TYPE_PRODUCT_TYPE)
            ->where('key', $key)
            ->value('label') ?? $key;
    }

    public static function getAgeVariantLabel(string $key): string
    {
        return self::where('type', self::TYPE_AGE_VARIANT)
            ->where('key', $key)
            ->value('label') ?? $key;
    }
}
