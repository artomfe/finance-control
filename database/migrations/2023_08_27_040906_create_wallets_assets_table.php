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
        Schema::create('wallets_assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('asset_id');
            $table->integer('quantity')->nullable();
            $table->float('average_price')->nullable();
            $table->float('total_amount')->nullable();
            $table->timestamps();

            $table->foreign('asset_id', 'aw_ibfk_assets')
                ->references('id')->on('assets')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');

            $table->foreign('wallet_id', 'aw_ibfk_wallets')
                ->references('id')->on('wallets')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets_assets');
    }
};
