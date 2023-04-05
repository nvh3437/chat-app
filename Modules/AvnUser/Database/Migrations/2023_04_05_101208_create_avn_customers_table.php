<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avn_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('img')->nullable();
            $table->smallInteger('gender');
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->text('money')->nullable();
            $table->smallInteger('gender_status')->default(0);
            $table->smallInteger('address_status')->default(0);
            $table->smallInteger('description_status')->default(0);
            $table->smallInteger('money_status')->default(0);
            $table->smallInteger('email_status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avn_customers');
    }
};
