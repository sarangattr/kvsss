<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRequestedSpares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_spares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id');
            $table->unsignedBigInteger('item_id');
            $table->timestamp('requested_time')->nullable();
            $table->unsignedBigInteger('requested_quantity');
            $table->timestamp('allocated_time')->nullable();
            $table->unsignedBigInteger('allocated_quantity')->default(0);
            $table->unsignedBigInteger('balance_to_allocate')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('requested_spares');
    }
}
