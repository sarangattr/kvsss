<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_headers', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->timestamp('purchase_date');
            $table->string('supplier_details',255);
            $table->decimal('total_amount',10,2);
            $table->decimal('discount',10,2);
            $table->decimal('net_amount',10,2);
            $table->unsignedBigInteger('no_of_items');
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
        Schema::dropIfExists('purchase_headers');
    }
}
