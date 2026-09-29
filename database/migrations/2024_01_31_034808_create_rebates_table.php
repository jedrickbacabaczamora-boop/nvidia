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
        Schema::create('rebates', function (Blueprint $table) {
            $table->id();
            $table->double('team_commission1', 2);
            $table->double('team_commission2', 2);
            $table->double('team_commission3', 2);

            $table->double('interest_commission1', 2);
            $table->double('interest_commission2', 2);
            $table->double('interest_commission3', 2);
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
        Schema::dropIfExists('rebates');
    }
};
