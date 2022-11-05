<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_details', function (Blueprint $table) {
            $table->id();
            $table->longText('body');
            $table->foreignId('from_id')->index()->nullable();
            $table->foreignId('to_id')->index()->nullable();
            $table->boolean('operator')->default(false);
            $table->foreignId('parent_id')->index()->nullable();
            $table->foreignId('ticket_id')->index()->nullable();
            $table->dateTime('seen_at')->nullable();
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
        Schema::dropIfExists('ticket_details');
    }
}
