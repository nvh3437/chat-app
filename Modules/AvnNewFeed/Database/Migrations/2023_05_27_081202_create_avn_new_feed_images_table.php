<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('avn_new_feed_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feed_id');
            $table->foreign('feed_id')
                ->references('id')
                ->on('avn_new_feeds')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_new_feed_images');
    }
};