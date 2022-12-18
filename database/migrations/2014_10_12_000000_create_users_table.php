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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
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

        $admin = new \App\Models\User();
        $admin->first_name = "admin";
        $admin->last_name = "admin";
        $admin->email = "admin@yahoo.com";
        $admin->username = "admin";
        $admin->email_verified_at = now();
        $admin->secret_key = rand(1,9);
        $admin->password = Hash::make("12345678");
        $imgUrl = public_path('storage/images/avatars/avatar-admin.png');
        $path = Storage::disk('public')->putFile('images/avatars', $imgUrl);
        $admin->avatar = $path;
        $admin->save();

        $user = new \App\Models\User();
        $user->first_name = "user";
        $user->last_name = "user";
        $user->email = "user@yahoo.com";
        $user->username = "user";
        $user->email_verified_at = now();
        $user->secret_key = rand(1,8);
        $user->password = Hash::make("12345678");
        $imgUrl = public_path('storage/images/avatars/avatar-user.png');
        $path = Storage::disk('public')->putFile('images/avatars', $imgUrl);
        $user->avatar = $path;
        $user->save();
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
