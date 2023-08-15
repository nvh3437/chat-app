<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('avn_general_settings');
        Schema::dropIfExists('avn_menu');

        Schema::dropIfExists('avn_user_roles');
        Schema::dropIfExists('avn_permission_roles');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('username')->nullable();
            $table->string('type');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create('avn_menu', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('vi')->nullable();
            $table->string('en')->nullable();
            $table->string('ja')->nullable();
            $table->string('route_name');
            $table->string('icon');
            $table->string('module')->nullable();
            $table->integer('order')->default(0);
            $table->integer('parent')->default(0);
            $table->timestamps();
        });

        Schema::create('avn_general_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('key')->unique();
            $table->text('value')->nullable();
        });

        Schema::create('avn_modules_settings_link', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('link');
        });

        Schema::create('avn_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receiver');
            $table->foreign('receiver')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('content');
            $table->string('icon');
            $table->string('link')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });


        Schema::create('avn_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->nullable()
                ->constrained('avn_menu')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->text('route_names');
            $table->timestamps();
        });

        Schema::create('avn_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('avn_permission_roles', function (Blueprint $table) {
            $table->foreignId('role_id')
                ->constrained('avn_roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('permission_id')
                ->constrained('avn_permissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('avn_user_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('avn_roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->primary(['user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avn_user_roles');
        Schema::dropIfExists('avn_permission_roles');
        Schema::dropIfExists('avn_roles');
        Schema::dropIfExists('avn_permissions');
        Schema::dropIfExists('avn_notifications');
        Schema::dropIfExists('avn_general_settings');
        Schema::dropIfExists('avn_modules_settings_link');
        Schema::dropIfExists('avn_menu');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
    }
};
