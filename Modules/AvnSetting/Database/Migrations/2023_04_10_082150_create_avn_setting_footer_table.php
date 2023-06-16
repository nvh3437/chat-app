<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('avn_setting_footer', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('vi')->nullable();
            $table->string('en')->nullable();
            $table->string('ja')->nullable();
            $table->text('link')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_setting_footer_infor');
    }
};