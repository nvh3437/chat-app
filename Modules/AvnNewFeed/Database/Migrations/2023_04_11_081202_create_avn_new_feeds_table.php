<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avn_new_feeds', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->smallInteger('status')->default(0);
            $table->text('alias');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_newfeeds');
    }
};
