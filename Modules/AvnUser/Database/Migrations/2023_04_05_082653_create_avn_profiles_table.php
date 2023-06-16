<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('avn_profiles', function (Blueprint $table) {
            $table->id();
            $table->text('img')->nullable();
            $table->string('exp')->nullable();
            $table->smallInteger('gender')->nullable();
            $table->date('birth')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->string('money')->nullable();
            $table->string('price')->nullable();
            $table->smallInteger('gender_status')->default(0);
            $table->smallInteger('exp_status')->default(0);
            $table->smallInteger('address_status')->default(0);
            $table->smallInteger('description_status')->default(0);
            $table->smallInteger('money_status')->default(0);
            $table->smallInteger('email_status')->default(0);
            $table->smallInteger('birth_status')->default(0);
            $table->smallInteger('phone_status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_profiles');
    }
};