<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fiis_complements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fii_id');
            $table->float('book_value')->nullable();
            $table->float('dividend_yield_annual')->nullable();
            $table->string('net_worth')->nullable();
            $table->integer('daily_liquidity')->nullable();
            $table->timestamps();

            $table->foreign('fii_id', 'fiis_complements_ibfk_1')
                ->references('id')->on('assets')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiis_complements');
    }
};
