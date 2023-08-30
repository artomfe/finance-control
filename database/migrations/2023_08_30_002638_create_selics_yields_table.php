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
        Schema::create('selics_yields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('selic_id');
            $table->float('amount');
            $table->date('movement_date')->nullable();
            $table->timestamps();

            $table->foreign('selic_id', 'selics_yields_ibfk_selic')
                ->references('id')->on('selics')
                ->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selics_yields');
    }
};
