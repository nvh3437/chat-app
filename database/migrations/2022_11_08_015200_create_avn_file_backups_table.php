<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avn_file_backups', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->string('label');
            $table->string('route_name_import');
            $table->string('route_name_export');
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
        Schema::dropIfExists('avn_file_backups');
    }
};
