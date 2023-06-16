<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('avn_services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->change();
            $table->string('name_ja')->nullable();
            $table->string('name_vi')->nullable();
            $table->string('name_en')->nullable();
            $table->text('description')->nullable()->change();
            $table->text('description_ja')->nullable();
            $table->text('description_vi')->nullable();
            $table->text('description_en')->nullable();
            $table->text('img');
            $table->string('price');
            $table->smallInteger('recommended')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_services');
    }
};