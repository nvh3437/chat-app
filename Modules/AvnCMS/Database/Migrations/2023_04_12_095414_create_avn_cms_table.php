<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('avn_cms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_ja')->nullable();
            $table->string('name_vi')->nullable();
            $table->string('name_en')->nullable();
            $table->text('keywords')->nullable();
            $table->text('sort_description')->nullable();
            $table->text('img')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_ja')->nullable();
            $table->longText('description_vi')->nullable();
            $table->longText('description_en')->nullable();
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