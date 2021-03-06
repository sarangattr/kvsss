<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('lco_code',20);
            $table->unsignedBigInteger('stb_id');
            $table->string('stb_serial');
            $table->string('stb_type');
            $table->string('stb_model'); 
            $table->timestamp('register_date')->nullable();
            $table->unsignedBigInteger('currently_with');
            $table->unsignedBigInteger('currently_with_type');
            $table->timestamp('currently_with_time')->nullable();
            $table->unsignedBigInteger('complaint_raised_by');
            $table->unsignedBigInteger('complaint_reported');
            $table->unsignedBigInteger('raised_by_type');
            $table->timestamp('lco_to_sub_time')->nullable();
            $table->string('lco_to_sub_status',1)->default('N');
            $table->timestamp('sub_to_checkin_time')->nullable();
            $table->string('sub_to_checkin__status',1)->default('N');
            $table->timestamp('checkin_to_tech_time')->nullable();
            $table->string('checkin_to_tech_status',1)->default('N');
            $table->timestamp('tech_to_sup_time')->nullable();
            $table->string('tech_to_sup_status',1)->default('N');
            $table->unsignedBigInteger('actual_complaint');
            $table->string('flashed')->nullable();
            $table->string('status',1);
            $table->timestamp('sup_to_checkout_time')->nullable();
            $table->string('sup_to_checkout_status',1)->default('N');
            $table->timestamp('checkout_to_sub_time')->nullable();
            $table->string('checkout_to_sub_status',1)->default('N');
            $table->timestamp('sub_to_lco_time')->nullable();
            $table->string('sub_to_lco_status',1)->default('N');
            $table->timestamp('lco_time')->nullable();
            $table->string('lco_status');
            $table->unsignedBigInteger('spares_used_tab_id')->nullable();
            $table->string('stb_status_enb')->default('Deactive');
            $table->boolean('del_status')->default(0);
            $table->boolean('history_trans')->default(0);
            $table->boolean('history_trans_status')->default(0);
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
        Schema::dropIfExists('complaints');
    }
}
