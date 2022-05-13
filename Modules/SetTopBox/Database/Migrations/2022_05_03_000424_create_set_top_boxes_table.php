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
            $table->string('lco_id',20);
            $table->string('serial_no',20);
            $table->string('vc_no',20);
            $table->string('model',20);
            $table->string('cas',20);
            $table->string('stb_type',100);
            $table->string('supplier',200);
            $table->string('batch',10);
            $table->string('status',14)->default('Deactive');
            $table->boolean('del_status')->default(0);
            $table->string('created_by',150);
            $table->date('assign_date')->nullable();
            $table->date('activ_date')->nullable();
            $table->date('deact_date')->nullable();
            $table->date('react_date')->nullable();
            $table->date('create_date')->nullable();
            $table->string('subdistributor_code',4)->nullable();
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
