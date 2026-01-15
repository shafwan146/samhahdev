<?php

namespace Database\Seeders;

use App\Models\GeneralConfig;
use Illuminate\Database\Seeder;

class GeneralConfigSeeder extends Seeder
{
    public function run(): void
    {
        $configs = [
            // Product Types
            [
                'type' => GeneralConfig::TYPE_PRODUCT_TYPE,
                'key' => 'ayam_pelung',
                'label' => 'Ayam Pelung',
                'description' => 'Ayam pelung dewasa berkualitas',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'type' => GeneralConfig::TYPE_PRODUCT_TYPE,
                'key' => 'pitik_pelung',
                'label' => 'Pitik Pelung (DOC)',
                'description' => 'Anak ayam pelung (Day Old Chicken)',
                'sort_order' => 2,
                'is_active' => true,
            ],
            // Age Variants
            [
                'type' => GeneralConfig::TYPE_AGE_VARIANT,
                'key' => '1_bulan',
                'label' => '1 Bulan',
                'description' => 'Umur 1 bulan',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'type' => GeneralConfig::TYPE_AGE_VARIANT,
                'key' => '2_bulan',
                'label' => '2 Bulan',
                'description' => 'Umur 2 bulan',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'type' => GeneralConfig::TYPE_AGE_VARIANT,
                'key' => '3_bulan',
                'label' => '3 Bulan',
                'description' => 'Umur 3 bulan',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'type' => GeneralConfig::TYPE_AGE_VARIANT,
                'key' => '4_bulan',
                'label' => '4 Bulan',
                'description' => 'Umur 4 bulan',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'type' => GeneralConfig::TYPE_AGE_VARIANT,
                'key' => '5_bulan',
                'label' => '5 Bulan',
                'description' => 'Umur 5 bulan',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'type' => GeneralConfig::TYPE_AGE_VARIANT,
                'key' => '6_bulan',
                'label' => '6 Bulan',
                'description' => 'Umur 6 bulan ke atas',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($configs as $config) {
            GeneralConfig::updateOrCreate(
                ['key' => $config['key']],
                $config
            );
        }
    }
}
