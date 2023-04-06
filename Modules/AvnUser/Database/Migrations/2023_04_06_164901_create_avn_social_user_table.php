<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avn_social_user', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('provider_user_id');
            $table->string('provider');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_social_user');
    }
};
