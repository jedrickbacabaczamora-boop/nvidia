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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('photo');
            $table->double('price', 2);
            $table->uuid('code');
            $table->string('validity');
            $table->double('package_commission', 2)->default(0);
            $table->double('commission_with_avg_amount', 2)->default(0)->comment('user get average amount after validity');
            $table->double('sponsor_income', 2)->default(0);
            $table->double('first_ref', 2)->default(0);
            $table->double('second_ref', 2)->default(0);
            $table->double('third_ref', 2)->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('is_default', ['1', '0'])->default('0');
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
        Schema::dropIfExists('packages');
    }
};
