<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avn_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('email')->nullable();
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_contacts');
    }
};
