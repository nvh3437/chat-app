<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('avn_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('img');
            $table->string('price');
            $table->text('description');
            $table->smallInteger('recommended')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_services');
    }
};