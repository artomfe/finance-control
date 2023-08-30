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
        Schema::create('wallets_cryptos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('crypto_id');
            $table->float('quantity', 30,10)->nullable();
            $table->float('average_price', 16,10)->nullable();
            $table->float('total_amount')->nullable();
            $table->timestamps();

            $table->foreign('crypto_id', 'wallets_cryptos_ibfk_crypto')
                ->references('id')->on('cryptos')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');

            $table->foreign('wallet_id', 'wallets_cryptos_ibfk_wallet')
                ->references('id')->on('wallets')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets_cryptos');
    }
};
