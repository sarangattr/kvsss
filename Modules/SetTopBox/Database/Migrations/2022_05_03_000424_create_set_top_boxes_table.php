<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetTopBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_top_boxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lco_id');
            $table->foreign('lco_id')
                ->references('id')
                ->on('staff')
                ->onDelete('cascade');
            $table->string('serial_no',255);
            $table->string('vc_no',255);
            $table->unsignedBigInteger('model');
            $table->foreign('model')
                ->references('id')
                ->on('models')
                ->onDelete('cascade');
            $table->string('cas',100);
            $table->string('stb_type',100);
            $table->string('supplier',255);
            $table->string('batch',100);
            $table->boolean('status')->default(0);
            $table->boolean('del_status')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->date('assign_date')->nullable();
            $table->date('activ_date')->nullable();
            $table->date('deact_date')->nullable();
            $table->date('react_date')->nullable();
            $table->date('create_date')->nullable();
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
        Schema::dropIfExists('set_top_boxes');
    }
}
