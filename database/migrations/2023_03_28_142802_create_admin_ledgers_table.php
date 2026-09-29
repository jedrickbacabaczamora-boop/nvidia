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
        Schema::create('admin_ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('reason');
            $table->string('perticulation')->nullable();
            $table->double('amount', 2)->default(0);
            $table->double('debit', 2)->default(0);
            $table->double('credit', 2)->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected', 'default'])->default('default');
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
        Schema::dropIfExists('admin_ledgers');
    }
};
