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
        Schema::create('wallets_earnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('wallet_id');
            $table->integer('quantity')->nullable();
            $table->float('received_quota')->nullable();
            $table->float('total_amount')->nullable();
            $table->date('com_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamps();

            $table->foreign('asset_id', 'w_e_ibfk_assets')
                ->references('id')->on('assets')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');

            $table->foreign('wallet_id', 'w_e_ibfk_wallets')
                ->references('id')->on('wallets')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets_earnings');
    }
};
