<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->index()->nullable();
            $table->decimal('credit', 10, 2)->default(0);
            $table->decimal('cash', 10, 2)->default(0);
            $table->enum('state', ['LOCKED', 'NORMAL'])->default('NORMAL');
            $table->dateTime('state_modified_at')->nullable();
            $table->foreignId('state_modifier_id')->index()->nullable();
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
        Schema::dropIfExists('wallets');
    }
}
