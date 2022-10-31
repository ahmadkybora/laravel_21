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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->dateTime('mobile_verified_at')->nullable();
            $table->string('username')->unique();
            $table->string('postal_code')->nullable();
            $table->string('password');
            $table->foreignId('city_id')->index()->nullable();
            $table->text('home_address')->nullable();
            $table->text('work_address')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'SUSPENDED', 'PENDING', 'PROTECTED', 'DELETED'])->default('ACTIVE');
            $table->string('secret_key')->unique();
            $table->string('avatar')->nullable();
            $table->rememberToken();
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
