<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avn_posts', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('name_en')->nullable();
            $table->text('name_vi')->nullable();
            $table->text('name_ja')->nullable();
            $table->text('img')->nullable();
            $table->text('img_en')->nullable();
            $table->text('img_vi')->nullable();
            $table->text('img_ja')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_vi')->nullable();
            $table->longText('description_ja')->nullable();
            $table->text('keywords')->nullable();
            $table->text('sort_description')->nullable();
            $table->text('alias')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('avn_post_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_posts');
    }
};
