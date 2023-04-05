<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avn_service_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('img');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_service_types');
    }
};
