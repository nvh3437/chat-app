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
        Schema::table('avn_chat_room_users', function (Blueprint $table) {
            $table->unsignedBigInteger('last_seen_id')->nullable();
            $table->foreign('last_seen_id')
                ->references('id')
                ->on('avn_chat_messages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('last_received_id')->nullable();
            $table->foreign('last_received_id')
                ->references('id')
                ->on('avn_chat_messages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};