<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avn_chat_room_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')
                ->references('id')
                ->on('avn_chat_rooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avn_chat_room_users');
    }
};