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
        Schema::create('avn_chat_room_calls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')
                ->references('id')
                ->on('avn_chat_rooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('call_id')->nullable();
            $table->foreign('call_id')
                ->references('id')
                ->on('avn_chat_room_calls')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('pin')->nullable();
            $table->timestamps();
            $table->dateTime('end_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avn_chat_room_calls');
    }
};