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
        Schema::create('minings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            $table->string('running_start_date')->nullable();
            $table->string('running_end_date')->nullable();
            $table->string('total_time')->nullable();
            $table->string('running_time')->nullable();
            $table->integer('amount_per_hour')->default(0)->comment('24=1counter');
            $table->integer('amount_24_hour')->default(0)->comment('24=1counter');
            $table->integer('counter_24_hour')->default(0)->comment('24=1counter');
            $table->integer('total_count')->default(0)->comment('total_hour_divider_24');
            $table->integer('loss_hour')->default(0)->comment('user_mining_start_loss');
            $table->double('loss_amount')->default(0)->comment('user_mining_start_loss_amount');
            $table->enum('running_status', ['start', 'stop', 'end'])->default('stop');
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
        Schema::dropIfExists('minings');
    }
};
