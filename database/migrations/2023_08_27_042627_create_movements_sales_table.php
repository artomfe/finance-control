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
        Schema::create('movements_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('crypto_id');
            $table->unsignedBigInteger('wallet_id');
            $table->integer('quantity');
            $table->float('initial_quota_value', 20,12);
            $table->float('sale_quota_value', 20,12);
            $table->float('total_amount')->nullable();
            $table->float('profit')->nullable();
            $table->float('percentage_profit')->nullable();
            $table->date('movement_date')->nullable();
            $table->timestamps();

            $table->foreign('asset_id', 'movements_sales_ibfk_assets')
                ->references('id')->on('assets')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');
                
            $table->foreign('crypto_id', 'movements_sales_ibfk_cryptos')
                ->references('id')->on('cryptos')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');

            $table->foreign('wallet_id', 'movements_sales_ibfk_wallets')
                ->references('id')->on('wallets')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements_sales');
    }
};
