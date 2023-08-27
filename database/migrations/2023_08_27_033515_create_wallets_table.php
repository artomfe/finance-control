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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('broker_id');
            $table->tinyInteger('wallet_type')->default(1)->comment('1 = assets, 2 = cryptos, 3 = selic');
            $table->timestamps();

            $table->foreign('user_id', 'wallets_ibfk_users')
                ->references('id')->on('users')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');

            $table->foreign('broker_id', 'wallets_ibfk_brokers')
                ->references('id')->on('brokers')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
