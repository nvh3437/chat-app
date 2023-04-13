<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avn_cms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('img')->nullable();
            $table->longText('description');
            $table->text('alias')->nullable();
            $table->text('link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_cms');
    }
};
