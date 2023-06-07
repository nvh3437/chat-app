<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('avn_post_categories', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('vi')->nullable();
            $table->text('en')->nullable();
            $table->text('ja')->nullable();
            $table->text('description')->nullable();
            $table->text('description_vi')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ja')->nullable();
            $table->text('keywords');
            $table->text('img')->nullable();
            $table->text('alias')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_post_categories');
    }
};