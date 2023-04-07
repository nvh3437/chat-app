<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avn_post_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')
                ->references('id')
                ->on('avn_posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->longText('comment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_post_comments');
    }
};
