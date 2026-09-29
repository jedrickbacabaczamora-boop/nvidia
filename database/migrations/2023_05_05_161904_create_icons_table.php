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
        Schema::create('icons', function (Blueprint $table) {
            $table->id();
            $table->string('recharge');
            $table->string('recharge_button');
            $table->string('withdraw');
            $table->string('withdraw_button');
            $table->string('invitation');
            $table->string('team');
            $table->string('apps');
            $table->string('lucky_draw');
            $table->string('robot');
            $table->string('about');
            $table->string('profile_bank');
            $table->string('profile_invite');
            $table->string('profile_mining');
            $table->string('profile_team');
            $table->string('profile_faq');
            $table->string('profile_income');
            $table->string('profile_touch');
            $table->string('profile_password');
            $table->string('profile_logout');
            $table->string('team_banner');
            $table->string('team_details_banner');
            $table->string('team_label1');
            $table->string('team_label2');
            $table->string('team_label3');
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
        Schema::dropIfExists('icons');
    }
};
