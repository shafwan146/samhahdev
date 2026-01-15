<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chicken_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('product_type');       // 'ayam_pelung' atau 'pitik_pelung'
            $table->string('age_variant');        // '1_bulan', '2_bulan' untuk ayam
            $table->string('product_name');       // Nama tampilan produk
            $table->integer('quantity')->default(0);
            $table->decimal('price', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chicken_stocks');
    }
};
