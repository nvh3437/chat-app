<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::table('avn_profiles', function (Blueprint $table) {
            $table->string('price')->nullable();
        });
    }

    public function down()
    {
    }
};