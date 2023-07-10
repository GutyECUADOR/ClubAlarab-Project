<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('location')->nullable();
            $table->string('nickname')->unique();
            $table->string('nickname_promoter');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('role')->default('USER_ROLE');
            $table->string('phone');
            $table->string('avatar')->default('default.png');
            $table->string('wallet_usdt_tr20')->nullable();;
            $table->string('wallet_alarab')->nullable();;
            $table->unsignedBigInteger('package_id')->default(1);
            $table->foreign('package_id')->references('id')->on('packages');
            $table->boolean('isPayed')->default(false);
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
        Schema::dropIfExists('users');
    }
}