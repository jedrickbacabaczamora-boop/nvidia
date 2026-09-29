<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->string('photo');
            $table->string('number', 15);
            $table->double('minimum_recharge', 2);
            $table->double('maximum_recharge', 2);
            $table->double('recharge_charge', 2);
            $table->double('minimum_withdraw', 2);
            $table->double('maximum_withdraw', 2);
            $table->double('withdraw_charge', 2);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
};
