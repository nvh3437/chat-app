<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('avn_cms', function (Blueprint $table) {
            $table->text('keywords')->nullable();
            $table->text('sort_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('avn_cms', function (Blueprint $table) {
            $table->dropColumn('keywords');
            $table->dropColumn('sort_description');
        });
    }
};
