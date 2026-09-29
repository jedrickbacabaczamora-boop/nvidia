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
        Schema::create('improvments', function (Blueprint $table) {
            $table->id();
            $table->double('amount_limit')->default(0);
            $table->integer('commission')->default(1)->comment('percentage');

            $table->integer('first_refer_commission')->default(1)->comment('percentage');
            $table->integer('second_refer_commission')->default(1)->comment('percentage');
            $table->integer('third_refer_commission')->default(1)->comment('percentage');
            $table->integer('fourth_refer_commission')->default(1)->comment('percentage');
            $table->integer('five_refer_commission')->default(1)->comment('percentage');

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
        Schema::dropIfExists('improvments');
    }
};
